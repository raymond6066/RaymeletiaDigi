<?php

class CynicProcessTab {

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
                "category" => __("Trendy Agency", "cynic"),
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
                "category" => __("Trendy Agency", "cynic"),
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
                        'type' => 'iconpicker',
                        'heading' => __('Service Icon', 'cynic'),
                        'param_name' => 'icon_minilineicons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'minilineicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'description' => __('Select service icon from library.', 'cynic'),
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
        <div class="container">
        <div class="service-process-tab <?php echo $extra_class ?>">
            <ul class="nav nav-tabs service-tab-nav" id="service-tab-nav" role="tablist">
                <?php echo $this->tabnavs ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content service-tab-content" id="service-tab">
                <?php echo $content ?>
            </div>
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
                'icon_minilineicons' => '',
                'title' => '',
            ), $atts);
        extract($atts);
        $iconclass = $icon_minilineicons;

        $tabactivecls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'active';
        }
        $tabid = 'customtab-' . uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li class="nav-item" role="<?php echo strtolower(esc_attr($title)); ?>">
            <a class="nav-link <?php echo $tabactivecls ?>" href="#<?php echo $tabid ?>" aria-controls="<?php echo $tabid ?>" role="tab" data-toggle="tab">
                <i class="<?php echo esc_attr($iconclass); ?>"></i>
                <span><?php echo esc_html($title) ?></span>
            </a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start(); ?>
        <div role="tabpanel" class="tab-pane <?php echo $tabactivecls ?>" id="<?php echo $tabid ?>">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-5 text-lg-right">
                    <?php
                    if ($image) {
                        echo wp_get_attachment_image((int) $image, 'cynic-trendy-tab-img', false, array('class' => 'img-fluid'));
                    } ?>
                </div>
                <!-- End of .col-lg-6 -->

                <div class="col-lg-6 offset-lg-1 text-center text-lg-left">
                    <h4><?php echo esc_html($title) ?></h4>
                    <p><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                    <a href="#" class="text-only-btn"><?php echo __('Next Process', 'cynic'); ?>
                        <i class="ml-symone-2-arrow-left-right-up-down-increase-decrease"></i>
                    </a>
                </div>
                <!-- End of .col-lg-6 -->
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