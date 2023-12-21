<?php
class CynicSeoPortfolioByCategory{

    public function __construct() {
        add_shortcode('cynic_seo_portfolio_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            //All Categories
            $taxonomy = 'portfolio-cat';
            $termsarr = cynicSEO_feature_get_catetories_by_texonomy($taxonomy);

            $args = array(
                'base' => 'cynic_seo_portfolio_by_cat',
                'name' => __('Featured Work', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
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
                        "description" => __(getCustomPostTypeAdminUrl('portfolio')),
                    ),
                    array(
                        "holder" => "",
                        'param_name' => 'pp',
                        'type' => 'textfield',
                        'heading' => __('Show Portfolio', 'cynic'),
                        'value' => '6',
                        "admin_label" => true,
                    ),
                    array(
                        "holder" => "",
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
                        "admin_label" => true,
                    ),
                    array(
                        "holder" => "",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'value' => array(
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                        "admin_label" => true,
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'read_more_button_text',
                        'type' => 'textfield',
                        'heading' => __('Read More Button Text', 'cynic'),
                        'value' => '',
                        "admin_label" => true,
                    ),

                    array(
                        "type" => "vc_link",
                        "class" => "",
                        "heading" => __( "Button Link", "cynic" ),
                        "param_name" => "button_link",
                        "value" => '',
                    )

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
            'read_more_button_text' => 'View Details',
            'button_link' => '',
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
            $linkArr = vc_build_link($button_link);
            ob_start();
                if ($query->have_posts()) { ?>
                    <div class="container">
                        <div class="featured-work-content">
                            <div class="row">
                                <?php
                                $thumbsize = "cynic-portfolio-thumbnail";
                                while ($query->have_posts()) {
                                    $query->the_post(); ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="content box-with-img">
                                            <a href="<?php the_permalink(); ?>" class="img-container">
                                                <?php
                                                if(has_post_thumbnail()) {
                                                    the_post_thumbnail($thumbsize, array('class' => 'img-fluid'));
                                                }
                                                ?>
                                            </a>
                                            <!-- End of .img-container -->

                                            <div class="text-content text-left">
                                                <h3>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <a href="<?php the_permalink(); ?>" class="readmore-btn">
                                                    <div> <?php echo esc_html($read_more_button_text); ?>
                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                    </div>
                                                </a>
                                                <!-- End of .readmore-btn -->
                                            </div>
                                            <!-- End of .text-content -->

                                            <a href="<?php the_permalink(); ?>" class="overlay" data-bg="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>">
                                                <div class="text-content text-left">
                                                    <h3><?php the_title(); ?></h3>
                                                    <div class="readmore-btn">
                                                        <div> <?php echo esc_html($read_more_button_text); ?>
                                                            <i class="fa fa-long-arrow-right"></i>
                                                        </div>
                                                    </div>
                                                    <!-- End of .readmore-btn -->
                                                </div>
                                                <!-- End of .text-content -->
                                            </a>
                                            <!-- End of .overlay -->
                                        </div>
                                        <!-- End of .content -->
                                    </div>
                                    <!-- End of .col-md-6 -->
                                    <?php
                                }
                                if(isset($linkArr['title']) && !empty($linkArr['title'])) { ?>
                                    <div class="col-md-12 text-center">
                                        <?php
                                        echo esc_html_cynicSEO_string(cynicSEO_anchor_link_html($linkArr, 'primary-btn'));
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .service-content -->
                    </div>
                    <?php
                }
            wp_reset_postdata();
            return ob_get_clean();
        }
    }
}