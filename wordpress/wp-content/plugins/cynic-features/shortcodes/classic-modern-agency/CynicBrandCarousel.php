<?php

class CynicBrandCarousel {

    public function __construct() {
        add_shortcode('cynic_brands', array($this, 'shortcodecb'));
        add_shortcode('cynic_brand', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_brands',
                'name' => __('Brands Carousel', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_brand'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                'base' => 'cynic_brand',
                'name' => __('Brand Slide', 'cynic'),
                "category" => __("Cynic", "cynic"),
                "as_child" => array('only' => 'cynic_brands'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    )
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
        <!-- Start Slider Area -->
        <div class="<?php echo esc_attr($extra_class) ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="owl-carousel">
                            <?php echo $content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Slider Area -->
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'image' => ''
                ), $atts);
        extract($atts);
        ob_start();
        ?>
        <div><a href="javascript:void(0)"><?php echo wp_get_attachment_image((int) $image, 'full', false, array('class' => 'img-responsive center-block')); ?></a></div>
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_brands extends WPBakeryShortCodesContainer {
        
    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_brand extends WPBakeryShortCode {
        
    }

}