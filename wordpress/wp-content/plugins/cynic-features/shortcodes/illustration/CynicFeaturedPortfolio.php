<?php

class CynicFeaturedPortfolio {

    public function __construct() {
        add_shortcode('cynic_featured_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_featured_portfolio',
                'name' => __('Featured Portfolio', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
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
                        'heading' => 'Featured Text',
                        'type' => 'textfield',
                        'param_name' => 'featured_text',
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
                'posts_per_page' => '-1',
                'orderby' => 'ID',
                'order' => 'DESC',
                'featured_text' => 'Featured'
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
        $categories = array();
        $featured_text = (isset($featured_text) && !empty($featured_text)) ? $featured_text : "Featured";

        ob_start();
        if ($query->have_posts()) {
            $thumbsize = 'cynic-illustration-small-portfolio-thumb-img'; ?>
            <div class="item-showcase grid-wrapper__small-padding">
                <div class="container">
                    <div class="row">
                        <?php
                        $lastPost = 0;
                        while ($query->have_posts()) {

                            $query->the_post();
                            $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                            $settings = ['post_id' => get_the_ID()];
                            $taxonomy = 'portfolio-cat';
                            $isFeatured = cynic_get_meta('portfolio_featured');
                            $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";

                            $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                            $relativetitle = '';

                            if (!empty($categories) && !is_wp_error($categories)) {
                                foreach ($categories as $c => $cat) {
                                    $relativetitle .= ', '. $cat->name;
                                }
                            }
                            $relativetitle .= ' ';
                            $relativetitle = trim($relativetitle,",");

                            $lastPost++; ?>
                            <div class="col-lg-4 col-md-6">
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
                        <?php } ?>
                    </div><!--row-->
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}
