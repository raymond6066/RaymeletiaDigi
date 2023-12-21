<?php

class CynicSeoPortfolio
{

    public function __construct()
    {
        add_shortcode('cynic_seo_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_seo_portfolio',
                'name' => __('All Work', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'View More Text',
                        'type' => 'textfield',
                        'param_name' => 'view_more_text',
                        'value' => '',
                        "admin_label" => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show Projects', 'cynic'),
                        'value' => '9',
                        "description" => __(getCustomPostTypeAdminUrl('portfolio')),
                        "admin_label" => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Category Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        "admin_label" => true,
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'title',
                            'Custom Serial' => 'custom'
                        )

                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Category Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        "admin_label" => true,
                        'value' => array(
                            'Decending' => 'DESC',
                            'Ascending' => 'ASC',
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
                'view_more_text' => '',
                'posts_per_page' => '3',
                'orderby' => 'ID',
                'order' => 'DESC',
            ), $atts);
        extract($atts);

        $view_more = (isset($view_more_text) && !empty($view_more_text)) ? $view_more_text : "View Details";
        ob_start();
        $taxonomy = 'portfolio-cat';
        $args = array();
        if ($orderby == "custom") {
            $ids = array();
            $cats = get_terms('portfolio-cat', $args);
            $i = 1;
            foreach ($cats as $cat) {
                $term_order = get_term_meta($cat->term_id, 'category_order', true);
                $ids[$term_order . $i] = $cat->term_id;
                $i++;
            }
            if ($order == "ASC") {
                ksort($ids);
            } else {
                krsort($ids);
            }
            $args = array(
                'taxonomy' => $taxonomy,
                'number' => 9,
                'include' => $ids,
                'hide_empty' => false,
                'orderby' => 'include',
            );
        } else {
            $args = array(
                'taxonomy' => $taxonomy,
                'orderby' => $orderby,
                'order' => $order,
            );
        }
        $categories = get_terms($args); ?>
        <div class="container">
            <div class="tab-container type-1">
                <?php if (!empty($categories) && !is_wp_error($categories)) { ?>
                    <ul class="nav nav-tabs row no-gutters" id="our-work" role="tablist">
                        <?php
                        $activeLiClass = 1;
                        foreach ($categories as $cat) {
                            $category_icon = get_term_meta($cat->term_id, 'category_icon', true);
                            $category_icon_type = get_term_meta($cat->term_id, 'category_icon_type', true);
                            $category_icon = (isset($category_icon) && !empty($category_icon)) ? $category_icon : "";
                            $icon_prefix = (substr($category_icon, 0, 3) === "fa-") ? 'fa' : '';

                            $iconHtml = "<i class=\"grad-icon $icon_prefix $category_icon \"></i>";
                            if ($category_icon_type == 'image_icon') {
                                $category_icon_image = get_term_meta($cat->term_id, 'category_image_icon', true);
                                $imageHtml = wp_get_attachment_image($category_icon_image, 'full');
                                if (!empty($imageHtml)) {
                                    $iconHtml = $imageHtml;
                                }
                            }

                            $activeTabLiClass = "";
                            if ($activeLiClass == 1) {
                                $activeTabLiClass = "active";
                            } ?>
                            <li class="nav-item col">
                                <a class="nav-link <?php echo esc_attr($activeTabLiClass) ?>"
                                   id="work-tab-<?php echo esc_attr($activeLiClass); ?>" data-toggle="tab"
                                   href="#work-content-<?php echo esc_attr($activeLiClass); ?>" role="tab"
                                   aria-controls="work-content-<?php echo esc_attr($activeLiClass); ?>"
                                   aria-selected="true">
                                    <?php echo esc_html_cynicSEO_string($iconHtml) ?>
                                    <span><?php echo esc_attr($cat->name); ?></span>
                                </a>
                            </li>
                            <!-- End of .nav-item -->
                            <?php $activeLiClass++;
                        } ?>
                    </ul>
                    <!-- End of .nav-tabs -->
                <?php } ?>
                <?php if (!empty($categories) && !is_wp_error($categories)) { ?>
                    <div class="tab-content" id="work-tab-content">
                        <?php
                        $activetabClass = 1;
                        foreach ($categories as $cat) {
                            $activePaneClass = "tab-pane fade";
                            if ($activetabClass == 1) {
                                $activePaneClass = "tab-pane fade show active current";
                            } ?>
                            <div class="<?php echo esc_attr($activePaneClass); ?>"
                                 id="work-content-<?php echo esc_attr($activetabClass); ?>" role="tabpanel"
                                 aria-labelledby="work-content-<?php echo esc_attr($activetabClass); ?>">
                                <?php
                                $args = array(
                                    'post_type' => 'portfolio',
                                    'posts_per_page' => (int)$posts_per_page, // set number of post per category here
                                    'ignore_sticky_posts' => true,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => $taxonomy,
                                            'field' => 'term_id',
                                            'terms' => $cat->term_id
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) { ?>
                                    <div class="featured-work-content">
                                        <div class="row">
                                            <?php while ($query->have_posts()) {
                                                $query->the_post(); ?>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="content box-with-img">
                                                        <?php if (has_post_thumbnail()) { ?>
                                                            <a href="<?php the_permalink() ?>" class="img-container">
                                                                <?php the_post_thumbnail('cynic-portfolio-thumbnail', array('class' => 'img-fluid')) ?>
                                                            </a>
                                                            <!-- End of .img-container -->
                                                        <?php } ?>
                                                        <div class="text-content  text-left">
                                                            <h3>
                                                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <a href="<?php the_permalink() ?>" class="readmore-btn">
                                                                <div> <?php echo esc_html($view_more) ?>
                                                                    <i class="fa fa-long-arrow-right"
                                                                       aria-hidden="true"></i>
                                                                </div>
                                                            </a>
                                                            <!-- End of .readmore-btn -->
                                                        </div>
                                                        <!-- End of .text-content -->

                                                        <a href="<?php the_permalink() ?>" class="overlay"
                                                           data-bg="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>">
                                                            <div class="text-content  text-left">
                                                                <h3><?php the_title(); ?></h3>
                                                                <div class="readmore-btn">
                                                                    <div> <?php echo esc_html($view_more) ?>
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
                                            <?php } ?>
                                        </div>
                                        <!-- End of .row -->
                                    </div>
                                    <!-- End of .featured-work-content -->
                                <?php } ?>
                            </div>
                            <!-- End of .tab-pane-->
                            <?php $activetabClass++;
                        } ?>
                    </div>
                    <!-- End of .tab-content -->
                <?php } ?>
            </div>
            <!-- End of .tab-content -->
        </div>
        <?php
        return ob_get_clean();
    }

}
