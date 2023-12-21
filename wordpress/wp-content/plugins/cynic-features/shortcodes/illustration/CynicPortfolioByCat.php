<?php

class CynicPortfolioByCat
{

    public function __construct()
    {
        add_shortcode('cynic_content_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $taxonomy = 'portfolio-cat';
            global $wpdb;

            /* Get All Pages*/

            $pagearr = cynic_get_pages();

            /*Get Category By Its ID */
            $taxonomy = 'portfolio-cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }

            $args = array(
                'base' => 'cynic_content_by_cat',
                'name' => __('Portfolio By Category', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Portfolio Category',
                        'type' => 'dropdown',
                        'param_name' => 'select_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        'type' => 'dropdown',
                        'param_name' => 'pp',
                        'heading' => __('Posts Per Page', 'cynic'),
                        'value' => array(
                            'All' => '-1',
                            '3' => '3',
                            '6' => '6',
                            '9' => '9'
                        ),
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
                'select_cat' => '',
                'pp' => '3',
                'orderby' => 'ID',
                'order' => 'DESC',
                'button_text' => 'discover more',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
            ), $atts);
        extract($atts);
        ob_start();
        if ($select_cat) {
            $taxonomy = 'portfolio-cat';
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => (int)$pp, // set number of post per category here
                'ignore_sticky_posts' => true,
                'orderby' => $orderby,
                'order' => $order
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => (string)$select_cat,
                ),
            );
            $thumbsize = 'cynic-illustration-small-portfolio-thumb-img';
            $query = new WP_Query($args);

            if ($query->have_posts()) { ?>
                <div class="item-showcase grid-wrapper__small-padding">

                    <div class="container">

                        <div class="row">
                            <?php
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
                                $isFeatured = get_post_meta(get_the_ID(),'portfolio_featured', TRUE);
                                $class = (isset($isFeatured) && $isFeatured == 1) ? " featured-item" : "";
                                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER MORE WORK';
                                $settings = ['post_id' => get_the_ID()]; ?>
                                <div class="col-lg-4 col-md-6 ">
                                    <?php if ($portfolio_type == 1) { ?>
                                        <a href="javascript:void(0)" class="img-card text-center get-single-post"
                                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                           data-action="cynic_get_single_post"
                                           data-posttype="portfolio"
                                           data-portfoliotype="video" data-is-modal="1">
                                            <div class="img-container">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                                } ?>
                                                <h4><span><?php the_title(); ?></span><?php echo esc_html($relativetitle); ?></h4>
                                            </div>
                                        </a>
                                        <!-- End of .img-card -->
                                    <?php } else { ?>
                                        <a href="javascript:void(0)" class="img-card text-center get-single-post"
                                           data-settings="<?php echo esc_attr(json_encode($settings)); ?>"
                                           data-action="cynic_get_single_post"
                                           data-posttype="portfolio"
                                           data-portfoliotype="other"
                                           data-is-modal="1">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                            } ?>
                                            <h4><span><?php the_title(); ?></span><?php echo esc_html($relativetitle); ?></h4>
                                        </a>
                                        <!-- End of .img-card -->
                                    <?php } ?>
                                </div>
                                <!-- End of .col-lg-4 -->
                                <?php
                            }
                            wp_reset_postdata(); ?>

                        </div>
                        <?php
                        $link = cynic_get_links($button_link, $internal_link, $external_link);
                        if (!empty($link)) { ?>
                            <div class="col-12 text-center">
                                <a href="<?php echo esc_url($link) ?>"
                                    <?php if(isset($open_type) && $open_type== 1) { ?> target="_blank" <?php } ?>
                                   class="custom-btn secondary-btn"><?php echo esc_html($button_text); ?></a>
                            </div>
                        <?php } ?>
                        <!-- End of .row -->
                    </div>
                </div>
                <!-- End of .project-showcase -->
                <?php
            }
        }
        return ob_get_clean();
    }

}
