<?php

class CynicCustomTabs {

    public $tabnavs = '', $tabcount = 0;

    public function __construct() {
        add_shortcode('cynic_custom_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_custom_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_custom_tabs',
                'name' => __('Custom Tabs', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_custom_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => false,
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
                'base' => 'cynic_custom_tab',
                'name' => __('Tab', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                "as_child" => array('only' => 'cynic_custom_tabs'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
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
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
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
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Tab Featured Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Tab Text Content',
                        'type' => 'textarea_html',
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
            <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">
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
            'image' => '',
            'icon_type' => '',
            'icon_linearicons' => '',
            'icon_fontawesome' => '',
            'title' => '',
                ), $atts);
        extract($atts);
        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = 'fa ' . $icon_fontawesome;
        } else {
            $iconclass = $icon_linearicons;
        }

        $tabactivecls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'active';
        }
        $tabid = 'customtab-' . uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li role="<?php echo strtolower(esc_attr($title)); ?>" class="<?php echo $tabactivecls ?>">
            <a href="#<?php echo $tabid ?>" aria-controls="<?php echo $tabid ?>" role="tab" data-toggle="tab"><span class="<?php echo $iconclass ?>"></span>
                <br /><p><?php echo esc_html($title) ?></p>
            </a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start();
        ?>
        <div role="tabpanel" class="tab-pane <?php echo $tabactivecls ?>" id="<?php echo $tabid ?>">
            <div class="design-process-content">
                <h3 class="semi-bold"><?php echo esc_html($title) ?></h3>
                <?php echo apply_filters('the_content', $content) ?>
                <?php
                if ($image) {
                    echo wp_get_attachment_image((int) $image, 'cynic-tab-img', false, array('class' => 'img-responsive'));
                }
                ?>
            </div>
        </div>
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Custom_Tabs extends WPBakeryShortCodesContainer {
        
    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Custom_Tab extends WPBakeryShortCode {
        
    }

}