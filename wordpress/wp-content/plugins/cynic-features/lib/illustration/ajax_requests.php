<?php

class ajax_requests
{

    protected $ajax_onoce;

    public function __construct()
    {
        $this->ajax_onoce = 'cynicTrendy-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'cynic_ajax_enqueue'));

        /* Get Single Portfolio in Modal */
        add_action('wp_ajax_nopriv_cynic_get_single_post', array($this, 'cynic_get_single_post'));
        add_action('wp_ajax_cynic_get_single_post', array($this, 'cynic_get_single_post'));


        /* Get Load More Portfolio */
        add_action('wp_ajax_nopriv_cynic_get_illustration_post', array($this, 'cynic_get_illustration_post'));
        add_action('wp_ajax_cynic_get_illustration_post', array($this, 'cynic_get_illustration_post'));


        /* Get Load More Blog Version Two */
        add_action('wp_ajax_nopriv_cynic_get_illustration_blog_version_two', array($this, 'cynic_get_illustration_blog_version_two'));
        add_action('wp_ajax_cynic_get_illustration_blog_version_two', array($this, 'cynic_get_illustration_blog_version_two'));

        /* Get Single Page in Modal */
        add_action('wp_ajax_nopriv_cynic_pages_in_modal', array($this, 'cynic_pages_in_modal'));
        add_action('wp_ajax_cynic_pages_in_modal', array($this, 'cynic_pages_in_modal'));

    }

    function cynic_ajax_enqueue()
    {
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        wp_localize_script('jquery', 'cynicIllustration_feature_ajax', $params);
    }

    function cynic_get_single_post()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST['posttype']) && !empty($_POST['posttype']) && isset($_POST['settings']['post_id']) && !empty($_POST['settings']['post_id'])) {
            $post_type = $_POST['posttype'];
            $isModal = $_POST['isModal'];
            $post_id = $_POST['settings']['post_id'];
            if (in_array($post_type, array('portfolio', 'post'))) {
                global $wp_query;
                $args = array(
                    'post_type' => $post_type,
                    'post__in' => array((int)$post_id),
                    'showposts' => 1,
                );
                if ($post_type == 'page') {
                    $args['page_id'] = (int)$post_id;
                } elseif($post_type == 'post') {
                    $args['page_id'] = (int)$post_id;
                } else {
                    $args['static'] = '1';
                }
                if (class_exists('WPBMap')) { // load visual composer shortcodes
                    WPBMap::addAllMappedShortcodes();
                }
                query_posts($args);

                if ($isModal == 1 && isset($_POST['portfoliotype']) && $_POST['portfoliotype'] == "other") {
                    $template = locate_template("template-parts/illustration/modal-" . $post_type . '-single.php', false);
                } else if ($isModal == 1 && isset($_POST['portfoliotype']) && $_POST['portfoliotype'] == "video") {
                    $template = locate_template('template-parts/illustration/modal-' . $post_type . '-single-video.php', false);
                } else if ($isModal == 1 && isset($_POST['posttype']) && $_POST['posttype'] == "post") {
                    $template = locate_template('template-parts/illustration/modal-' . $post_type . '-single.php', false);
                } else {
                    switch ($post_type) {
                        case 'portfolio':
                            $template = locate_template('single-portfolio.php', false);
                            break;
                        case 'post':
                            $template = locate_template('single.php', false);
                            break;
                        default:
                            $template = get_page_template();
                            break;
                    }
                }

                if($template) {
                    load_template( $template , true);
                }
            }
            die();
        }
    }

    function cynic_get_illustration_post()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        $page = isset($_POST['pageno']) && $_POST['pageno'] ? (int)$_POST['pageno'] : 1;
        $posts_per_page = $_POST['settings']['posts_per_page'];
        $orderby = $_POST['settings']['orderby'];
        $order = $_POST['settings']['order'];
        $thumbsize = 'cynic-illustration-custom-blog';
        $read_more_text = $_POST['settings']['read_more_text'];

        $post_link = (isset($_POST['settings']['layouts']) && $_POST['settings']['layouts'] == 2) ? get_permalink() : "javascript:void(0)";
        $post_open_type = (isset($_POST['settings']['layouts']) && $_POST['settings']['layouts'] == 2) ? '' : " get-single-post";

        if ((int)$posts_per_page < 1) { // make sure that posts per page is not less than 0 or not -1
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
        ob_start();
        $thumbsize = "cynic-illustration-blog-thumb-img";
        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
                $isFeatured = get_post_meta(get_the_ID(), 'cynic_post_featured', true);
                $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                $video_popup = (isset($post_format) && $post_format == "video") ? " blog-video-popup" : "";
                $settings = ['post_id' => get_the_ID(), 'posttype' => 'post',
                    'posts_per_page' => $posts_per_page, 'orderby' => $orderby, 'order' => $order, 'read_more_text' => $read_more_text]; ?>

                <div class="col-lg-4 col-md-6<?php echo esc_attr($class) ?><?php echo esc_attr($video_popup) ?>">
                    <a href="<?php echo $post_link; ?>"
                       data-posttype="post"
                       data-action="cynic_get_single_post"
                       data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                       class="img-card news-card <?php echo esc_attr($post_open_type); ?>"
                       data-is-modal="1">
                        <?php if (has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail($thumbsize, array('class' => 'img-fluid')) ?>
                            <!-- End of .img-container -->
                        <?php } ?>
                        <h4>
                            <?php echo get_the_date('j F, Y') ?>
                            <span><?php the_title(); ?></span>
                        </h4>
                    </a>
                    <!-- End of .img-card -->
                </div>
                <!-- End of .col-lg-4 -->
                <?php
            endwhile;
            $return['outputs'] .= ob_get_clean();
        }
        echo json_encode($return);
        die();
    }

    function cynic_pages_in_modal()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST['postID']) && !empty($_POST['postID'])) {
            if (class_exists('WPBMap')) { // load visual composer shortcodes
                WPBMap::addAllMappedShortcodes();
            }
            $return = array();
            $postID = $_POST['postID'];
            $args = array(
                'post_type' => 'page',
                'showposts' => 1,
                'page_id' => (int)$postID,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()) {
                    $query->the_post();
                    $_pageTitle = cynic_get_meta("cynic_page_title");
                    if (isset($_pageTitle) && $_pageTitle == 2) : ?>
                        <h2 class="section-title text-center"><?php the_title(); ?></h2>
                        <?php
                    endif;
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'img-fluid modal-feat-img'));
                    }
                    the_content();
                }
                $return['outputs'] .= ob_get_clean();
                echo json_encode($return);
                die();
            }
        }

    }


    function cynic_get_illustration_blog_version_two()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        $page = isset($_POST['pageno']) && $_POST['pageno'] ? (int)$_POST['pageno'] : 1;
        $posts_per_page = $_POST['settings']['posts_per_page'];
        $orderby = $_POST['settings']['orderby'];
        $order = $_POST['settings']['order'];
        $categories = $_POST['settings']['category_id'];

        if ((int)$posts_per_page < 1) { // make sure that posts per page is not less than 0 or not -1
            echo json_encode($return);
            die();
        }
        if (isset($categories) && !empty($categories)) {
            $offset = $page * (int)$posts_per_page;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => (int)$posts_per_page,
                'category__in' => array($categories['term_id']),
                'orderby' => $orderby,
                'order' => $order,
                'offset' => $offset,
                'ignore_sticky_posts' => true,
            );
            $query = new WP_Query($args);
            $query->found_posts;
            $return['total'] = $query->found_posts;
            ob_start();
            $thumbsize = "cynic-illustration-blog-variasion-thumb-img";
            if ($query->have_posts()) {
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
                $return['outputs'] .= ob_get_clean();
            }
            echo json_encode($return);
            die();
        }
    }

}

new ajax_requests();
