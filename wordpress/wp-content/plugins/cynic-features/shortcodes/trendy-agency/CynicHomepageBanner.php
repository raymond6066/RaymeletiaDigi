<?php

class CynicHomepageBanner {

    public function __construct() {
        add_shortcode('cynic_homepage_banner', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_homepage_banner',
                'name' => __('Homepage Banner', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Select Layout', 'cynic'),
                        'value' => array(
                            __('Onepage Layout', 'cynic') => '1',
                            __('Multipage Layout', 'cynic') => '2',
                        ),
                        'admin_label' => true,
                        'param_name' => 'layouts',
                        'description' => __('Select layouts for different agencies.', 'cynic'),
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Banner Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Banner Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Banner Sub Heading',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Button Link',
                        'type' => 'vc_link',
                        'param_name' => 'button_link',
                        'value' => '',
                        'description' => __('Button link details', 'cynic'),
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'layouts' => '1',
                'title' => '',
                'image' => '',
                'button_link' => '',
            ), $atts);
        extract($atts);
        ob_start();
        $image_url = wp_get_attachment_url($image);
        $linkArr = vc_build_link($atts['button_link']);
        $shape_colors = get_theme_mod('cynic_shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors);
        $extra_class= ($layouts==2) ? "small-agency-home-header-bg" : "";

        ?>
        <!-- HomePage Banner
        ======================================= -->
        <div class="banner <?php echo esc_attr($extra_class)?>" id="top">
            <svg class="bg-shape shape-home-banner reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_01" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_01)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>

            <div class="container">
                <div class="banner-content">
                    <div class="trendy-banner" style="background-image: url(<?php echo $image_url; ?>);"></div>
                    <h1><?php echo html_entity_decode(cynic_nl2br($title)); ?></h1>
                    <p class="section-subheading"><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                    <?php echo cynic_trendy_anchor_link_html($linkArr, 'custom-btn btn-big grad-style-ef page-scroll'); ?>
                </div>
                <!-- End of .banner-content -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .header -->
        <?php
        return ob_get_clean();
    }

}
