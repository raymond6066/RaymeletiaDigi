<?php

class CynicCounter
{
    public function __construct()
    {
        add_shortcode('cynic_counters', array($this, 'shortcodecb'));
        add_shortcode('cynic_counter', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_counters',
                'name' => __('Custom Counters', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_counter'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                'base' => 'cynic_counter',
                'name' => __('Counter', 'cynic'),
                "category" => __("Illustration", "cynic"),
                "as_child" => array('only' => 'cynic_counters'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Upload Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'count_val',
                        'type' => 'textfield',
                        'heading' => __('Counter Numeric Value', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Counter Text',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'extra_class' => ''
            ), $atts);
        extract($atts);
        ob_start();
        $content = do_shortcode($content); ?>
        <div class="container">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'count_val' => '',
                'image' => '',
            ), $atts);
        extract($atts);
        $image_url = wp_get_attachment_url($image);
        ob_start(); ?>
        <div class="col-4">
            <div class="counter-block d-flex align-items-center justify-content-center">
                <div class="icon-container">
                    <img src="<?php echo esc_url($image_url); ?>" alt="">
                </div>
                <!-- End of .icon-container -->
                <div class="counter-wrapper">
                    <div class="number">
                        <span class="counter"><?php echo esc_html($count_val); ?></span>+
                    </div>
                    <!-- End of .number -->
                    <?php echo html_entity_decode(cynic_nl2br($content)); ?>
                </div>
                <!-- End of .counter-wrapper -->
            </div>
            <!-- End of .counter-block -->
        </div>
        <!-- End of .col-4 -->
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Counters extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Counter extends WPBakeryShortCode
    {

    }

}
