<?php

class CynicSeoReviewersCarousel
{

    public function __construct()
    {
        add_shortcode('cynic_seo_reviewers_carousel', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'reviews',
                'post_status' => 'publish',
                'suppress_filters' => true
            );
            $postsarr = cynicSEO_features_get_posts_lists($args);

            $args = array(
                'base' => 'cynic_seo_reviewers_carousel',
                'name' => __('Review Carousel', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Customer Reviews"),
                        "param_name" => "customer_reviews_param",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => "",
                        "description" => __(getCustomPostTypeAdminUrl('reviews'))
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Background Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __('Slider Paginate Dot', 'cynic'),
                        'param_name' => 'paginatedot',
                        'description' => __('Enable Paginate dot mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Slider speed', 'cynic'),
                        'param_name' => 'speed',
                        'value' => '200',
                        'description' => __('Duration of animation between slides (in ms).', 'cynic'),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __('Slides per view', 'cynic'),
                        'param_name' => 'slides_per_view',
                        'value' => '5',
                        'description' => __('Enter number of slides to display at the same time.', 'cynic'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Scroll per view', 'cynic'),
                        'param_name' => 'scroll_per_view',
                        'value' => '1',
                        'description' => __('Enter number of slides to scroll at the same time.', 'cynic'),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __('Slider autoplay', 'cynic'),
                        'param_name' => 'autoplay',
                        'description' => __('Enable autoplay mode.', 'cynic'),
                        'value' => array(__('Yes', 'cynic') => 'yes'),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => __('Autoplay Slider speed', 'cynic'),
                        'param_name' => 'autoplayspeed',
                        'value' => '2000',
                        'description' => __('Duration of animation between autoplay (in ms).', 'cynic'),
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Read More Reviews Link',
                        'type' => 'vc_link',
                        'param_name' => 'slide_link',
                        'value' => '',
                        'description' => __('Keep URL empty URL if you don\'t want', 'cynic'),
                    ),


                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'customer_reviews_param' => '',
                'bg_image' => '',
                'speed' => '200',
                'slides_per_view' => '5',
                'scroll_per_view' => '1',
                'autoplay' => '',
                'paginatedot' => '',
                'autoplayspeed' => '2000',
                'slide_link' => ''
            ), $atts);

        $slides_per_view = (int) $attributes['slides_per_view'];
        $scroll_per_view = (int) $attributes['scroll_per_view'];
        $speed = (int) $attributes['speed'];
        $dots = $attributes['paginatedot'];
        $autoplay = $attributes['autoplay'];
        $autoplayspeed = (int) $attributes['autoplayspeed'];
        $linkArr = vc_build_link($attributes['slide_link']);
        $bgimageUrl = wp_get_attachment_url($attributes['bg_image']);

        $extra_class = $attributes['extra_class'];
        $reviews_param = $attributes['customer_reviews_param'];
        $reviews_paramArr = explode(',', $reviews_param);

        $the_query = new WP_Query(array('post_type' => 'reviews', 'ignore_sticky_posts' => true, 'post__in' => $reviews_paramArr));

//        ob_start();
        if ($the_query->have_posts()) {
            $totalPost = $the_query->post_count;

            if ($totalPost == 0) {
                return;
            } else {

                if ($totalPost < $slides_per_view) {
                    $slides_per_view = $totalPost;
                }

                if ($totalPost < $scroll_per_view) {
                    $scroll_per_view = $slides_per_view;
                }
            }
            $settings = wp_json_encode(array( 'dots' => ($dots == 'yes') ? true : false, "infinite" => true, "speed" => $speed, 'slidesToShow' => $slides_per_view, 'slidesToScroll' => $scroll_per_view, 'autoplay' => ($autoplay == 'yes') ? true : false, 'autoplaySpeed' => $autoplayspeed, "centerMode"=>true, "centerPadding"=> "555px",
                "responsive" => array(
                    array("breakpoint" => 1600, "settings" => array("slidesToShow" => $slides_per_view, "slidesToScroll" => $scroll_per_view, "centerPadding"=>"400px", "infinite"=>true)),
                    array("breakpoint" => 1199, "settings" => array("slidesToShow" => $slides_per_view, "slidesToScroll" => $scroll_per_view, "centerPadding"=>"200px")),
                    array("breakpoint" => 991, "settings" => array("slidesToShow" => 1, "slidesToScroll" => 1, "centerPadding"=>"200px")),
                    array("breakpoint" => 767, "settings" => array("slidesToShow" => 1, "slidesToScroll" => 1, "centerPadding"=>"100px")),
                    array("breakpoint" => 557, "settings" => array("slidesToShow" => 1, "slidesToScroll" => 1, "centerPadding"=>"0")),
                )));
            ob_start();
            ?>
            <div class="carousel-container cynic_customer_review_carousel <?php echo esc_attr($extra_class) ?> cynic-section-visibility">
                <div class="cynicSEO-slick-slider carousel-inner d-flex align-items-center" data-slick='<?php echo esc_attr($settings) ?>'>

                    <?php
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $post_id = get_the_ID();
                        $category = get_the_terms($post_id, 'reviews-cat');
                        $category_id = $category[0]->term_id;
                        $category_image = '';
                        $image_id = get_term_meta($category_id, 'category-image-id', true);
                        if ($image_id) {
                            $category_image = wp_get_attachment_url($image_id);
                        }

                        $review_values = get_post_meta(get_the_ID(), 'reviews_review_values');
                        $review = 'stars-0';
                        if (isset($review_values['0'])) {
                            $review = $review_values['0'];
                        }

                        ?>
                        <div class="item">
                            <div class="review-content" data-bg="<?php echo esc_url($bgimageUrl) ?>">
                                <img class="review-source" src="<?php echo esc_url($category_image) ?>"
                                     alt="review source image">
                                <div class="media">
                                    <img class="d-flex mr-3" src="<?php the_post_thumbnail_url('thumbnail') ?>"
                                         alt="media placeholder image">
                                    <div class="media-body">
                                        <div class="fixture">
                                            <span class="stars-container <?php echo esc_attr($review); ?>">★★★★★</span>
                                        </div>
                                        <h4 class="mt-0"><?php the_title() ?></h4>
                                        <?php $reviewerDesignation = get_post_meta(get_the_ID(), 'reviews_designation');
                                        if (isset($reviewerDesignation['0'])) {
                                            echo esc_html_cynicSEO_string($reviewerDesignation['0']);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <p><?php the_content() ?></p>
                            </div>

                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if (isset($linkArr['title']) && !empty($linkArr['title'])) {
                    ?>
                    <div class="col-md-12 text-center">
                        <?php
                        echo cynicSEO_anchor_link_html($linkArr);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        return ob_get_clean();
        }
    }

}
