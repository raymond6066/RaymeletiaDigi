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
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Layouts',
                        'type' => 'dropdown',
                        'param_name' => 'layouts',
                        'value' => array(
                            'One Page' => '1',
                            'Multipage' => '2'
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Show Posts',
                        'type' => 'dropdown',
                        'param_name' => 'posts_per_page',
                        'value' => array(
                            '3' => '3',
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
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Read More Text',
                        'type' => 'textfield',
                        'param_name' => 'read_more_text',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Display Load More Button',
                        'type' => 'dropdown',
                        'param_name' => 'display_load_more',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '2',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Load More Button text',
                        'type' => 'textfield',
                        'param_name' => 'load_more_text',
                        'value' => '',
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
                    ),
                    array(
                        "holder" => "",
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                            'Bookmark' => '3'
                        ),
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => array('2'),
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
                        "holder" => "",
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
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bookmark Link',
                        'type' => 'textfield',
                        'param_name' => 'bookmark_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '3',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('1', '2'),
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
                'layouts' => '1',
                'posts_per_page' => 3,
                'orderby' => 'ID',
                'order' => 'DESC',
                'read_more_text' => 'READ MORE',
                'display_load_more' => '1',
                'load_more_text' => 'LOAD MORE',
                'button_link' => '#',
                'internal_link' => '#',
                'external_link' => '#',
                'bookmark_link' => '#',
                'open_type' => '',
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => (int)$posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) { ?>
            <div class="container">
                <div class="grid-wrapper">
                    <div class="row justify-content-center latest-news">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $isFeatured = get_post_meta(get_the_ID(), 'cynic_post_featured', true);
                            $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                            $thumb_size = "cynic-illustration-blog-thumb-img";
                            $post_format = get_post_format();
                            $settings = ['post_id' => get_the_ID(), 'posttype' => 'post',
                                'posts_per_page' => $posts_per_page, 'orderby' => $orderby, 'order' => $order,
                                'read_more_text' => $read_more_text, 'layouts' => $layouts];
                            $video_popup = (isset($post_format) && $post_format == "video") ? " blog-video-popup" : "";
                            $post_link = (isset($layouts) && $layouts == 2) ? get_permalink() : "javascript:void(0)";
                            $post_open_type = (isset($layouts) && $layouts == 2) ? '' : " get-single-post"; ?>
                            <div class="col-lg-4 col-md-6<?php echo esc_attr($class) ?><?php echo esc_attr($video_popup) ?>">
                                <a href="<?php echo $post_link; ?>"
                                   data-posttype="post"
                                   data-action="cynic_get_single_post"
                                   data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                   class="img-card news-card<?php echo esc_attr($post_open_type); ?>"
                                   data-is-modal="1">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <?php the_post_thumbnail($thumb_size, array('class' => 'img-fluid')) ?>
                                    <?php } ?>
                                    <div class="content">
                                        <h4>
                                            <?php echo get_the_date('j F, Y'); ?>
                                            <span><?php the_title(); ?></span>
                                        </h4>
                                    </div>
                                </a>
                            </div>
                            <!-- End of .item -->
                            <?php
                        }
                        if ($display_load_more == 1 && !empty($load_more_text)) { ?>
                            <div class="col-lg-12 text-center">
                                <?php
                                if(isset($layouts) && $layouts==1) { ?>
                                    <a href="javascript:void(0)" class="custom-btn secondary-btn load-more"
                                       data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                       data-pageno="1"><?php echo esc_html($load_more_text); ?></a>
                                    <?php
                                } else {
                                    $link = cynic_get_links($button_link, $internal_link, $external_link);
                                    $page_scroll = ($button_link == 3) ? " page-scroll" : "";
                                    if ($button_link == 3) {
                                        $link = $bookmark_link;
                                    }
                                    if (!empty($link)) { ?>
                                        <a href="<?php echo esc_url($link); ?>"
                                            <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?>
                                           class="custom-btn secondary-btn<?php echo esc_attr($page_scroll) ?>">
                                            <?php echo esc_html($load_more_text); ?></a>
                                        <?php
                                    }
                                }?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- End of .carousel-container -->
                </div>
            </div>
            <?php
            wp_reset_postdata();
        }
        return ob_get_clean();
    }

}
