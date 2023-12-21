<?php

class CynicGmapsTabs {

    public $tabnavs = '', $tabcount = 0;

    public function __construct() {
        add_shortcode('cynic_gmap_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_gmap_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_gmap_tabs',
                'name' => __('Google Map Tabs', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                "as_parent" => array('only' => 'cynic_gmap_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => FALSE,
                'class' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_gmap_tab',
                'name' => __('Google Map Tab', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                "as_child" => array('only' => 'cynic_gmap_tabs'),
                "content_element" => true,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Tab Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Map Image', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Upload Image', 'cynic') => 'upload_map_image',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library/image.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_linearicons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'linearicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'linearicons',
                        ),
                        'value' => 'icon-users2',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 400,
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __('Tab Image', 'cynic'),
                        'param_name' => 'map_tab_image',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'upload_map_image',
                        ),
                        'description' => __('Please upload map image (32x32)px.', 'cynic'),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Custom Address',
                        'type' => 'textarea',
                        'param_name' => 'address',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Map Content',
                        'type' => 'textarea',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'extra_class' => '',
                ), $atts);
        extract($atts);
        ob_start();
        $content = do_shortcode($content);
        ?>
        <div class="cynic_tabs_area <?php echo $extra_class ?>">
            <ul class="nav nav-tabs process-model contact-us-tab" role="tablist">
        <?php echo $this->tabnavs ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
        <?php echo $content ?>
            </div>
        </div>
        <!-- End Tabs Area -->
        <?php
        $this->tabcount = 0;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'address' => '',
            'icon_type' => '',
            'icon_linearicons' => 'icon-users2',
            'icon_fontawesome' => '',
            'upload_map_image' => '',
            'map_tab_image' => '',
            'title' => '',
                ), $atts);
        extract($atts);
        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = 'fa ' . $icon_fontawesome;
        } elseif($icon_type == 'upload_map_image'){
            $iconclass = 'image';
        } else {
            $iconclass = $icon_linearicons;
        }

        $tabactivecls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'active';
        }
        $tabid = 'maptab-' . uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li role="presentation" class="<?php echo $tabactivecls ?>"><a href="#<?php echo $tabid ?>" aria-controls="<?php echo $tabid ?>" role="tab" data-toggle="tab">
            <?php 
            if($iconclass && $iconclass=="image") { 
                echo '<span> ' .wp_get_attachment_image($map_tab_image, 'full', true, array('class' => '')) .' </span>';

            } else { ?>
                <span class="<?php echo $iconclass ?>"></span>
            <?php } ?>
                <br /><p class="tabtitle aligncenter"><?php echo esc_html($title) ?></p></a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start();
        ?>
        <div role="tabpanel" class="tab-pane <?php echo $tabactivecls ?>" id="<?php echo $tabid ?>">			
            <?php if ($address) { ?>
                <p class="regular-text text-center"><?php echo esc_html($address) ?></p>
            <?php } ?>
        <?php echo apply_filters('the_content', $content) ?>
        </div>
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Gmap_Tabs extends WPBakeryShortCodesContainer {
        
    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Gmap_Tab extends WPBakeryShortCode {
        
    }

}