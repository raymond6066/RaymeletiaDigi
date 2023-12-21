<?php

class ajax_requests
{

    protected $ajax_onoce;

    public function __construct()
    {
        $this->ajax_onoce = 'cynicTrendy-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'cynic_ajax_enqueue'));

        /* Get Single Portfolio in Modal */
        add_action('wp_ajax_nopriv_cynic_single_post_content', array($this, 'cynic_single_post_content'));
        add_action('wp_ajax_cynic_single_post_content', array($this, 'cynic_single_post_content'));

        /* Get All Portfolio Load More */
        add_action('wp_ajax_nopriv_cynic_get_all_posts_content', array($this, 'cynic_get_all_posts_content'));
        add_action('wp_ajax_cynic_get_all_posts_content', array($this, 'cynic_get_all_posts_content'));

        /* Get Single Post in Modal */
        add_action('wp_ajax_nopriv_cynic_blog_single_post_content', array($this, 'cynic_blog_single_post_content'));
        add_action('wp_ajax_cynic_blog_single_post_content', array($this, 'cynic_blog_single_post_content'));

        /* Get Single Page in Modal */
        add_action('wp_ajax_nopriv_cynic_pages_in_modal', array($this, 'cynic_pages_in_modal'));
        add_action('wp_ajax_cynic_pages_in_modal', array($this, 'cynic_pages_in_modal'));

        /* Get Single Case Studies in Modal */
        add_action('wp_ajax_nopriv_cynic_case_studies_slider_modal_content', array($this, 'get_case_studies_modal_post_content'));
        add_action('wp_ajax_cynic_case_studies_slider_modal_content', array($this, 'get_case_studies_modal_post_content'));

        /* Custom Blocks */
        add_action('wp_ajax_nopriv_cynic_get_custom_blog', array($this, 'cynic_get_custom_blog'));
        add_action('wp_ajax_cynic_get_custom_blog', array($this, 'cynic_get_custom_blog'));

    }

    function cynic_ajax_enqueue()
    {
        $theme_type = CYNIC_THEME_TYPE;
        if( $theme_type == "trendy-agency"){
            wp_enqueue_script( 'cynic-core-ajax', AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/trendy-agency/js/plugin-scripts.js', array('jquery'), null, true );
        }
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        if( $theme_type == "trendy-agency"){
            wp_localize_script('cynic-core-ajax', 'cynicTrendy_feature_ajax', $params);
        } else{
            wp_localize_script('jquery', 'cynicTrendy_feature_ajax', $params);
        }
    }


    function cynic_single_post_content()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST['settings']['post_type']) && !empty($_POST['settings']['post_type']) && isset($_POST['settings']['post_id']) && !empty($_POST['settings']['post_id'])) {
            $post_type = $_POST['settings']['post_type'];
            $post_id = $_POST['settings']['post_id'];

            if (in_array($post_type, array('portfolio'))) {
                global $wp_query;
                $args = array(
                    'post_type' => $post_type,
                    'post__in' => array((int)$post_id),
                    'showposts' => 1,
                );
                if ($post_type == 'page') {
                    $args['page_id'] = (int)$post_id;
                } else {
                    $args['static'] = '1';
                }
                if (class_exists('WPBMap')) { // load visual composer shortcodes
                    WPBMap::addAllMappedShortcodes();
                }
                query_posts($args);
                switch ($post_type) {
                    case 'portfolio':
                        $template = locate_template('single-portfolio-content.php', false);
                        break;
                    default:
                        $template = get_page_template();
                        break;
                }
                load_template($template, true);

            }
            die();
        }
    }

    /* Portfolio Load More */
    function cynic_get_all_posts_content()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST) && !empty($_POST)) {

            $page = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;
            $posts_per_page = (isset($_POST['settings']['posts_per_page']) && !empty($_POST['settings']['posts_per_page'])) ? $_POST['settings']['posts_per_page'] : "6";
            $orderby = (isset($_POST['query']['orderby']) && !empty($_POST['query']['orderby'])) ? $_POST['query']['orderby'] : "ID";
            $order = (isset($_POST['query']['order']) && !empty($_POST['query']['order'])) ? $_POST['query']['order'] : "ASC";

            $offset = $page * (int)$posts_per_page;
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => (int) $posts_per_page,
                'orderby' => $orderby,
                'order' => $order,
                'offset' => $offset,
                'ignore_sticky_posts' => true,
            );

            $query = new WP_Query($args);



            $return = array();
            $found_posts = (int)$query->found_posts;
            $return['posts_count'] = $found_posts;

            if ($query->have_posts()) {
                ob_start();
                $thumbsize = 'cynic-trendy-portfolio-img';
                $taxonomy = 'portfolio-cat';
                $termsArgs = array('taxonomy' => $taxonomy, 'hide_empty' => false);
                $categories = get_terms($termsArgs);

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
                    $settings = ['post_type' => 'portfolio', 'post_id' => get_the_ID()];
                    $isFeatured = get_post_meta(get_the_ID(),'portfolio_featured', TRUE);
                    $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : ""; ?>
                    <div class="<?php echo esc_attr($relativecatcls) ?><?php echo esc_attr($class) ?> grid-item col-md-6 col-lg-4">
                        <?php if ($portfolio_type == 1) { ?>
                            <a href="<?php echo $video_url; ?>"
                               class="video-popup featured-content-block content-block">
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
            $return['outputs'] .= ob_get_clean();
            echo json_encode($return);
            die();
        }
    }

    function cynic_blog_single_post_content()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST['settings']['post_type']) && !empty($_POST['settings']['post_type']) && isset($_POST['settings']['post_id']) && !empty($_POST['settings']['post_id'])) {
            $return = array();
            $post_type = $_POST['settings']['post_type'];
            $postID = $_POST['settings']['post_id'];
            $args = array(
                'post_type' => $post_type,
                'p' => (int)$postID,
                'ignore_sticky_posts' => true,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_format = get_post_format();
                    if (isset($post_format) && $post_format != "video") {
                        if (has_post_thumbnail()) {
                            $isFeatured = cynic_get_meta('cynic_post_featured');;
                            $class = (isset($isFeatured) && $isFeatured == 1) ? "featured-item" : "";
                            echo "<div class='" . $class . "'>";
                                echo "<div class='img-container'>";
                                    the_post_thumbnail('full', array('class' => 'img-fluid modal-feat-img'));
                                echo "</div>";
                            echo "</div>";
                        }
                    } ?>
                    <h1>
                        <span><?php the_date() ?></span> <?php the_title() ?>
                    </h1>
                    <?php
                    global $post;
                    $my_postid = $post->ID;
                    $content_post = get_post($my_postid);
                    $content = $content_post->post_content;
                    echo $content = apply_filters('the_content', $content);
                }
                $return['outputs'] .= ob_get_clean();
                echo json_encode($return);
                die();
            }
        }
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
                        <h2><?php the_title(); ?></h2>
                        <?php
                    endif;
                    the_content();
                }
                $return['outputs'] .= ob_get_clean();
                echo json_encode($return);
                die();
            }
        }

    }

    function get_case_studies_modal_post_content()
    {
        check_ajax_referer($this->ajax_onoce, 'security');
        if (isset($_POST['post_id']) && !empty($_POST['post_id'])) {
            $return = array('outputs' => '');
            $post_id = $_POST['post_id'];

            $post_type = 'case_studies';

            global $wp_query;
            $args = array(
                'post_type' => $post_type,
                'post__in' => array((int)$post_id),
                'showposts' => 1,
            );
            $args['static'] = '1';

            if (class_exists('WPBMap')) { // load visual composer shortcodes
                WPBMap::addAllMappedShortcodes();
            }
            ob_start();
            query_posts($args);
            $template = locate_template('template-parts/trendy-agency/case_studies_modal.php', false);
            load_template($template, true);

            $return['outputs'] .= ob_get_clean();
            echo json_encode($return);
        }
        die();
    }

    function cynic_get_custom_blog(){
        check_ajax_referer($this->ajax_onoce, 'security');

        $page = isset($_POST['pageno']) && $_POST['pageno'] ? (int)$_POST['pageno']: 1;
        $posts_per_page = $_POST['settings']['pp'];
        $orderby = $_POST['settings']['orderby'];
        $order = $_POST['settings']['order'];
        $catid = $_POST['settings']['cat_id'];
        $thumbsize = 'cynic-trendy-custom-blog';
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
        $return['dataTarget'] .= $_POST['settings']['category_slug'];
        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts()) : $query->the_post();?>
                <div class="item col-md-6 col-lg-4">
                    <a href="<?php the_permalink()?>" class="news-content-block content-block">
                        <div class="img-container">
                            <?php
                            if(has_post_thumbnail()){
                                the_post_thumbnail($thumbsize, array('class'=>'img-fluid'));
                            }
                            ?>
                        </div>
                        <!-- End of .img-container -->
                        <h5 class="equalHeight">
                            <span class="content-block__sub-title"><?php the_date(); ?></span>
                            <?php the_title(); ?>
                        </h5>
                    </a>
                    <!-- End of .featured-content-block -->
                </div>
                <!-- End of .item -->
                <?php
            endwhile;
            $return['outputs'] .= ob_get_clean();
        }
        echo json_encode($return);
        die();
    }

}

new ajax_requests();
