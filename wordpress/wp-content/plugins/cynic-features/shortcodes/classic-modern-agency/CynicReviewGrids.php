<?php

class CynicReviewGrids {

    public function __construct() {
        add_shortcode('cynic_review_grids', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_enqueue_scripts', array($this, 'reviews_scripts'));
    }

    public function reviews_scripts() {
        wp_enqueue_script('isotope');
        wp_enqueue_style('isotope-css');
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $taxonomy = 'reviews-cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
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
                'base' => 'cynic_review_grids',
                'name' => __('Review Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Reviews Category',
                        'type' => 'dropdown',
                        'param_name' => 'select_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
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
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'value' => array(
                            'Decending' => 'DESC',
                            'Ascending' => 'ASC',
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
            'select_cat' => '',
            'orderby' => 'ID',
            'order' => 'DESC',
            'button_text' => 'Write a review',
            'button_link' => '',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        if ($select_cat) {
            $taxonomy = 'reviews-cat';
            $args = array(
                'post_type' => 'reviews',
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true,
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $select_cat,
                ),
            );

            $query = new WP_Query($args);
            ob_start();
            if ($query->have_posts()) { 
                $cat_args = array(
                    'taxonomy' => 'reviews-cat',
                    'slug' => $select_cat,
                );
                $category = get_terms($cat_args);
                $image_id = 0;
                $cat_name = "";
                if(isset($category[0]->term_id) && !empty($category[0]->term_id)){
                    $cat_id = $category[0]->term_id;
                    $cat_name = $category[0]->name;
                    $image_id = get_term_meta ( $cat_id, 'category-image-id', true );
                }
                ?>
                <h2 class="b-clor"><?php echo esc_html($cat_name); ?></h2>
                <hr class="dark-line" />
                <?php 
                echo "<div class='row grid'>";
                    while ($query->have_posts()) {
                        $query->the_post();
                        $reviewer_name = get_post_meta(get_the_ID(), 'reviews_reviewer_name', TRUE);
                        $reviewer_designation = get_post_meta(get_the_ID(), 'reviews_reviewer_org', TRUE);
                        $review_value = get_post_meta(get_the_ID(), 'reviews_review_values', TRUE); ?>
                            <div class="col-sm-6 col-md-4 grid-item">
                                <div class="content text-left">
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
                                    <h5><?php the_title(); ?></h5>
                                    <p class="regular-text"><?php the_content() ?></p>
                                    <div class="user-info"><span><?php echo esc_html__($reviewer_name); ?>,</span> <?php echo esc_html__($reviewer_designation); ?></div>
                                </div>
                                <!-- End of .content -->
                            </div> 
                            <?php 
                    }
                echo "</div>"; 
                $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <div class="clear"></div>
                <div><a <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?> href="<?php echo esc_url($link)?>" class="btn btn-fill full-width"><?php esc_html_e($button_text, 'cynic') ?></a></div>
                <?php
            }
            return ob_get_clean();
        }
    }

}
