<?php

class CynicCustomBlog {

    public static $securityNonce, $noncePlain;
    public function __construct() {
        add_shortcode('cynic_custom_blog_grids', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $categories = cynic_get_categories('category');
            $args = array(
                'base' => 'cynic_custom_blog_grids',
                'name' => __('Custom Blog Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Categories"),
                        "param_name" => "cat_param",
                        "admin_label" => true,
                        "value" => $categories, //value
                        "std" => "",
                        "description" => __("Please choose the category.")
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'dropdown',
                        'heading' => __('Show Blogs', 'cynic'),
                        'value' => array(
                            '3' => '3',
                            '6' => '6',
                            '9' => '9',
                            '12' => '12',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'term_id',
                            'Title' => 'name',
                            'Url Slug' => 'slug'
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
                        'heading' => 'Category Title',
                        'type' => 'textfield',
                        'param_name' => 'cat_title'
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Load More Text',
                        'type' => 'textfield',
                        'param_name' => 'load_more_text'
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'cat_param'=>'',
                'posts_per_page'=> '3',
                'orderby'=> 'term_id',
                'order'=> 'DESC',
                'load_more'=> '1',
                'cat_title' => '',
                'load_more_text' => 'Load More'
            ), $atts);
        extract($atts);
        ob_start();
        $termsArgs = array(
            'taxonomy'=>'category',
            'orderby' => $orderby,
            'order' => $order,
        );

        $cat_array = explode(',', $cat_param);
        $cat_in = "'" . implode ( "','", $cat_array ) . "'";

        global $wpdb;
        $categories = $wpdb->get_results("SELECT wt.term_id, wt.name, wt.slug, wtt.taxonomy FROM $wpdb->terms wt, $wpdb->term_taxonomy wtt  
            WHERE wt.term_id=wtt.term_id AND wtt.taxonomy='category' AND wt.slug!='uncategorized' 
            AND wt.slug IN ($cat_in) ORDER BY wt.{$orderby} {$order}");
        if(!empty($categories) && !is_wp_error($categories)){ ?>
            <div class="trigger-project"></div>
            <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
            <div class="container">
                <?php
                $thumbsize = "cynic-trendy-custom-blog";
                $cat_title = !empty($cat_title) ? $cat_title : "";
                foreach($categories as $cat){ ?>
                    <div class="blog-by-category section-padding">
                        <h2 class="text-center"><?php echo esc_html($cat->name); ?> <?php echo esc_html($cat_title); ?></h2>
                        <div class="blog-grid text-center equalHeightWrapper <?php echo esc_attr(strtolower($cat->slug));?>">

                                <?php
                                $args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => (int)$posts_per_page, // set number of post per category here
                                    'category__in' => array($cat->term_id),
                                    'ignore_sticky_posts' => true
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) { ?>
                                    <div class="row">
                                        <?php
                                        $counter = 0;
                                        while ($query->have_posts()) : $query->the_post();
                                            $isFeatured = cynic_get_meta('cynic_post_featured');
                                            $class = (isset($isFeatured) && $isFeatured==1) ? "featured-item": ""; ?>
                                            <!--blog content box-->
                                            <div class="item col-md-6 col-lg-4 <?php echo esc_attr($class)?>">
                                                <a href="<?php the_permalink()?>" class="news-content-block content-block">
                                                    <div class="img-container">
                                                        <?php
                                                        if(has_post_thumbnail()){
                                                            the_post_thumbnail($thumbsize, array('class'=>'img-fluid'));
                                                        } ?>
                                                    </div>
                                                    <!-- End of .img-container -->
                                                    <h5 class="equalHeight">
                                                        <span class="content-block__sub-title"><?php the_date(); ?></span>
                                                        <?php the_title(); ?>
                                                    </h5>
                                                </a>
                                                <!-- End of .featured-content-block -->
                                            </div>
                                            <!--end blog content box-->
                                        <?php endwhile; ?>
                                    </div>
                                    <?php
                                    $settings = ['post_type' => 'post', 'cat_id' => $cat->term_id, 'category_slug' => $cat->slug, 'pp' => $posts_per_page,
                                        'orderby'=> $orderby, 'order'=>$order];
                                    if(isset($load_more) && $load_more=='1') {
                                        $postCount = $query->found_posts;
                                        if($postCount>$posts_per_page) { ?>
                                            <a href="javascript:void(0)"
                                               data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                               data-pageno="1"
                                               class="custom-btn btn-big grad-style-ef btn-full getCustomBlog">
                                                <?php echo esc_html($load_more_text); ?></a>
                                            <?php
                                        }
                                    } ?>
                                    <?php
                                } ?>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            <?php
        }
        return ob_get_clean();
    }

}
