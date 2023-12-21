<?php

class CynicImpressivePortfolio
{

    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_impressive_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $postsarr = cynic_get_posts('portfolio');

            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = cynic_get_pages();

            $args = array(
                'base' => 'cynic_impressive_portfolio',
                'name' => __('Impressive Portfolio', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
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
                        'param_name' => 'sub_title',
                        'type' => 'textarea',
                        'heading' => __('Block Sub Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Portfolio"),
                        "param_name" => "portfolio_param",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => " ",
                        "description" => __("Please choose the portfolio to display best portfolio\'s.")
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'post_title',
                            'Publish Date' => 'post_date',
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
                'title' => '',
                'sub_title' => '',
                'portfolio_param' => '',
                'orderby' => 'ID',
                'order' => 'ASC',
                'button_text' => 'discover more',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
            ), $atts);
        extract($atts);

        global $wpdb;
        $postIds = explode(',', $portfolio_param);
        $post_per_page = count($postIds);

        $postNamesArray = explode(',', $portfolio_param);
        $postNameString = implode("','", $postNamesArray);

        $postNames = "'".$postNameString."'";
        $post_per_page = count($postNamesArray);

        $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='portfolio' AND post_name IN ($postNames) ORDER BY $orderby $order");

        ob_start();

        $shape_colors = getCynicOptionsVal('shape-color');
        $bubble_colors = (isset($shape_colors) && !empty($shape_colors)) ? $shape_colors : "#edf7ff";
        $get_colors = get_bubble_color($bubble_colors); ?>

        <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" width="779px"
             height="759px">
            <defs>
                <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                    <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                </linearGradient>

            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_03)"
                  d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>
        <?php

        if (!empty($posts) && !is_wp_error($posts)) {
            $thumbsize = 'cynic-trendy-portfolio-img';
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
            foreach ($posts as $post) {

                $categories = wp_get_post_terms($post->ID, $taxonomy);
                $imgsrc = false;

                $relativetitle = '';

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $c => $cat) {
                        if ($c > 0) {
                            $relativecatcls .= ' ';
                        }
                        $relativetitle .= ', '. $cat->name;
                    }
                }
                $relativetitle .= ' ';
                $relativetitle = trim($relativetitle,",");

                $image_id = get_post_thumbnail_id($post->ID);
                $imgsrc = wp_get_attachment_url($image_id, $thumbsize);


                $portfolio_type = get_post_meta($post->ID, 'portfolio_type', TRUE);
                $video_url = get_post_meta($post->ID, 'portfolio_video_link', TRUE);
                $isFeatured = get_post_meta($post->ID,'portfolio_featured', TRUE);
                $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                $button_hover_text = get_post_meta($post->ID, 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER MORE WORK';
                $settings = ['post_type' => 'portfolio', 'post_id' => $post->ID]; ?>
                <div class="<?php echo esc_attr($class) ?> grid-item col-md-6 col-lg-4">
                    <?php if ($portfolio_type == 1) { ?>
                        <a href="<?php echo $video_url; ?>"
                           data-posttype="portfolio"
                           data-portfolio-type="<?php echo $portfolio_type; ?>"
                           data-actions="cynic_single_post_content"
                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                           class="video-popup featured-content-block content-block">
                            <div class="img-container">
                                <?php
                                if ($image_id) {
                                    echo get_the_post_thumbnail($image_id, $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . $post->post_title . ''));
                                } ?>
                            </div>
                            <!-- End of .img-container -->
                            <h5 class="equalHeight">
                                <span class="content-block__sub-title"><?php echo esc_html($relativetitle); ?></span>
                                <?php echo esc_html($post->post_title) ?>
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
                                if ($image_id) {
                                    echo wp_get_attachment_image($image_id, $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . $post->post_title . ''));
                                } ?>
                            </div>
                            <!-- End of .img-container -->
                            <h5 class="equalHeight">
                                <span class="content-block__sub-title"><?php echo esc_html($relativetitle); ?></span>
                                <?php echo esc_html($post->post_title) ?>
                            </h5>
                        </a>
                    <?php } ?>
                    <!-- End of .featured-content-block -->
                </div>
                <?php
            }
        }
        $portfoliosmarkup = ob_get_clean();
        ob_start();
        $elemid = 'portfolio-' . rand(000000, 999999);
        ?>
        <div class="container">
            <h2 class="text-center"><?php echo $title; ?></h2>
            <p class="section-subheading text-center"><?php echo $sub_title; ?></p>

            <div class="project-showcase text-center">

                <div id="<?php echo esc_attr($elemid) ?>" class="grid row">
                    <?php echo $portfoliosmarkup ?>
                </div>
                <!-- End of .grid -->
                <?php
                $link = cynic_get_links($button_link, $internal_link, $external_link);
                if (!empty($link)) { ?>
                    <a href="<?php echo esc_url($link) ?>"
                        <?php if(isset($open_type) && $open_type== 1) { ?> target="_blank" <?php } ?>
                       class="custom-btn btn-big grad-style-ef btn-full"><?php echo esc_html($button_text); ?></a>
                <?php } ?>
            </div>
            <!-- End of .template-showcase -->
        </div>
        <!-- End of .container -->
        <?php
        return ob_get_clean();
    }

}
