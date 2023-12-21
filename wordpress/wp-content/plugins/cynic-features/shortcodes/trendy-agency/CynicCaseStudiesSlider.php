<?php

class CynicCaseStudiesSlider
{

    protected $taxonomy;
    protected $post_type;

    public function __construct()
    {
        add_shortcode('cynic_case_studies_sliders', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        $this->post_type = 'case_studies';
        $this->taxonomy = 'case_studies_cat';
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $argss = array(
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => $this->post_type,
                'post_status' => 'publish',
                'suppress_filters' => true
            );

            $posts_array = get_posts($argss);
            $caseStudiesList = array();
            foreach ($posts_array as $post) {
                $caseStudiesList[$post->post_title] = $post->post_name;
            }


            $args = array(
                'base' => 'cynic_case_studies_sliders',
                'name' => __('Case Studies Slider', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                "is_container" => false,
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
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "cynic_vc_parent_padding",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        "type" => "checkbox",
                        "class" => "cynic_vc_parent_padding",
                        "heading" => __("Select Case Studies "),
                        "param_name" => "case_studies_list",
                        "value" => $caseStudiesList, //value
                        "std" => "",
                    ),
                    array(
                        "holder" => "",
                        "class" => "cynic_vc_parent_padding",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'title',
                            'Url Slug' => 'name',
                            'Publish Date' => 'date',
                            'Random' => 'rand',
                        ),
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        "class" => "cynic_vc_parent_padding",
                        'value' => array(
                            'Select Order' => '',
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "h3",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Apply Button Text', 'cynic'),
                        'value' => 'SEE THE CASE STUDY',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Open with Modal?', 'cynic'),
                        'param_name' => 'is_modal',
                        'description' => __('Enable/Disable open with modal.', 'cynic'),
                        'value' => array(
                            __('Select', 'cynic') => '',
                            __('No', 'cynic') => 'no',
                            __('Yes', 'cynic') => 'yes',
                        ),
                    ),

                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = array())
    {
        $attributes = shortcode_atts(
            array(
                'layouts' => '1',
                'extra_class' => '',
                'image' => '',
                'case_studies_list' => '',
                'button_text' => __('SEE THE CASE STUDY', 'cynic'),
                'is_modal' => 'no',
                'orderby' => 'id',
                'order' => 'DESC',
            ), $atts);

        $layouts = $attributes['layouts'];
        $extra_class = $attributes['extra_class'];
        $image = $attributes['image'];
        $imgsrc = wp_get_attachment_url($image, 'full');
        $button_text = $attributes['button_text'];
        $is_modal = $attributes['is_modal'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];

        $case_studies_list = $attributes['case_studies_list'];
        $case_studiesArr = explode(',', $case_studies_list);

        $args = array(
            'post_type' => $this->post_type,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => false,
            'post_name__in' => $case_studiesArr
        );
        $the_query = new WP_Query($args);

        ob_start();
        $shape_colors = getCynicOptionsVal('shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors);
        if (isset($the_query)) {
            if ($the_query->have_posts()) {
                if($layouts == 2) { ?>
                    <svg class="bg-shape shape-case reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="779px"
                         height="759px">
                        <defs>
                            <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                                <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                            </linearGradient>

                        </defs>
                        <path fill-rule="evenodd" fill="url(#PSgrad_04)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                        />
                    </svg>
                <?php } else { ?>
                    <svg class="bg-shape shape-case reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="779px"
                         height="759px">
                        <defs>
                            <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                                <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                            </linearGradient>

                        </defs>
                        <path fill-rule="evenodd" fill="url(#PSgrad_04)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                        />
                    </svg>
                <?php } ?>
                <div class="container <?php echo esc_attr($extra_class); ?>">
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-lg-2">
                            <div class="case-study-slider">
                                <?php
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    $video_url = get_post_meta(get_the_ID(), 'cynic_case_studies_video_link', TRUE);

                                    $modalClass = 'show-modal';
                                    $permalink = AXILWEB_JAVASCRIPTVOID;
                                    if (($is_modal == 'no')) {
                                        $modalClass = 'no-modal';
                                        $permalink = get_permalink();
                                    }
                                    ?>
                                    <div class="item">
                                        <h2><?php echo cynic_nl2br(get_the_title()) ?></h2>
                                        <p><?php echo cynic_nl2br(get_the_excerpt()) ?></p>
                                        <div class="btn-container">
                                            <a href="<?php echo esc_attr($permalink); ?>"
                                               data-id="<?php echo esc_attr(get_the_ID()) ?>"
                                               class="custom-btn btn-big grad-style-ab <?php echo esc_attr($modalClass) ?>"><?php echo esc_html($button_text); ?></a>
                                            <?php
                                            if ($video_url):
                                                ?>
                                                <a href="<?php echo esc_url($video_url) ?>"
                                                   class="video-play-btn video-popup">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="img-container col-lg-6">
                            <img src="<?php echo esc_url($imgsrc); ?>" alt="case study image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        return ob_get_clean();
    }

}

