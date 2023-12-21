<?php

class CynicLeadFront
{

    public function __construct()
    {
        add_shortcode('cynic_lead_front', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_lead_front',
                'name' => __('About Us Block', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
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
                        'heading' => __('Block Banner Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'video_url',
                        'type' => 'textarea',
                        'heading' => __('Video Url', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
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
                        'heading' => 'Lead Description',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Lead Features', 'cynic'),
                        'param_name' => 'features',
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Select Colors', 'cynic'),
                                'value' => array(
                                    __('Primary Color', 'cynic') => 'txt-grad-cd',
                                    __('Secondary Color', 'cynic') => 'txt-grad-ef',
                                    __('Tertiary Color', 'cynic') => 'txt-grad-ab',
                                ),
                                'admin_label' => false,
                                'param_name' => 'colors',
                                'description' => __('Select colors for different blocks.', 'cynic'),
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Featured Title', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'featured_title',
                                'description' => __('Featured counter title.', 'cynic'),
                                'admin_label' => true,
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Counter Value', 'cynic'),
                                'type' => 'textfield',
                                'param_name' => 'counter_value',
                                'description' => __('Featured counter value.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'layouts' => '1',
                'image' => '',
                'video_url' => '',
                'title' => '',
                'features' => ''
            ), $atts);
        extract($atts);
        $image_url = wp_get_attachment_url($image);
        $group_features = vc_param_group_parse_atts($features);
        $countFeatures = count($group_features);
        ob_start();
        $shape_colors = get_theme_mod('cynic_shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors); ?>

        <?php if($layouts == 2) { ?>
            <svg class="bg-shape shape-about reveal-from-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="<?php echo esc_url($image_url); ?>" alt="about image" class="img-fluid img-round">
                </div>
                <!-- End of .col-md-6 -->

                <div class="col-lg-6">
                    <h2><?php echo $title; ?></h2>
                    <?php echo html_entity_decode(cynic_nl2br($content)); ?>
                    <?php if ($countFeatures > 0) { ?>
                        <div class="counter-wrapper inner-page-counter-wrapper d-flex justify-content-between">
                            <?php foreach ($group_features as $feature) {
                                $extra_class = (isset($feature['colors']) && !empty($feature['colors'])) ? " " . $feature['colors'] : " txt-grad-ef" ?>
                                <div class="inner-block">
                                    <div class="counter-block d-block <?php echo esc_attr($extra_class) ?>">
                                        <span class="counter"><?php echo $feature['counter_value']; ?></span>+
                                    </div>
                                    <?php echo html_entity_decode(cynic_nl2br($feature['featured_title'])); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End of .counter-block -->
                    <?php } ?>
                </div>
                <!-- End of .col-lg-6 -->
            </div>
        </div>
        <!-- End of .container -->
        <?php } else { ?>
            <svg class="bg-shape shape-about reveal-from-right" xmlns="http://www.w3.org/2000/svg" width="779px"
                 height="759px">
                <defs>
                    <linearGradient id="PSgrad_02" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_02)"
                      d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
            <?php if (!empty($video_url)) { ?>
                <div class="video-play-bg grad-style-cd">
                    <div class="lead-banner" style="background-image:url(<?php echo $image_url; ?>)"></div>
                    <a href="<?php echo esc_url($video_url); ?>" class="video-play-btn video-popup">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
            <?php } ?>
            <!-- End of .video-play-bg -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <h2><?php echo $title; ?></h2>
                        <?php echo html_entity_decode(cynic_nl2br($content)); ?>
                        <?php if ($countFeatures > 0) { ?>
                            <div class="counter-wrapper d-flex justify-content-between">
                                <?php foreach ($group_features as $feature) {
                                    $extra_class = (isset($feature['colors']) && !empty($feature['colors'])) ? " " . $feature['colors'] : " txt-grad-ef" ?>
                                    <div class="inner-block">
                                        <div class="counter-block d-block <?php echo esc_attr($extra_class) ?>">
                                            <span class="counter"><?php echo $feature['counter_value']; ?></span>+
                                        </div>
                                        <?php echo html_entity_decode(cynic_nl2br($feature['featured_title'])); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <!-- End of .counter-block -->
                    </div>
                    <!-- End of .col-lg-6 -->
                </div>
            </div>
            <!-- End of .container -->
            <?php
        }
        return ob_get_clean();
    }

}
