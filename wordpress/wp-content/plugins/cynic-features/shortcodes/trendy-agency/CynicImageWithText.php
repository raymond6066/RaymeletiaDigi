<?php

class CynicImageWithText
{

    public function __construct()
    {
        add_shortcode('cynic_image_with_text', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_image_with_text',
                'name' => __('Image With Text Block', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Lead Title', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Content Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Block Banner Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Bullet Points', 'cynic'),
                        'param_name' => 'features',
                        'params' => array(
                            array(
                                'type' => 'iconpicker',
                                'heading' => __('Service Icon', 'cynic'),
                                'param_name' => 'icon_minilineicons',
                                'settings' => array(
                                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                                    'type' => 'minilineicons',
                                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                                ),
                                'description' => __('Select bullet icon from library.', 'cynic'),
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Bullet Text', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'bullet_text',
                                'description' => __('Bulllet text here.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
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
                'title' => '',
                'image' => '',
                'icon_minilineicons' => '',
                'features' => ''
            ), $atts);
        extract($atts);
        ob_start();
        $shape_colors = get_theme_mod('cynic_shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors);
        $features = vc_param_group_parse_atts($features);
        $bullets = count($features);
        $get_image_url = wp_get_attachment_url($image); ?>

        <div class="trigger-image-with-description"></div>
        <svg class="bg-shape image-with-description-shape-bg reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="779px" height="759px">
            <defs>
                <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="1" />
                    <stop offset="100%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>

        <div class="container">
            <div class="row align-items-center image-with-description-block">
                <div class="col-lg-6">
                    <h2><?php echo esc_attr($title); ?></h2>
                    <p><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                    <?php if ($features > 0) { ?>
                        <ul class="common-list-items">
                            <?php foreach ($features as $feature) { ?>
                                <li><i class="<?php echo esc_attr($feature['icon_minilineicons']) ?>"></i> <?php echo html_entity_decode(cynic_nl2br($feature['bullet_text'])); ?></li>
                            <?php } ?>
                        </ul>
                        <!-- End of .common-list-items -->
                    <?php } ?>
                </div>
                <!-- End of .col-lg-6 -->

                <div class="col-lg-6 text-lg-right">
                    <img src="<?php echo esc_url($get_image_url) ?>" alt="" class="img-fluid">
                </div>
                <!-- End of .col-lg-6 -->
            </div>
            <!-- End of .row -->
        </div>
        <!-- End of .container -->
        <?php
        return ob_get_clean();
    }

}
