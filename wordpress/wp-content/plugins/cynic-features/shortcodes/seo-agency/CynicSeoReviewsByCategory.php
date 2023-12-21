<?php

class CynicSeoReviewsByCategory
{

    public function __construct()
    {
        add_shortcode('cynic_seo_reviews_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $categories = cynicSEO_feature_get_catetories_by_texonomy('reviews-cat');


            $args = array(
                'base' => 'cynic_seo_reviews_by_cat',
                'name' => __('Review', 'cynic'),
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
                        'type' => 'dropdown',
                        "heading" => __("Select Customer Reviews Category"),
                        "param_name" => "customer_reviews_category",
                        "admin_label" => true,
                        'value' => $categories,
                        'admin_label' => true,
                        "description" => __(getCustomPostTypeAdminUrl('reviews')),
                    ),

                    array(
                        "holder" => "dev",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show Reviews Per Page', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Show Per Row', 'cynic'),
                        'value' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                        ),
                        'admin_label' => true,
                        'param_name' => 'show_per_row',
                    ),

                    array(
                        "holder" => "div",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Select Order Field' => '',
                            'Id' => 'ID',
                            'Title' => 'title',
                            'Publish Date' => 'date',
                            'Random' => 'rand',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'admin_label' => true,
                        'value' => array(
                            'Select Order' => '',
                            'Decending' => 'DESC',
                            'Ascending' => 'ASC',
                        ),
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
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'read_more_button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => '',
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Slide Link',
                        'type' => 'vc_link',
                        'param_name' => 'slide_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '',
                        'description' => __('Keep URL empty URL if you don\'t want', 'cynic'),
                    ),

                    array(
                        'heading' => __('Button Link', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Ajax Load' => '1',
                            'Anchor Link' => '2',
                        )
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
                'customer_reviews_category' => '',
                'bg_image' => '',
                'posts_per_page' => 10,
                'show_per_row' => 1,
                'orderby' => 'ID',
                'order' => 'ASC',
                'read_more_button_text' => 'Read More',
                'button_link' => '1',
                'slide_link' => ''
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $customer_reviews_category = $attributes['customer_reviews_category'];
        $posts_per_page = $attributes['posts_per_page'];

        $show_per_row = $attributes['show_per_row'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];
        $readMoreText = $attributes['read_more_button_text'];
        $button_link = $attributes['button_link'];
        $linkArr = vc_build_link($attributes['slide_link']);
        $bgimageUrl = wp_get_attachment_url($attributes['bg_image']);

        $taxonomy = 'reviews-cat';
        $slugs = explode(',', $customer_reviews_category);
        $categories = array();
        foreach ($slugs as $slug) {
            $categories[] = get_term_by('slug', $slug, $taxonomy);
        }
        $grid_row = 0;
        if ($show_per_row == 2) {
            $grid_row = 6;
        } elseif ($show_per_row == 3) {
            $grid_row = 4;
        } else {
            $grid_row = 12;
        }

        ob_start();
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $cat) {
                ?>
                <?php
                $args = array(
                    'post_type' => 'reviews',
                    'posts_per_page' => (int)$posts_per_page, // set number of post per category here
                    'orderby' => $orderby,
                    'paged' => 1,
                    'order' => $order,
                    'ignore_sticky_posts' => true,
                );
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => (string)$cat->slug,
                    ),
                );
                $query = new WP_Query($args);
                $found_posts = (int)$query->found_posts;
                $settings = ['show_per_row' => $show_per_row, 'found_posts' => $found_posts, 'bgimageUrl' => $bgimageUrl, 'cat_term_id' => $cat->term_id];

                if ($found_posts > 0) {
                    ?>
                    <div class="review-block cynicSEO-customer-review-details <?php echo esc_attr($extra_class); ?>"
                         data-query='<?php echo esc_attr(json_encode($args)); ?>'
                         data-settings='<?php echo esc_attr(json_encode($settings)); ?>' data-paged="1"
                         data-post-count="<?php echo esc_attr($posts_per_page); ?>">
                        <div class="row">
                            <?php
                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $category_image = '';
                                    $image_id = get_term_meta($cat->term_id, 'category-image-id', true);
                                    if ($image_id) {
                                        $category_image = wp_get_attachment_url($image_id);
                                    }
                                    ?>
                                    <div class="col-md-<?php echo esc_attr($grid_row); ?>">
                                        <div class="review-content equalHeight" data-bg="<?php echo esc_url($bgimageUrl) ?>">
                                            <img class="review-source" src="<?php echo esc_url($category_image); ?>"
                                                 alt="review source image">
                                            <div class="media">

                                                <?php
                                                if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                                    the_post_thumbnail('thumbnail');
                                                } else {
                                                    ?>
                                                    <img height="80" width="80" class="d-flex mr-3"
                                                         src="<?php echo esc_url(AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/css/user-icon-default.png'); ?>"
                                                         alt="media placeholder image">
                                                    <?php
                                                }
                                                $review_values = get_post_meta(get_the_ID(), 'reviews_review_values');
                                                $review = 'stars-0';
                                                if (isset($review_values['0'])) {
                                                    $review = $review_values['0'];
                                                }
                                                ?>
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
                                                <!-- End of .media-body -->
                                            </div>
                                            <!-- End of .media -->
                                            <p><?php the_content() ?></p>
                                        </div>
                                        <!-- End of .content -->
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="row">
                            <?php
                            if ($button_link == 1) {
                                if ($found_posts > $posts_per_page) {
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <a href="<?php echo esc_attr(AXILWEB_JAVASCRIPTVOID) ?>"
                                           class="primary-btn read_more_client_reviews_btn"><?php echo esc_html_cynicSEO_string($readMoreText); ?></a>
                                    </div>
                                    <?php
                                }
                            } else {
                                if (isset($linkArr['title']) && !empty($linkArr['title'])) {
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <?php
                                        echo cynicSEO_anchor_link_html($linkArr);
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        return ob_get_clean();
        }
        ?>
        <?php
    }

}
