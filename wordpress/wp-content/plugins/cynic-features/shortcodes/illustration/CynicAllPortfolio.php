<?php

class CynicAllPortfolio
{

    public static $securityNonce, $noncePlain;

    public function __construct()
    {
        add_shortcode('cynic_all_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_all_portfolio',
                'name' => __('All Portfolio', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
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
                        'heading' => __('All Work Filter Text', 'cynic'),
                        'value' => '',
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
                'posts_per_page' => '9',
                'orderby' => 'ID',
                'order' => 'DESC',
                'load_more' => '1',
                'button_text' => 'Discover More Work',
                'all_category' => ''
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => (int)$posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );

        $all_work = "All Work";
        if (isset($all_category) && !empty($all_category)) {
            $all_work = $all_category;
        }

        $query = new WP_Query($args);
        $mixitupcats = array('*' => esc_html__($all_work, 'cynic'));
        $catsTerms = array('*' => '0');
        ob_start(); ?>

        <?php

        if ($query->have_posts()) {
            $thumbsize = 'cynic-illustration-small-portfolio-thumb-img';
            $taxonomy = 'portfolio-cat';
            $args = array(
                'orderby'                  => $orderby,
                'order'                    => $order,
                'hide_empty'               => false,
                'taxonomy'                 => $taxonomy,
            );
            $categories = get_categories($args);
            $found_posts = (int)$query->found_posts;
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
                $isFeatured = get_post_meta(get_the_ID(),'portfolio_featured', TRUE);
                $class = (isset($isFeatured) && $isFeatured == 1) ? "featured-item" : "";
                $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : 'DISCOVER MORE WORK';
                $settings = ['post_id' => get_the_ID()] ?>

                <div class="col-lg-4 col-md-6 item <?php echo esc_attr($relativecatcls) ?><?php echo esc_attr($class) ?> blog-video-popup">
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
                <!-- End of .item -->
                <?php
            }
        }
        wp_reset_postdata();
        $portfoliosmarkup = ob_get_clean();
        ob_start(); ?>
        <div class="container">
            <div class="item-showcase grid-wrapper__small-padding">

                <div class="btn-filter-wrap nav nav-tabs justify-content-center">
                    <?php
                    $c = 0;
                    foreach ($mixitupcats as $key => $val) {
                        $slug = $key;
                        if ($c > 0) {
                            $key = '.' . $key;
                            $activeclass = '';
                        } else {
                            $activeclass = 'is-checked';
                        }
                        ?>
                        <button class="btn-filter nav-link <?php echo esc_attr($activeclass) ?>"
                           href="javascript:void(0)" data-filter="<?php echo $key ?>"><?php echo $val ?></button>
                        <?php
                        $c++;
                    }
                    ?>
                </div>
                <!-- filter-button-group ends -->

                <div class="row iso-grid">
                    <?php echo $portfoliosmarkup ?>
                </div>
                <!-- End of .grid -->

            </div>
        </div><!-- End of .container -->
        <?php
        return ob_get_clean();
    }

}
