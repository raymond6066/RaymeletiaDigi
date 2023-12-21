<?php
class CynicSeoLatestBlog {
    public function __construct() {
        add_shortcode('cynic_seo_latest_blog', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $postsarr = cynicSEO_get_all_case_studies($post_type="post");
            $args = array(
                'base' => 'cynic_seo_latest_blog',
                'name' => __('Latest Blog', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Blog Row stretch',
                        'type' => 'dropdown',
                        'param_name' => 'blog_layout',
                        'value' => array(
                            'Default' => 'default',
                            'Full Width' => 'full',
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
                        'heading' => 'Display Blog',
                        'type' => 'dropdown',
                        'param_name' => 'blog_from',
                        'value' => array(
                            'Random' => 'random',
                            'From List' => 'from_list',
                        ),
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select BLogs"),
                        "param_name" => "selective_blog",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => "",
                        "description" => __(getCustomPostTypeAdminUrl('post')),
                        'dependency' => array(
                            'element' => 'blog_from',
                            'value' => 'from_list',
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
                        'heading' => 'Read More Button Text',
                        'type' => 'textfield',
                        'param_name' => 'read_more_button_text',
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $attributes = shortcode_atts(
        array(
            'blog_layout'=>'default',
            'posts_per_page'=>'3',
            'blog_from'=>'random',
            'selective_blog' => '',
            'orderby' => 'ID',
            'order' => 'DESC',
            'read_more_button_text' => 'Read More',
        ), $atts);

        $blog_layout = $attributes['blog_layout'];
        $posts_per_page = $attributes['posts_per_page'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];
        $read_more_button_text = $attributes['read_more_button_text'];
        $blog_from = $attributes['blog_from'];
        $selective_blog = $attributes['selective_blog'];
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        if(isset($blog_from) && $blog_from=="from_list") {
            $postNames = explode(',', $selective_blog);
            if($orderby=="ID"){
                if($order=="ASC") {
                    ksort($postNames);
                } else {
                    krsort($postNames);
                }
            }else{
                if($order=="ASC") {
                    asort($postNames);
                } else {
                    arsort($postNames);
                }
            }
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => (int) $posts_per_page,
                'post_name__in' => $postNames,
                'orderby'=> 'post_name__in',
                'order' => $order,
                'ignore_sticky_posts' => true
            );
        }
        $query = new WP_Query($args);
        ob_start();
        if ($query->have_posts()) { 
            if($blog_layout=="default") { ?>
            <div class="container">
            <?php } ?>
                <div class="blog-content-wrapper">
                    <div class="row">
                        <?php 
                        $thumbsize = "cynic-recent-blog-thumbnail";
                        while($query->have_posts()){
                            $query->the_post(); 
                            $class1 = "order-md-2";
                            $class2 = "order-md-1";
                            $image_position = get_post_meta(get_the_ID(),'cynic_post_image_position', true);
                            if (isset($image_position) && $image_position==2) {
                                $class1 = "order-md-1";
                                $class2 = "order-md-2";
                            } 
                            $video_length = get_post_meta(get_the_ID(),'cynic_post_image_video_length',true);?>
                            <div class="col-md-4">
                                <?php if(get_post_format()=="video") { ?>
                                    <div class="blog-content video-container">
                                        <div class="img-container <?php echo esc_attr($class2) ?>">
                                            <?php 
                                            if(has_post_thumbnail()) {
                                                the_post_thumbnail($thumbsize, array('class' => 'img-fluid')); 
                                            } ?>
                                            <a href="<?php the_permalink(); ?>" class="overlay d-flex">
                                                <div class="inner-content my-auto text-center">
                                                    <img src="<?php echo CYNIC_THEME_URI ?>/images/play-1.svg" alt="video">
                                                    <?php if( get_post_format() == "video" && isset($video_length) && !empty($video_length)) { ?>
                                                        <span><?php echo esc_html($video_length); ?></span>
                                                    <?php } ?>
                                                </div>
                                                <!-- End of .inner-content -->
                                            </a>
                                            <!-- End of .overlay -->
                                        </div>
                                        <!-- End of .img-container -->
                                        <div class="text-content equalHeight  text-left <?php echo esc_attr($class1) ?>">
                                            <span><?php the_date(); ?> </span>
                                            <h3>
                                                <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                                            </h3>
                                            <p><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="readmore-btn">
                                                <div> <?php echo esc_html_cynicSEO_string($read_more_button_text); ?>
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                            <!-- End of .readmore-btn -->
                                        </div>
                                        <!-- End of .text-content -->
                                    </div>
                                <?php } else { ?>
                                    <div class="blog-content">
                                        <a href="<?php the_permalink(); ?>" class="img-container <?php echo esc_attr($class2) ?>">
                                            <?php 
                                            if(has_post_thumbnail()) {
                                                the_post_thumbnail($thumbsize, array('class' => 'img-fluid')); 
                                            } ?>
                                        </a>
                                        <!-- End of .img-container -->
                                        <div class="text-content equalHeight  text-left <?php echo esc_attr($class1) ?>">
                                            <span><?php the_date(); ?> </span>
                                            <h3>
                                                <a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a>
                                            </h3>
                                            <p><?php the_excerpt() ?></p>
                                            <a href="<?php the_permalink(); ?>" class="readmore-btn">
                                                <div> <?php echo esc_html($read_more_button_text); ?>
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </div>
                                            </a>
                                            <!-- End of .readmore-btn -->
                                        </div>
                                        <!-- End of .text-content -->
                                    </div>
                                <?php } ?>
                                <!-- End of .content -->
                            </div>
                            <!-- End of .col-md-4 -->
                        <?php } ?>
                    </div>
                    <!-- End of .row -->
                </div>
            <?php if($blog_layout=="default") {?>
            </div>
            <?php } ?>
            <?php
            wp_reset_postdata();
            return ob_get_clean();
        }
    }
}