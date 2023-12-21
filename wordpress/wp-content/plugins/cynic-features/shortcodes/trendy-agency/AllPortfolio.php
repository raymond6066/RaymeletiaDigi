<?php

class CynicOnePagePortfolios
{

    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_all_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_all_portfolio',
                'name' => __('All Portfolio', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Block Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show Projects', 'cynic'),
                        'value' => '9',
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
                        'heading' => 'Enable More Loading',
                        'type' => 'dropdown',
                        'param_name' => 'load_more',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '0',
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
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'all_category',
                        'type' => 'textfield',
                        'heading' => __('All Work Filter Text', 'cynic'),
                        'value' => '',
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
                'posts_per_page' => '9',
                'orderby' => 'ID',
                'order' => 'DESC',
                'load_more' => '1',
                'button_text' => 'Discover More Work',
                'all_category' => ''
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => (int)$posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );

        $all_work = "All Work";
        if (isset($all_category) && !empty($all_category)) {
            $all_work = $all_category;
        }

        $query = new WP_Query($args);
        $mixitupcats = array('*' => esc_html__($all_work, 'cynic'));
        $catsTerms = array('*' => '0');
        ob_start();
        $shape_colors = getCynicOptionsVal('shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors); ?>

        <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" width="779px"
             height="759px">
            <defs>
                <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                    <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                </linearGradient>

            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                  d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>
        <?php

        if ($query->have_posts()) {
            $thumbsize = 'cynic-trendy-portfolio-img';
            $taxonomy = 'portfolio-cat';
            $args = array(
                'orderby'                  => $orderby,
                'order'                    => $order,
                'hide_empty'               => false,
                'taxonomy'                 => $taxonomy,
            );
            $categories = get_categories($args);
            $found_posts = (int)$query->found_posts;
            if (!empty($categories) && !is_wp_error($categories)) {
                $termID = 1;
                foreach ($categories as $c => $cat) {
                    $mixitupcats[$cat->slug] = $cat->name;
                    $catsTerms[$cat->slug] = $cat->term_id;
                    $termID++;
                }
            }
            while ($query->have_posts()) {
                $query->the_post();
                $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                $imgsrc = false;
                $relativecatcls = '';
                $relativetitle = '';
                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $c => $cat) {
                        if ($c > 0) {
                            $relativecatcls .= ' ';
                        }
                        $relativecatcls .= $cat->slug;
                        $relativetitle .= ", " . $cat->name;
                    }
                }
                $relativecatcls .= ' ';
                $relativetitle .= ' ';
                $relativetitle = trim($relativetitle, ",");


                $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                $isFeatured = get_post_meta(get_the_ID(),'portfolio_featured', TRUE);
                $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER MORE WORK';
                $settings = ['post_type' => 'portfolio', 'post_id' => get_the_ID(), 'posts_per_page' => (int)$posts_per_page]; ?>
                <div class="<?php echo esc_attr($relativecatcls) ?><?php echo esc_attr($class) ?> grid-item col-md-6 col-lg-4">
                    <?php if ($portfolio_type == 1) { ?>
                        <a href="<?php echo $video_url; ?>"
                           data-posttype="portfolio"
                           data-portfolio-type="<?php echo $portfolio_type; ?>"
                           data-actions="cynic_single_post_content"
                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                           class="video-popup featured-content-block content-block ">
                            <div class="img-container">
                                <?php
                                if (has_post_thumbnail()) {
                                    echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                } ?>
                            </div>
                            <!-- End of .img-container -->
                            <h5 class="equalHeight">
                                <span class="content-block__sub-title"><?php echo esc_html($relativetitle); ?></span>
                                <?php the_title(); ?>
                            </h5>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0)"
                           data-posttype="portfolio"
                           data-actions="cynic_single_post_content"
                           data-portfolio-type="<?php echo $portfolio_type; ?>"
                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                           class="featured-content-block content-block cynic-single-content">
                            <div class="img-container">
                                <?php
                                if (has_post_thumbnail()) {
                                    echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                } ?>
                            </div>
                            <!-- End of .img-container -->
                            <h5 class="equalHeight">
                                <span class="content-block__sub-title"><?php echo esc_html($relativetitle); ?></span>
                                <?php the_title(); ?>
                            </h5>
                        </a>
                    <?php } ?>
                    <!-- End of .featured-content-block -->
                </div>
                <?php
            }
        }
        wp_reset_postdata();
        $portfoliosmarkup = ob_get_clean();
        ob_start();
        $elemid = 'portfolio-' . rand(000000, 999999);
        ?>
        <div class="container">
            <h2 class="text-center"><?php echo $title; ?></h2>

            <div class="project-showcase text-center">
                <div class="filter-button-group" data-isotope-id="#<?php echo $elemid ?>">
                    <?php
                    $c = 0;
                    foreach ($mixitupcats as $key => $val) {
                        $slug = $key;
                        if ($c > 0) {
                            $key = '.' . $key;
                            $activeclass = '';
                        } else {
                            $activeclass = 'is-checked';
                        }
                        ?>
                        <a class="filter-button <?php echo esc_attr($activeclass) ?>"
                                href="javascript:void(0)" data-filter="<?php echo $key ?>"><?php echo $val ?></a>
                        <?php
                        $c++;
                    }
                    ?>
                </div>
                <!-- filter-button-group ends -->

                <div id="<?php echo esc_attr($elemid) ?>" class="grid row">
                    <?php echo $portfoliosmarkup ?>
                </div>
                <!-- End of .grid -->
                <?php
                if ($button_text) {
                    $postCount = $query->found_posts;
                    if($postCount>$posts_per_page) { ?>
                        <a href="javascript:void(0)"
                           data-query='<?php echo esc_attr(json_encode($args)); ?>'
                           data-actions="cynic_get_all_posts"
                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                           data-paged="1"
                           data-post-count="<?php echo esc_attr($posts_per_page); ?>"
                           data-target="#<?php echo esc_attr($elemid) ?>"
                           class="custom-btn btn-big grad-style-ef btn-full <?php if ($load_more == 1): echo esc_attr('load-more'); endif; ?>"><?php echo esc_html($button_text); ?></a>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- End of .template-showcase -->
        </div>
        <!-- End of .container -->
        <?php
        return ob_get_clean();
    }

}
