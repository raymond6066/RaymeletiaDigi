<?php

class CynicLatestBlog
{

    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_latest_blog', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();
            $args = array(
                'base' => 'cynic_latest_blog',
                'name' => __('Latest Blog', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
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
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Block Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Show Posts',
                        'type' => 'dropdown',
                        'param_name' => 'posts_per_page',
                        'value' => array(
                            '6' => '6',
                            '9' => '9',
                            '12' => '12'
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
                'layouts' => '1',
                'title' => '',
                'posts_per_page' => '9',
                'orderby' => 'ID',
                'order' => 'DESC'
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => (int)$posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => false,
        );
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) { ?>
            <div class="container">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
            <!-- End of .container -->
            <div class="news-slider common-slider">
                <div class="carousel-container equalHeightWrapper">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        $isFeatured = cynic_get_meta('cynic_post_featured');
                        $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                        $categories = get_the_category();
                        $thumb_size = "cynic-trendy-blog-thumbnails";
                        $settings = ['post_type' => 'post', 'post_id' => get_the_ID()];
                        $post_format = get_post_format();
                        $video_popup = (isset($post_format) && $post_format == "video") ? " blog-video-popup" : ""; ?>
                        <div class="item<?php echo esc_attr($class) ?> equalHeightWrapper">
                            <?php if($layouts == 2) { ?>
                                <a href="<?php the_permalink(); ?>"
                                   class="news-content-block content-block">
                                    <?php if (has_post_thumbnail()) { ?>
                                    <div class="img-container<?php echo esc_attr($video_popup) ?>">
                                        <?php the_post_thumbnail($thumb_size, array('class' => 'img-fluid')) ?>
                                    </div>
                                    <!-- End of .img-container -->
                                <?php } ?>
                                <h5 class="equalHeight">
                                    <span class="content-block__sub-title"><?php echo get_the_date() ?></span>
                                    <?php the_title(); ?>
                                </h5>
                                </a>
                                <?php
                            } else { ?>
                                <a href="javascript:void(0)"
                                   data-posttype="post"
                                   data-actions="cynic_single_post_content"
                                   data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                   class="news-content-block content-block cynic-blog-single-content">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="img-container<?php echo esc_attr($video_popup) ?>">
                                            <?php the_post_thumbnail($thumb_size, array('class' => 'img-fluid')) ?>
                                        </div>
                                        <!-- End of .img-container -->
                                    <?php } ?>
                                    <h5 class="equalHeight">
                                        <span class="content-block__sub-title"><?php echo get_the_date() ?></span>
                                        <?php the_title(); ?>
                                    </h5>
                                </a>
                                <?php
                            } ?>
                            <!-- End of .featured-content-block -->
                        </div>
                        <!-- End of .item -->
                        <?php
                    } ?>
                </div>
                <!-- End of .carousel-container -->
            </div>
            <?php
            wp_reset_postdata();
        }
        return ob_get_clean();
    }

}
