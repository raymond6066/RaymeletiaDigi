<?php

class CynicCaseStudiesByCat
{
    public function __construct() {
        add_shortcode('cynic_case_studies_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            /* Get All Pages*/
            $pagearr = cynic_get_pages();

            /*Get Category By Its ID */
            $taxonomy = 'case_studies_cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }
            $args = array(
                'base' => 'cynic_case_studies_by_cat',
                'name' => __('Case Studies By Category', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Select Case Studies Category',
                        'type' => 'dropdown',
                        'param_name' => 'case_studies_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Column size',
                        'type' => 'dropdown',
                        'param_name' => 'col_size',
                        'value' => array(
                            'One Half' => '6',
                            'One Third' => '4',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show posts in a page', 'cynic'),
                        'value' => '',
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
                    )
                )
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'case_studies_cat' => '',
                'col_size' => '6',
                'posts_per_page' => '4',
                'orderby' => 'ID',
                'order' => 'DESC',
                'button_text' => 'View Details',
                'button_link' => '1',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
            ), $atts);
        extract($atts);
        $taxonomy = 'case_studies_cat';
        $args = array(
            'post_type' => 'case_studies',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => (string) $case_studies_cat,
            ),
        );

        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) {
            $thumbsize = 'cynic-trendy-related-case';
            $columncls = 'col-md-6';
            if ($col_size == '4') {
                $columncls = 'col-md-4';
                $thumbsize = 'cynic-trendy-portfolio-img';
            }
            $shape_colors = getCynicOptionsVal('shape-color');
            $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
            $get_colors = get_bubble_color($bubble_colors); ?>
            <svg class="bg-shape shape-case-studies reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_04)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
            <div class="container">
                <div class="case-study-showcase text-center">
                    <div class="row equalHeightWrapper">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post(); ?>
                            <div class="<?php echo esc_attr($columncls) ?>">
                                <a href="<?php the_permalink() ?>" class="case-study-content-block content-block text-left">
                                    <div class="img-container">
                                        <?php
                                        if(has_post_thumbnail()) {
                                            the_post_thumbnail($thumbsize, array('class' => 'img-fluid')) ;
                                        } ?>
                                    </div>
                                    <!-- End of .img-container -->
                                    <div class="txt-content equalHeight">
                                        <h5>
                                            <?php the_title() ?>
                                        </h5>
                                        <p><?php echo cynic_nl2br(get_the_excerpt()) ?></p>
                                    </div>
                                    <!-- End of .txt-content -->
                                </a>
                                <!-- End of .featured-content-block -->
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($button_link) && !empty($button_link)) {
                        $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                            <!--read more blog button-->
                            <a href="<?php echo esc_url($link) ?>"
                                <?php if (isset($open_type) && $open_type == '1') { ?> target="_blank" <?php } ?>
                               class="custom-btn btn-big grad-style-ef btn-full"><?php echo esc_html($button_text) ?></a>
                        <?php
                    } ?>
                </div>
            </div><!--row-->

            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}