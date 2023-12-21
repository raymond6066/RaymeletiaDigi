<?php

class CynicCustomBlogGrids {

    public static $securityNonce, $noncePlain;
    public function __construct() {
        add_shortcode('cynic_custom_blog_grids', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_ajax_get_custom_blog_by_category', array($this, 'get_custom_blog_by_category'));
        add_action('wp_ajax_nopriv_get_custom_blog_by_category', array($this, 'get_custom_blog_by_category'));
        self::$noncePlain = 'd24d#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_custom_blog_grids',
                'name' => __('Custom Blog Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'blog_version_style',
                        'type' => 'dropdown',
                        'heading' => __('Blog Version', 'cynic'),
                        'value' => array(
                            'Modern Version' => 'modern',
                            'Classic Version' => 'classic',
                        ),
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
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'blog_version_style'=>'modern',
                'posts_per_page'=> '3',
                'orderby'=> 'ID',
                'order'=> 'DESC',
                'load_more'=> '1',
            ), $atts);
        extract($atts);
        ob_start();
        $termsArgs = array(
            'taxonomy'=>'category',
            'orderby' => $orderby,
            'order' => $order,
        );

        $categories = get_terms( $termsArgs ); ?>
        <?php
        if(!empty($categories) && !is_wp_error($categories)){
            $blog_type = "classic";
            if(isset($blog_version_style) && $blog_version_style=='classic'){
                $blog_type = "classic";
                $thumbsize = 'cynic-portfolio-hveq';
            }else{
                $blog_type = "modern";
                $thumbsize = 'cynic-onepage-portfolio-img';
            }
            foreach($categories as $cat){ ?>
                <div class="<?php echo esc_attr(strtolower($cat->slug));?> bg-white">
                    <!--blog content row two-->
                    <h2 class="b-clor"><?php esc_html_e($cat->name, 'cynic')?></h2>
                    <hr class="dark-line" />
                    <!--end section title -->
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
                            $class = (isset($isFeatured) && $isFeatured==1) ? "is-featured": ""; ?>
                            <!--blog content box-->
                            <div class="col-xs-12 col-sm-4">
                                <div class="box-content-with-img onepage-news-equalheight <?php echo esc_attr($blog_type); ?> <?php echo esc_attr($class); ?>"> <?php the_post_thumbnail($thumbsize, array('class'=>'img-responsive'))?>
                                    <div class="box-content-text">
                                        <p class="gray-text"><span class="icon-calendar-full"></span><?php echo get_the_date(); ?> </p>
                                        <h3 class="semi-bold"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                                        <p class="regular-text"<?php the_excerpt()?></p>
                                    </div>
                                </div>
                            </div>
                            <!--end blog content box-->
                            <?php if($posts_per_page > 3 && $counter % 3 === 2) { ?>
                                </div><div class="row">
                            <?php } ?>
                            <?php $counter++; endwhile; ?>
                        </div>
                        <div class="row">
                            <?php if(isset($load_more) && $load_more=='1') {
                                $postCount = $query->found_posts;
                                if($postCount>$posts_per_page){?>
                                    <div class="col-xs-12"> <a href="javascript:void(0)" class="btn btn-fill full-width blog-modal" data-attr="<?php echo esc_attr(strtolower($cat->slug))?>" data-cat-id="<?php echo (int)esc_attr($cat->term_id); ?>" data-post-id="<?php echo (int)esc_attr(get_the_ID()); ?>" data-page="1" data-nonce="<?php echo self::$securityNonce?>" data-action="get_custom_blog_by_category" data-pp="<?php echo (int)$posts_per_page;?>">load more</a> </div>
                                <?php } } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php
            }
        } ?>
        <?php
        //endif;
        //wp_reset_postdata();
        return ob_get_clean();
    }

    function get_custom_blog_by_category() {
        $return = array();
        if(!isset($_POST['security_nonce']) || !wp_verify_nonce($_POST['security_nonce'], self::$noncePlain)){
            echo json_encode($return);
            die();
        }
        $page = isset($_POST['pageno']) && $_POST['pageno'] ? (int)$_POST['pageno']: 1;
        $posts_per_page = $_POST['pp'];
        $orderby = $_POST['orderby'];
        $order = $_POST['order'];
        $catid = $_POST['catid'];
        $thumbsize = 'cynic-portfolio-hveq';
        if((int)$posts_per_page < 1){ // make sure that posts per page is not less than 0 or not -1
            echo json_encode($return);
            die();
        }
        $offset = $page * (int)$posts_per_page;
        $args = array(
            'post_type' => 'post',
            'category__in' => array($catid),
            'posts_per_page' => (int)$posts_per_page,
            'offset' => $offset,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $query->found_posts;
        $return['total'] = $query->found_posts;

        if ($query->have_posts()) {
            $blog_type = "classic";
            if(isset($blog_version_style) && $blog_version_style=='classic'){
                $blog_type = "classic";
                $thumbsize = 'cynic-portfolio-hveq';
            }else{
                $blog_type = "modern";
                $thumbsize = 'cynic-onepage-portfolio-img';
            }
            ob_start();
            while ($query->have_posts()) : $query->the_post();?>
                <!--blog content box-->
                <div class="col-xs-12 col-sm-4">
                    <div class="box-content-with-img onepage-news-equalheight <?php echo esc_attr($blog_type); ?>"> <?php the_post_thumbnail($thumbsize, array('class'=>'img-responsive'))?>
                        <div class="box-content-text">
                            <p class="gray-text"><span class="icon-calendar-full"></span><?php echo get_the_date(); ?> </p>
                            <h3 class="semi-bold"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                            <p class="regular-text"><?php the_excerpt()?></p>
                        </div>
                    </div>
                </div>
                <!--end blog content box-->
                <?php
            endwhile;
            $return['outputs'] .= ob_get_clean();
        }
        echo json_encode($return);
        die(); //end of cycle
    }

}
