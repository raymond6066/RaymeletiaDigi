<?php

class CynicBlogVariations
{

    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_blog_variations', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $categories = cynic_get_categories();

            $args = array(
                'base' => 'cynic_blog_variations',
                'name' => __('Blog Variation 1', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'blog_categories',
                        'type' => 'dropdown',
                        'heading' => __('Categories', 'cynic'),
                        'value' => $categories,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'category_subtitle',
                        'type' => 'textfield',
                        'heading' => __('Category Subtitle', 'cynic'),
                        'value' => 'Category'
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
                        'param_name' => 'load_more_btn_txt',
                        'type' => 'textfield',
                        'heading' => __('Load More Button Text', 'cynic'),
                        'value' => 'Load More',
                        'dependency' => array(
                            'element' => 'load_more',
                            'value' => '1',
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
                'blog_categories' => '',
                'category_subtitle' => 'Category',
                'posts_per_page' => '3',
                'orderby' => 'ID',
                'order' => 'DESC',
                'load_more' => '1',
                'load_more_btn_txt' => 'Load More'
            ), $atts);
        extract($atts);
        ob_start();
        $categories = (array)get_category_by_slug($blog_categories); ?>
        <div class="container">
            <h2 class="section-title text-center"><?php echo $categories['name']; ?><?php echo " " .$category_subtitle; ?></h2>
            <?php
            if (isset($categories) && !empty($categories)) {
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => (int)$posts_per_page, // set number of post per category here
                    'category__in' => array($categories['term_id']),
                    'ignore_sticky_posts' => true
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) {
                    $thumbsize = "cynic-illustration-blog-variasion-thumb-img"; ?>
                    <div class="grid-wrapper">
                        <div class="row justify-content-center">
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                $isFeatured = cynic_get_meta('cynic_post_featured');
                                $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : ""; ?>
                                <div class="col-lg-4 col-md-6 <?php echo esc_attr($class); ?>">
                                    <a href="<?php the_permalink(); ?>" class="img-card news-card">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail($thumbsize, array('class' => 'img-fluid'));
                                        } ?>
                                        <div class="content">
                                            <h4>
                                                <?php echo get_the_date('j F, Y'); ?>
                                                <span><?php the_title(); ?></span>
                                            </h4>
                                        </div>

                                    </a>
                                    <!-- End of .img-card -->
                                </div>
                                <!-- End of .col-lg-4 -->
                                <?php
                            }
                            wp_reset_postdata();
                            if (isset($load_more) && $load_more == '1') {
                                $settings = ['category_id' => $categories['term_id'],
                                    'posts_per_page' => $posts_per_page, 'orderby' => $orderby, 'order' => $order];
                                $postCount = $query->found_posts;
                                $rand = rand(10, 100);
                                if ($postCount > $posts_per_page) { ?>
                                    <div class="col-lg-12 text-center">
                                        <a href="javascript:void(0)"
                                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                           data-pageno="1" data-unique="<?php echo esc_attr($rand); ?>"
                                           class="custom-btn secondary-btn load-more-cat-posts random-<?php echo esc_attr($rand); ?>"><?php echo $load_more_btn_txt; ?></a>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                        <!-- End of .row -->
                    </div>
                    <!-- End of .grid-wrapper -->
                    <?php
                }
            } ?>
        </div>
        <!-- End of .container -->
        <?php
        return ob_get_clean();
    }
}
