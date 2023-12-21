<?php

class CynicOnePagePortfolios {

    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_onepage_portfolios', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_ajax_cynic_onepage_load_more_portfolio', array($this, 'cynic_onepage_load_more_portfolio'));
        add_action('wp_ajax_nopriv_cynic_onepage_load_more_portfolio', array($this, 'cynic_onepage_load_more_portfolio'));
        self::$noncePlain = 'd21b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_onepage_portfolios',
                'name' => __('Modern Portfolios Grids', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Select Theme',
                        'type' => 'dropdown',
                        'param_name' => 'theme_layout',
                        'value' => array(
                            'Modern Layout' => 'modern',
                            'Classic Layout' => 'classic',
                        ),
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
                        'heading' => __('All Category Filter Text', 'cynic'),
                        'value' => '',
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'theme_layout' => 'modern',
                'posts_per_page' => '9',
                'orderby' => 'ID',
                'order' => 'DESC',
                'load_more' => '1',
                'button_text' => 'Discover More',
                'all_category' => ''
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );

        $all_work = "All Work";
        if(isset($all_category) && !empty($all_category)){
            $all_work = $all_category;
        }

        $query = new WP_Query($args);
        $mixitupcats = array('*' => esc_html__($all_work, 'cynic'));
        $catsTerms = array('*' => '0');
        ob_start();
        if ($query->have_posts()) {
            wp_enqueue_script('isotope');
            wp_enqueue_style('isotope-css');
            $columncls = 'col-xs-12 col-sm-4';
            $thumbsize = 'cynic-onepage-portfolio-img';
            $taxonomy = 'portfolio-cat';
            $termsArgs = array('taxonomy'=>$taxonomy, 'hide_empty'=>false);
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
                        $relativetitle .= ", ".$cat->name;
                    }
                }
                $relativecatcls .= ' ';
                $relativetitle .= ' ';
                $relativetitle = trim($relativetitle,",");

                if (has_post_thumbnail()) {
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);
                    $imgsrc = $imgsrc[0];
                }
                $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER';
                $type = "image";
                ?>
                <div class="mix <?php echo esc_attr($relativecatcls) ?>col-md-4 col-sm-4 col-xs-6">
                    <?php if (!$portfolio_type) { ?>
                        <div class="pro-item-img" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                            <div class="por-overley">
                                <div class="text-inner">
                                    <a href="javascript:void(0)" data-type="image" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="btn btn-nofill proDetModal" data-toggle="modal"><?php echo esc_html($image_button_hover_text) ?></a>
                                </div>
                            </div>
                        </div>
                    <?php } else { $type="video"; ?>
                        <div class="pro-item-img video_popup" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                            <div class="por-overley">
                                <div class="text-inner"> <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="video-popup"><span class="icon-play-circle"></span></a> </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End of .video_popup -->
                    <?php if(isset($theme_layout) && $theme_layout=="modern") { ?>
                        <div class="text-content">
                            <h3>
                                <?php if (!$portfolio_type) { ?>
                                    <a href="javascript:void(0)" data-type="<?php echo esc_attr($type); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="proDetModal" data-toggle="modal"><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a>
                                <?php } else { $type="video"; ?>
                                    <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="video-popup"><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a>
                                <?php } ?>
                            </h3>
                        </div>
                    <?php } ?>
                </div>

                <?php
            }
        }
        wp_reset_postdata();
        $portfoliosmarkup = ob_get_clean();
        ob_start();
        $elemid = 'portfolio-' . rand(000000, 999999);
        ?>
        <div class="row" data-isotope-id="#<?php echo $elemid ?>">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="pro-controls">
                    <?php
                    $c = 0;
                    foreach ($mixitupcats as $key => $val) {
                        $slug = $key;
                        if ($c > 0) {
                            $key = '.' . $key;
                            $activeclass = '';
                        } else {
                            $activeclass = 'active';
                        }
                        ?>
                        <button class="filter <?php echo esc_attr($activeclass) ?>" data-slug="<?php echo esc_attr($catsTerms[$slug]); ?>" data-filter="<?php echo $key ?>"><?php echo $val ?></button>
                        <?php
                        $c++;
                    }
                    ?>
                </div>
            </div>
        </div><!--row-->

        <div id="<?php echo esc_attr($elemid) ?>" class="port-cat-con row">
            <?php echo $portfoliosmarkup ?>
        </div><!--row-->
        <?php if ($load_more == 1) { ?>
            <div class="row">
                <div class="col-xs-12"> <a href="#" data-action="cynic_onepage_load_more_portfolio" data-nonce="<?php echo self::$securityNonce ?>" data-orderby="<?php echo esc_attr($orderby) ?>" data-order="<?php echo esc_attr($order) ?>" data-target="#<?php echo esc_attr($elemid) ?>" data-page="1" data-pp="<?php echo (int) $posts_per_page; ?>" data-layout="<?php echo esc_attr($theme_layout) ?>" class="btn btn-fill load-more-portfolio full-width"><?php esc_html_e($button_text, 'cynic') ?></a> </div>
            </div><!--row-->
            <?php
        }
        return ob_get_clean();
    }

    public function cynic_onepage_load_more_portfolio() {
        // need to develop portfolio grid here and respond over ajax action.
        // make sure that no output will display from here when there are not post available.

        $return = array();
        if (!isset($_POST['security_nonce']) || !wp_verify_nonce($_POST['security_nonce'], self::$noncePlain)) {
            echo json_encode($return);
            die();
        }
        $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
        $posts_per_page = $_POST['pp'];
        $orderby = $_POST['orderby'];
        $order = $_POST['order'];
        $theme_layout = (isset($_POST['data_layout']) && !empty($_POST['data_layout']) && $_POST['data_layout']=="classic") ? "classic" : "modern";
        if ((int) $posts_per_page < 1) { // make sure that posts per page is not less than 0 or not -1
            echo json_encode($return);
            die();
        }

        $offset = $page * (int)$posts_per_page;
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'ignore_sticky_posts' => true,
        );
        if ($slug) {
            $taxonomy = 'portfolio-cat';
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $slug,
                ),
            );
        }
        $query = new WP_Query($args);


        $return['total'] = $query->found_posts;
        $categories = array();

        if ($query->have_posts()) {
            $columncls = 'col-xs-12 col-sm-4';
            $thumbsize = 'cynic-onepage-portfolio-img';
            while ($query->have_posts()) {
                $query->the_post();
                $taxonomy = 'portfolio-cat';
                $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER';
                $imgsrc = false;
                $relativecatcls = '';
                $relativetitle = '';

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $c => $cat) {
                        if ($c > 0) {
                            $relativecatcls .= ' ';
                        }
                        $relativecatcls .= $cat->slug;
                        $relativetitle .= $cat->name;
                    }
                }
                $relativecatcls .= ' ';
                $relativetitle .= ' ';

                if (has_post_thumbnail()) {
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);
                    $imgsrc = $imgsrc[0];
                }
                ob_start();
                $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                ?>
                <div class="onepage mix portfolio-id-<?php the_ID()?> <?php echo esc_attr($relativecatcls)?>col-md-4 col-sm-4 col-xs-6"><?php if(!$portfolio_type) { ?><div class="pro-item-img" style="<?php echo $imgsrc ? 'background-image:url('.esc_url($imgsrc).')' : null;?>"><div class="por-overley"><div class="text-inner"><a href="javascript:void(0)" data-type="image" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal" data-toggle="modal"><?php echo esc_html ($image_button_hover_text); ?></a></div></div></div><?php } else { ?><div class="pro-item-img video_popup" style="<?php echo $imgsrc ? 'background-image:url('.esc_url($imgsrc).')' : null;?>"><div class="por-overley"><div class="text-inner"> <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="video-popup"><span class="icon-play-circle"></span></a> </div></div></div><?php } ?><?php if(isset($theme_layout) && $theme_layout=="modern") { ?><div class="text-content"><h3><?php if(!$portfolio_type) { ?><a href="javascript:void(0)" data-type="<?php echo esc_attr($type); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="proDetModal" data-toggle="modal"><?php } else { ?> <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="video-popup"><?php } ?><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a></h3></div><?php } ?></div>
                <?php
                $return['outputs'] .= ob_get_clean();
            }
        }
        echo json_encode($return);
        die(); //end of cycle
    }

}
