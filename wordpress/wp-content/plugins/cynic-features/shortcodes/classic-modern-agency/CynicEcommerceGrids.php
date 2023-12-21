<?php

class CynicEcommerceGrids {
    public static $securityNonce, $noncePlain;
    public function __construct() {
        add_shortcode('cynic_ecommerce_section', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        add_action('wp_ajax_cynic_ecommerce_by_cat', array($this, 'cynic_ecommerce_by_cat'));
        add_action('wp_ajax_nopriv_cynic_ecommerce_by_cat', array($this, 'cynic_ecommerce_by_cat'));
        self::$noncePlain = 'd02b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $taxonomy = 'portfolio-cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.slug, t.name FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }
            $args = array(
                'base' => 'cynic_ecommerce_section',
                'name' => __('Ecommerce Section', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Portfolios Category',
                        'type' => 'dropdown',
                        'param_name' => 'select_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        'param_name' => 'pp',
                        'type' => 'textfield',
                        'heading' => __('Show Projects', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
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
                        'heading' => 'More Button Text',
                        'type' => 'textfield',
                        'param_name' => 'load_more_text',
                        'value' => '',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'select_cat' => '',
            'pp' => '2',
            'orderby' => 'ID',
            'order' => 'DESC',
            'load_more' => '1',
            'load_more_text' => '',
                ), $atts);
        extract($atts);
        if ($select_cat) {
            $taxonomy = 'portfolio-cat';
            $posts_per_page = $pp;
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => (int) $posts_per_page,
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true,
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $select_cat,
                ),
            );
            $query = new WP_Query($args);
            ob_start();
            if ($query->have_posts()) {
                ?>
                <div class="row clearfix">
                    <?php
                    while ($query->have_posts()) {
                        $thumbsize = 'cynic-portfolio-ecommerce';
                        $query->the_post();

                        $before_imgsrc = false;
                        $after_imgsrc = false;
                        $before_image = get_post_meta(get_the_ID(), 'portfolio_before_image', TRUE);
                        if ($before_image) {
                            $before_imgsrc = wp_get_attachment_image($before_image, $thumbsize, false, array('class' => 'img-responsive'));
                        }
                        $after_image = get_post_meta(get_the_ID(), 'portfolio_after_image', TRUE);
                        if ($after_image) {
                            $after_imgsrc = wp_get_attachment_image($after_image, $thumbsize, false, array('class' => 'img-responsive'));
                        }
                        $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                        $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER';
                        $elemid = 'portfolio-'.rand(000000,999999); ?>
                        <div id="<?php echo esc_attr($elemid)?>">
                            <div class="col-xs-6">
                                <div class="content">
                                    <div class="img_container">
                                        <?php echo $before_imgsrc; ?>
                                        <span class="icon-chevron-right"></span>
                                        <div class="overlay">
                                            <div class="inner_overlay">
                                                <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php echo esc_html($image_button_hover_text); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End oc .img_container -->
                                    <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="before_after proDetModal"><?php esc_html_e('before','cynic'); ?></a>
                                </div>
                                <!-- End of .content -->
                            </div>
                            <!-- End of .col-sm-6 -->

                            <div class="col-xs-6">
                                <div class="content">
                                    <div class="img_container">
                                        <?php echo $after_imgsrc; ?>
                                        <div class="overlay">
                                            <div class="inner_overlay">
                                                <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php echo esc_html($image_button_hover_text); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End oc .img_container -->
                                    <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="before_after proDetModal"><?php esc_html_e('after','cynic'); ?></a>
                                </div>
                                <!-- End of .content -->
                            </div>
                            <!-- End of .col-sm-6 -->
                        </div>
                <?php } ?>
                </div>
                <!-- End of .row -->
                <?php if ($load_more == 1) { ?>
                    <div class="text-center"><a href="#" data-action="cynic_ecommerce_by_cat" data-cat="<?php echo esc_attr($select_cat) ?>" data-nonce="<?php echo self::$securityNonce ?>" data-orderby="<?php echo esc_attr($orderby) ?>" data-order="<?php echo esc_attr($order) ?>" data-target="#<?php echo esc_attr($elemid) ?>" data-page="1" data-pp="<?php echo (int) $posts_per_page; ?>" class="btn btn-fill load-more-portfolio"><?php echo esc_html((isset($load_more_text) && !empty($load_more_text)) ? $load_more_text : "discover more", 'cynic'); ?></a></div>    
                <?php } ?>
                <?php
            }
        }
        return ob_get_clean();
    }

    public function cynic_ecommerce_by_cat() {
        // display grids from portfolio via ajax request. Interact with mixitup jquery
        $return = array();
        if (!isset($_POST['security_nonce']) || !wp_verify_nonce($_POST['security_nonce'], self::$noncePlain)) {
            echo json_encode($return);
            die();
        }
        $page = isset($_POST['page']) && $_POST['page'] ? (int) $_POST['page'] : 1;
        $posts_per_page = $_POST['pp'];
        $orderby = $_POST['orderby'];
        $order = $_POST['order'];
        $select_cat = $_POST['catid'];

        if ((int) $posts_per_page < 1 || !$select_cat) { // make sure that posts per page is not less than 0 or not -1
            echo json_encode($return);
            die();
        }
        $offset = $page * (int) $posts_per_page;
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'ignore_sticky_posts' => true,
        );
        $taxonomy = 'portfolio-cat';
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => array((int) $select_cat),
            ),
        );
        $query = new WP_Query($args);
        $return['total'] = $query->found_posts;
        if ($query->have_posts()) {
            $return['outputs'] = '';
            while ($query->have_posts()) {
                $return['outputs'] = '';
                $query->the_post();

                $before_imgsrc = false;
                $after_imgsrc = false;
                $before_image = get_post_meta(get_the_ID(), 'portfolio_before_image', TRUE);
                if ($before_image) {
                    $before_imgsrc = wp_get_attachment_image($before_image, $thumbsize, false, array('class' => 'img-responsive'));
                }
                $after_image = get_post_meta(get_the_ID(), 'portfolio_after_image', TRUE);
                if ($after_image) {
                    $after_imgsrc = wp_get_attachment_image($after_image, $thumbsize, false, array('class' => 'img-responsive'));
                }
                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER';
                
                ob_start(); ?>
                <div class="col-xs-6">
                    <div class="content">
                        <div class="img_container">
                            <?php echo $before_imgsrc; ?>
                            <span class="icon-chevron-right"></span>
                            <div class="overlay">
                                <div class="inner_overlay">
                                    <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php echo esc_html($image_button_hover_text); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- End oc .img_container -->
                        <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="before_after proDetModal"><?php esc_html_e('before','cynic'); ?></a>
                    </div>
                    <!-- End of .content -->
                </div>
                <!-- End of .col-sm-6 -->

                <div class="col-xs-6">
                    <div class="content">
                        <div class="img_container">
                            <?php echo $after_imgsrc; ?>
                            <div class="overlay">
                                <div class="inner_overlay">
                                    <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php echo esc_html($image_button_hover_text); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- End oc .img_container -->
                        <a href="javascript:void(0)" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="before_after proDetModal"><?php esc_html_e('after', 'cynic')?></a>
                    </div>
                    <!-- End of .content -->
                </div>
                <!-- End of .col-sm-6 -->
                        <?php
                $return['outputs'] .= urlencode(ob_get_clean());
            }
        }

        echo json_encode($return);
        die(); //end of cycle
    }

}
