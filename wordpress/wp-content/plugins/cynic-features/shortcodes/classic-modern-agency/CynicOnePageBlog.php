<?php

class CynicOnePageBlog {

    public static $securityNonce, $noncePlain;
    public function __construct() {
        add_shortcode('cynic_onepage_blog_grids', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_ajax_get_onepage_blog', array($this, 'get_onepage_blog'));
        add_action('wp_ajax_nopriv_get_onepage_blog', array($this, 'get_onepage_blog'));
        
        add_action('wp_ajax_onepage_single_blog', array($this, 'onepage_single_blog'));
        add_action('wp_ajax_nopriv_onepage_single_blog', array($this, 'onepage_single_blog'));
        self::$noncePlain = 'd24d#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            /* Get All Pages*/
            
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }

            $args = array(
                'base' => 'cynic_onepage_blog_grids',
                'name' => __('Modern Latest News', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Blog Functionality',
                        'type' => 'dropdown',
                        'param_name' => 'blog_functionality',
                        'value' => array(
                            'Onepage' => '1',
                            'Multipage' => '2'
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Link Type',
                        'type' => 'dropdown',
                        'param_name' => 'link_type',
                        'dependency' => array(
                            'element' => 'blog_functionality',
                            'value' => '2',
                        ),
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2'
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Internal Link',
                        'type' => 'dropdown',
                        'param_name' => 'internal_link',
                        'dependency' => array(
                            'element' => 'link_type',
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
                            'element' => 'link_type',
                            'value' => '2',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'dependency' => array(
                            'element' => 'blog_functionality',
                            'value' => '2',
                        ),
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'dropdown',
                        'heading' => __('Show News', 'cynic'),
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
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
        array(
            'posts_per_page'=> '3',
            'blog_functionality'=> '1',
            'link_type'=> '',
            'internal_link'=> '',
            'external_link'=> '',
            'open_type'=> '0',
            'orderby'=> 'ID',
            'order'=> 'DESC',
            'load_more'=> '1',
            'button_text' => ''
        ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) {
            $thumbsize = "cynic-onepage-portfolio-img";
            echo '<div class="onepage-blog">';
                ?>
                <div class="row">
                    <?php while ($query->have_posts()) { ?>
                        <div class="col-xs-12 col-sm-4">
                            <?php
                            $query->the_post();
                            $isFeatured = cynic_get_meta('cynic_post_featured');
                            $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";
                            $categories = get_the_category();
                            ?>
                            <div class="box-content-with-img onepage-news-equalheight"> 
                                <div class="img-container <?php echo esc_attr($class); ?>">
                                    <?php the_post_thumbnail($thumbsize, array('class'=>'img-responsive'))?>
                                </div>
                                <div class="box-content-text">
                                    <p class="gray-text"><?php echo get_the_date(); ?> </p>
                                    <?php if(isset($blog_functionality) && $blog_functionality =='1') { ?>
                                        <h3 class="semi-bold"><a href="javascript:void(0)" class="one-page-blog-single" data-posttype="post" data-postid="<?php the_ID(); ?>" data-action="onepage_single_blog"><?php the_title(); ?></a></h3>
                                    <?php } else { ?>
                                        <h3 class="semi-bold"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                    <?php } ?>
                                    <?php the_excerpt()?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!--row-->
                <?php if(isset($load_more) && $load_more=='1') {?>
                <div class="row">
                    <div class="col-xs-12"> 
                        <?php if(isset($blog_functionality) && $blog_functionality=='1') { ?>
                            <a href="javascript:void(0)" class="btn btn-fill full-width blog-modal" data-attr="onepage-blog" data-cat-id="no-cat" data-post-id="<?php echo (int)esc_attr(get_the_ID()); ?>" data-page="1" data-nonce="<?php echo self::$securityNonce?>" data-action="get_onepage_blog" data-pp="<?php echo (int)$posts_per_page;?>"><?php echo (isset($button_text) && !empty($button_text)) ? esc_html($button_text) : esc_html__("load more", "cynic") ?></a> 
                        <?php } else { 
                            $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link;
                            $url = (isset($link) && !empty($link)) ? get_permalink((int) $internal_link) : "#"; ?>
                            <a href="<?php echo esc_url($link) ?>" <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?> class="btn btn-fill full-width"><?php echo (isset($button_text) && !empty($button_text)) ? esc_html($button_text) : esc_html__("load more", "cynic") ?></a> 
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <!--end read more blog button--> 
                <?php
                wp_reset_postdata();
            echo "</div>";
            return ob_get_clean();
        }
        
    }

    function get_onepage_blog() {
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
        $thumbsize = 'cynic-onepage-portfolio-img';
        if((int)$posts_per_page < 1){ // make sure that posts per page is not less than 0 or not -1
                echo json_encode($return);
                die();
        }
        $offset = $page * (int)$posts_per_page;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => (int)$posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $query->found_posts;
        $return['total'] = $query->found_posts;
        
        if ($query->have_posts()) { 
            ob_start();
            while ($query->have_posts()) : $query->the_post();?>
                <!--blog content box-->
                <div class="col-xs-12 col-sm-4">
                    <div class="box-content-with-img onepage-news-equalheight"> <?php the_post_thumbnail($thumbsize, array('class'=>'img-responsive'))?>
                        <div class="box-content-text">
                            <p class="gray-text"><?php echo get_the_date(); ?> </p>
                            <h3 class="semi-bold"><a href="javascript:void(0)" class="one-page-blog-single" data-posttype="post" data-postid="<?php the_ID(); ?>" data-action="onepage_single_blog"><?php the_title(); ?></a></h3>
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
    
    function onepage_single_blog(){
        $return = array();
        $postID = $_POST['postid'];
        $args = array(
            'post_type' => 'post',
            'p' => $postID,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) { 
            ob_start();
            $return['outputs'] .= '<div class="container-fluid">';
                while ($query->have_posts()) : $query->the_post();
                $post_format = get_post_format(); ?>
                    <!--section title -->
                    <p class="gray-text"><?php echo get_the_date(); ?></p>
                    <h2 class="gray-title"><?php the_title(); ?></h2>
                    <!--end section title -->
                    <div class="row">
                        <!--blog content box-->
                        <div class="col-sm-12">
                            <div class="blog-details-content details-v2">
                                <?php if(isset($post_format) && $post_format!="video") { the_post_thumbnail('full', array('class' => 'blog img-responsive')); } ?>
                                <div>
                                    <?php 
                                    global $post;
                                    $my_postid = $post->ID;
                                    $content_post = get_post($my_postid);
                                    $content = $content_post->post_content;
                                    echo $content = apply_filters('the_content', $content);?>
                                </div>
                                <!--blog share-->
                            </div>
                        </div>
                        <!--end blog content box-->
                    </div>
                <?php 
                endwhile; 
                $return['outputs'] .= ob_get_clean();
            $return['outputs'] .= '</div>';
        }
        echo json_encode($return);
        die(); //end of cycle
    }

}
