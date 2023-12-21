<?php
class CynicPortfolioByCat {
    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_portfolio_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        self::$noncePlain = 'd21b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $taxonomy = 'portfolio-cat';
            global $wpdb;

            /*Gel All Portfolio Category*/
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }

            /* Get all pages */
            $pagearr = cynic_get_pages();

            $args = array(
                'base' => 'cynic_portfolio_by_cat',
                'name' => __('Portfolio By Category', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => __("Select Portfolio"),
                        "param_name" => "select_cat",
                        "admin_label" => true,
                        "value" => $termsarr, //value
                        "std" => " ",
                        "description" => __("Please choose the portfolio to display best portfolio\'s.")
                    ),
                    array(
                        "holder" => "div",
                        'param_name' => 'pp',
                        'type' => 'textfield',
                        'heading' => __('Show Portfolio', 'cynic'),
                        'value' => '6',
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
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
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
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
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
                        "holder" => "div",
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
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
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
                'select_cat' => '',
                'pp' => 6,
                'orderby' => 'ID',
                'order' => 'DESC',
                'button_text' => 'discover more',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
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
            $elemid = 'portfolio-' . rand(000000, 999999);
            if ($query->have_posts()) {
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
                $shape_colors = getCynicOptionsVal('shape-color');
                $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
                $get_colors = get_bubble_color($bubble_colors); ?>
                <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="1" />
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors) ?>" stop-opacity="0" />
                        </linearGradient>

                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_04)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>
                <div class="container">
                    <div class="featured-project-showcase text-center">
                        <div class="row equalHeightWrapper">
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                                $imgsrc = false;

                                $relativetitle = '';

                                if (!empty($categories) && !is_wp_error($categories)) {
                                    foreach ($categories as $c => $cat) {
                                        $relativetitle .= ', '. $cat->name;
                                    }
                                }
                                $relativetitle .= ' ';
                                $relativetitle = trim($relativetitle,",");

                                if (has_post_thumbnail()) {
                                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);
                                    $imgsrc = $imgsrc[0];
                                }
                                $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                                $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                                $isFeatured = get_post_meta(get_the_ID(),'portfolio_featured', TRUE);
                                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text))
                                    ? $button_hover_text : __('DISCOVER', 'cynic');
                                $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                                $settings = ['post_type' => 'portfolio', 'post_id' => get_the_ID()]; ?>
                                <div class="<?php echo esc_attr($class) ?> grid-item col-md-6 col-lg-4">
                                    <?php if ($portfolio_type == 1) { ?>
                                        <a href="<?php echo $video_url; ?>"
                                           data-posttype="portfolio"
                                           data-portfolio-type="<?php echo $portfolio_type; ?>"
                                           data-actions="cynic_single_post_content"
                                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                           class="video-popup featured-content-block content-block ">
                                            <div class="img-container">
                                                <img src="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>" alt="" class="img-fluid">
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
                                                <img src="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>" alt="" class="img-fluid">
                                            </div>
                                            <!-- End of .img-container -->
                                            <h5 class="equalHeight">
                                                <span class="content-block__sub-title"><?php echo esc_html($relativetitle); ?></span>
                                                <?php the_title(); ?>
                                            </h5>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        $link = cynic_get_links($button_link, $internal_link, $external_link);
                        if (!empty($link)) { ?>
                            <a href="<?php echo esc_url($link) ?>"
                               class="custom-btn btn-big grad-style-ef btn-full"
                                <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?>><?php echo esc_html($button_text) ?></a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
            return ob_get_clean();
        }
    }

}