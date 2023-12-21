<?php

class CynicAllCaseStudies {

    public function __construct() {
        add_shortcode('cynic_case_studies', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }
            $args = array(
                'base' => 'cynic_case_studies',
                'name' => __('Case Studies Grids', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Listing Page',
                        'type' => 'dropdown',
                        'param_name' => 'listing_page',
                        'value' => $pagearr,
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
                        'heading' => 'Display Pagination',
                        'type' => 'dropdown',
                        'param_name' => 'pagi_status',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '0',
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
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'listing_page' => '',
                'col_size' => '6',
                'pagi_status' => '1',
                'posts_per_page' => '4',
                'orderby' => 'ID',
                'order' => 'DESC',
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'case_studies',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        if ($pagi_status == 1) {
            $args['paged'] = $paging = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        }

        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) {
            $thumbsize = 'cynic-trendy-related-case';
            $columncls = 'item col-md-6';
            if ($col_size == '4') {
                $columncls = 'item col-md-4';
                $thumbsize = 'cynic-trendy-portfolio-img';
            }
            $shape_colors = getCynicOptionsVal('shape-color');
            $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
            $get_colors = get_bubble_color($bubble_colors); ?>
            <svg class="bg-shape shape-case-study reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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
                <div class="case-study-showcase">
                    <div class="row equalHeightWrapper">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $challenge_text = cynic_get_meta('cynic_case_studies_challenges_text');
                            ?>
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
                                        <h5><?php the_title() ?></h5>
                                        <p><?php echo cynic_nl2br(get_the_excerpt()) ?></p>
                                    </div>
                                    <!-- End of .txt-content -->
                                </a>
                                <!-- End of .featured-content-block -->
                            </div>
                            <?php
                        }
                        ?>
                    </div><!--row-->
                    <?php
                    if ($listing_page) {
                        $mainpagelink = get_permalink((int) $listing_page);
                        if ($pagi_status == 1) {
                            $mod = strpos($mainpagelink, '?') !== FALSE ? '&' : '?';
                            $totalpages = ceil($query->found_posts / (int) $posts_per_page);
                            if($totalpages>1){ ?>
                                <div class="col-md-12">
                                    <nav class="pagination-case">
                                        <div class="pagination justify-content-center">
                                            <?php
                                            echo paginate_links(array(
                                                'base' => $mainpagelink . $mod . 'paged=%#%',
                                                'format' => $mod . 'paged=%#%',
                                                'current' => $paging,
                                                'total' => $totalpages,
                                                'prev_text' => wp_kses_post(__('&lt;', 'cynic')),
                                                'next_text' => wp_kses_post(__('&gt;', 'cynic')),
                                            ));
                                            ?>
                                        </div>
                                    </nav>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-md-12"> <a href="<?php echo esc_url($mainpagelink) ?>" class="btn btn-fill full-width"><?php esc_html_e('Discover more', 'cynic') ?></a>
                                </div>
                            </div>
                            <?php
                        }
                    } ?>
                </div>
            </div>

            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}
