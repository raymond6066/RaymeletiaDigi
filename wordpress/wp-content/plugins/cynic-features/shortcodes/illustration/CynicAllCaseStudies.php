<?php

class CynicCaseStudies
{

    public function __construct()
    {
        add_shortcode('cynic_case_studies', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            /* Get All Pages*/

            $pagearr = cynic_get_pages();

            /*Get Category By Its ID */
            $taxonomy = 'case_studies_cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }

            $args = array(
                'base' => 'cynic_case_studies',
                'name' => __('Case Studies', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
//                    array(
//                        "holder" => "div",
//                        'heading' => 'Case Studies Category',
//                        'type' => 'dropdown',
//                        'param_name' => 'select_cat',
//                        'value' => $termsarr,
//                    ),
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
        $taxonomy = 'case_studies_cat';
        $args = array(
            'post_type' => 'case_studies',
            'posts_per_page' => (int)$pp, // set number of post per category here
            'ignore_sticky_posts' => true,
            'orderby' => $orderby,
            'order' => $order
        );
//            $args['tax_query'] = array(
//                array(
//                    'taxonomy' => $taxonomy,
//                    'field' => 'slug',
//                    'terms' => (string)$select_cat,
//                ),
//            );
        $thumbsize = 'cynic-illustration-cs-thumb-img';
        $query = new WP_Query($args);

        if ($query->have_posts()) { ?>
            <div class="item-showcase grid-wrapper__small-padding">

                <div class="container">

                    <div class="row">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <a href="<?php the_permalink(); ?>" class="img-card text-center portfolio-card white-bg light-grey-bg">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        echo wp_get_attachment_image(get_post_thumbnail_id(), $thumbsize, false, array('class' => 'img-fluid', 'alt' => '' . get_the_title(get_the_ID()) . ''));
                                    } ?>
                                    <div class="content case-study-content">
                                        <h4><span><?php the_title(); ?></span></h4>
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </a>
                                <!-- End of .img-card -->
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
        return ob_get_clean();
    }

}
