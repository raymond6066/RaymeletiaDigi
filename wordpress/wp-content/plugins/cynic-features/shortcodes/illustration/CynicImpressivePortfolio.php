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
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
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

        $postNames = "'" . $postNameString . "'";
        $post_per_page = count($postNamesArray);

        $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='portfolio' AND post_name IN ($postNames) ORDER BY $orderby $order");

        ob_start();
        if (!empty($posts) && !is_wp_error($posts)) {
            $thumbsize = 'cynic-illustration-small-portfolio-thumb-img';
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
            } ?>
            <div class="item-showcase grid-wrapper__small-padding">
                <div class="container">
                    <div class="row ">
                        <?php
                        foreach ($posts as $post) {
                            $categories = wp_get_post_terms($post->ID, $taxonomy);
                            $imgsrc = false;

                            $relativetitle = '';

                            if (!empty($categories) && !is_wp_error($categories)) {
                                foreach ($categories as $c => $cat) {
                                    $relativetitle .= ', ' . $cat->name;
                                }
                            }
                            $relativetitle .= ' ';
                            $relativetitle = trim($relativetitle, ",");
                            $image_id = get_post_thumbnail_id($post->ID);
                            $imgsrc = wp_get_attachment_url($image_id, 'full');

                            $portfolio_type = get_post_meta($post->ID, 'portfolio_type', TRUE);
                            $video_url = get_post_meta($post->ID, 'portfolio_video_link', TRUE);
                            $button_hover_text = get_post_meta($post->ID, 'portfolio_button_hover_text', TRUE);
                            $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER';
                            $type = "image";
                            $settings = ['post_id' => $post->ID]; ?>
                            <div class="col-lg-4 col-md-6">
                                <?php if ($portfolio_type == 1) { ?>
                                    <a href="javascript:void(0)" class="img-card text-center get-single-post"
                                       data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                       data-action="cynic_get_single_post"
                                       data-posttype="portfolio"
                                       data-portfoliotype="video" data-is-modal="1">
                                        <div class="img-container">
                                            <?php
                                            if ($image_id) {
                                                echo get_the_post_thumbnail($post->ID, $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . $post->post_title . ''));
                                            } ?>
                                            <h4><span><?php echo esc_html($post->post_title); ?></span><?php echo esc_html($relativetitle); ?></h4>
                                        </div>
                                    </a>
                                    <!-- End of .img-card -->
                                <?php } else { ?>
                                    <a href="javascript:void(0)" class="img-card text-center get-single-post white-bg"
                                       data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                       data-action="cynic_get_single_post"
                                       data-posttype="portfolio"
                                       data-portfoliotype="other"
                                       data-is-modal="1">
                                        <?php
                                        if ($image_id) {
                                            echo get_the_post_thumbnail($post->ID, $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . $post->post_title . ''));
                                        } ?>
                                        <h4><span><?php echo esc_html($post->post_title); ?></span><?php echo esc_html($relativetitle); ?></h4>
                                    </a>
                                    <!-- End of .img-card -->
                                <?php } ?>
                            </div>
                            <!-- End of .col-lg-4 -->
                            <?php
                        } ?>
                    </div>
                    <!-- End of .row -->
                    <?php
                    $link = cynic_get_links($button_link, $internal_link, $external_link);
                    if (!empty($link)) { ?>
                        <div class="col-12 text-center">
                            <a href="<?php echo esc_url($link) ?>"
                                <?php if(isset($open_type) && $open_type== 1) { ?> target="_blank" <?php } ?>
                               class="custom-btn secondary-btn"><?php echo esc_html($button_text); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- End of .project-showcase -->
            <?php
        }
        return ob_get_clean();
    }

}
