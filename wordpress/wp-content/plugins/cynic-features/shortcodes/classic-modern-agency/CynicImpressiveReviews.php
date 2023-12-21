<?php

class CynicImpressiveReviews {

    public function __construct() {
        add_shortcode('cynic_impressive_reviews', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            global $wpdb;
            $postsarr = array();
            $posts = $wpdb->get_results("SELECT post_title,post_name FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='reviews'");
            if (!empty($posts) && !is_wp_error($posts)) {
                foreach ($posts as $post) {
                    $postsarr[$post->post_title] = $post->post_name;
                }
            }
            
            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }
            
            $args = array(
                'base' => 'cynic_impressive_reviews',
                'name' => __('Impressive Customer Reviews', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Customer Review"),
                        "param_name" => "reviews_param",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => " ",
                        "description" => __("Please choose the reviews to display in impressive review section\'s.")
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'post_title',
                            'Publish Date' => 'post_date',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'revieworder',
                        'value' => array(
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Internal Link',
                        'type' => 'dropdown',
                        'param_name' => 'internal_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => $pagearr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'External Link',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'reviews_param' => '',
            'orderby' => 'ID',
            'revieworder' => 'ASC',
            'button_text' => 'discover more',
            'button_link' => '',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        if ($reviews_param) {

            global $wpdb;
            $postNamesArray = explode(',', $reviews_param);
            $postNameString = implode("','", $postNamesArray);

            $postNames = "'".$postNameString."'";
            $post_per_page = count($postNamesArray);
            $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='reviews' AND post_name IN ($postNames) ORDER BY $orderby $revieworder");
            ob_start();
            if (!empty($posts) && !is_wp_error($posts)) { ?>
            <div class="row grid">
                <?php 
                foreach ($posts as $post) {
                $reviewer_name = get_post_meta($post->ID, 'reviews_reviewer_name', TRUE);
                $reviewer_designation = get_post_meta($post->ID, 'reviews_reviewer_org', TRUE);
                $review_value = get_post_meta($post->ID, 'reviews_review_values', TRUE); 
                $cat_args = array(
                    'taxonomy' => 'reviews-cat',
                    'slug' => $reviews_param,
                );
                $category = get_the_terms( $post->ID, 'reviews-cat' );
                $image_id = 0;
                $cat_name = "";
                if(isset($category[0]->term_id) && !empty($category[0]->term_id)){
                    $cat_id = $category[0]->term_id;
                    $cat_name = $category[0]->name;
                    $image_id = get_term_meta ( $cat_id, 'category-image-id', true );
                } ?>
                <div class="col-sm-6 col-md-4 grid-item">
                    <div class="content text-left">
                        <?php if($image_id > 0) { ?>
                            <div class="img-container">
                                <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                            </div>
                        <?php } ?>
                        <div class="clients-rating">
                            <div class="clients-rating-top" data-review-attr="<?php echo esc_attr($review_value."%"); ?>">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="clients-rating-bottom">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- End of .clients-rating -->
                        <h5><?php echo $post->post_title; ?></h5>
                        <p class="regular-text"><?php echo $post->post_content; ?></p>
                        <div class="user-info"><span><?php echo esc_html($reviewer_name); ?>,</span> <?php echo esc_html($reviewer_designation); ?></div>
                    </div>
                    <!-- End of .content -->
                </div>
                <!-- End of .col-sm-4 -->
                <?php } ?>
            </div>
            <!-- End of .row -->
            <?php $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
            <div class="clear"></div>
            <div><a <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?> href="<?php echo esc_url($link)?>" class="btn btn-fill full-width"><?php esc_html_e($button_text, 'cynic') ?></a></div>
                <?php
            return ob_get_clean();
            }
        }
    }

}
