<?php

class CynicFeaturedPortfolio
{
    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_featured_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();
            $args = array(
                'base' => 'cynic_featured_portfolio',
                'name' => __('Featured portfolio', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
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
                        'heading' => 'Display Load More',
                        'type' => 'dropdown',
                        'param_name' => 'display_load_more',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '2',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
                        'value' => ''
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                            'Bookmark' => '3'
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
                        'heading' => 'External Link/ Bookmark',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('2', '3'),
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('1', '2'),
                        ),
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

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'posts_per_page' => '-1',
                'orderby' => 'ID',
                'order' => 'DESC',
                'display_load_more' => '1',
                'button_text' => 'discover more',
                'button_link' => '1',
                'internal_link' => '#',
                'external_link' => '#',
                'open_type' => '0'
            ), $atts);
        extract($atts);

        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
            'meta_query' => array(
                array(
                    'key' => 'portfolio_featured',
                    'value' => '1',
                ),
            )
        );

        $query = new WP_Query($args);
        $elemid = 'portfolio-' . rand(000000, 999999);
        $categories = array();
        ob_start();
        $counter = 0;
        $lastPost = 0;
        if ($query->have_posts()) {
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
            } ?>
            <div class="container">
                <div class="featured-project-showcase text-center">
                    <div class="row">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();

                            $isFeatured = cynic_get_meta('portfolio_featured');
                            $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";

                            $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                            $imgsrc = false;

                            $relativetitle = '';

                            if (!empty($categories) && !is_wp_error($categories)) {
                                foreach ($categories as $c => $cat) {
                                    $relativetitle .= ', ' . $cat->name;
                                }
                            }
                            $relativetitle .= ' ';
                            $relativetitle = trim($relativetitle, ",");
                            $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                            $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                            $isFeatured = get_post_meta(get_the_ID(), 'portfolio_featured', TRUE);
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
                                    <?php
                                } else { ?>
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
                                    <?php
                                } ?>
                            </div>

                        <?php } ?>
                    </div>
                    <?php
                    $link = cynic_get_links($button_link, $internal_link, $external_link);
                    $page_scroll = ($button_link == 3) ? "page-scroll" : "";
                    if (!empty($link) && $display_load_more == 1) { ?>
                        <a href="<?php echo esc_url($link) ?>"
                           class="custom-btn btn-big grad-style-ef btn-full <?php echo esc_attr($page_scroll); ?>"
                            <?php if (isset($open_type) && $open_type == 1) { ?> target="_blank"
                            <?php } ?>><?php echo esc_html($button_text) ?></a>
                    <?php } ?>
                </div><!--row-->
            </div>
            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }
}