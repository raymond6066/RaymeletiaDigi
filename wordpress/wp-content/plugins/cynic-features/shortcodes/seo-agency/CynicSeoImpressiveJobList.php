<?php

class CynicSeoImpressiveJobList
{

    protected $taxonomy;
    protected $post_type;

    public function __construct()
    {
        add_shortcode('cynic_seo_impressive_job_list', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        $this->post_type = 'positions';
        $this->taxonomy = 'positions_cat';
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $postsarr = cynicSEO_get_all_case_studies($this->post_type);
            $categories = cynicSEO_feature_get_catetories_by_texonomy($this->taxonomy);
            if (isset($categories['Select'])) {
                array_shift($categories);
            }

            $args = array(
                'base' => 'cynic_seo_impressive_job_list',
                'name' => __('Job List', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Filter By :', 'cynic'),
                        'value' => array(
                            __('Select One', 'cynic') => '',
                            __('Jobs Wise', 'cynic') => 'jobs_wise',
                            __('Positions Wise', 'cynic') => 'positions_wise',
                        ),
                        'param_name' => 'filter_by',
                        'admin_label' => true,
                        "description" => __(getCustomPostTypeAdminUrl('positions'))
                    ),

                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Jobs "),
                        "param_name" => "jobs_wise",
                        "value" => $postsarr, //value
                        "std" => "",
                        'dependency' => array(
                            'element' => 'filter_by',
                            'value' => 'jobs_wise',
                        ),

                    ),

                    array(
                        'type' => 'checkbox',
                        "heading" => __("Select Positions Category"),
                        "param_name" => "positions_wise",
                        "admin_label" => true,
                        'value' => $categories,
                        'dependency' => array(
                            'element' => 'filter_by',
                            'value' => 'positions_wise',
                        ),
                        'admin_label' => true,
                        "description" => __("Please choose the customer reviews to display on carousel.")
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
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "div",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'value' => array(
                            'Select Order' => '',
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "div",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Apply Button Text', 'cynic'),
                        'value' => 'Apply Now',
                    ),

                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Select Open Type' => '',
                            'Same Window' => '_self',
                            'New Window' => '_blank',
                        ),
                    ),

//                    array(
//                        "holder" => "",
//                        "class" => "",
//                        'heading' => 'Show All Job Button Link',
//                        'type' => 'vc_link',
//                        'param_name' => 'show_all_button_link',
//                        'value' => '',
//                        'description' => __('Leave empty if you don\'t want to use it.', 'cynic'),
//                    ),


                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'filter_by' => '',
                'jobs_wise' => '',
                'positions_wise' => '',
                'orderby' => 'id',
                'order' => 'DESC',
                'button_text' => 'Apply Now',
                'open_type' => '_blank',
//                'show_all_button_link' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $filter_by = $attributes['filter_by'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];
        $button_text = $attributes['button_text'];
        $open_type = $attributes['open_type'];
//        $linkArr = vc_build_link($attributes['show_all_button_link']);

        $post_type = $this->post_type;
        $taxonomy = $this->taxonomy;

        if ($filter_by == 'jobs_wise') {
            $jobs_wise = $attributes['jobs_wise'];
            $jobs_wiseArr = explode(',', $jobs_wise);
            $args = array(
                'post_type' => $post_type,
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => false,
                'post_name__in' => $jobs_wiseArr
            );
            $the_query = new WP_Query($args);
            $settings = [];
        } else {

            $positions_wise = $attributes['positions_wise'];
            $jobs_wiseArr = explode(',', $positions_wise);

            $args = array(
                'post_type' => $post_type,
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true,
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $jobs_wiseArr,
                    'operator' => 'IN',
                ),
            );
            $the_query = new WP_Query($args);
        }

        ob_start();
        if (isset($the_query)) {
            if ($the_query->have_posts()) {
                ?>
                <div class="list-of-jobs <?php echo esc_attr($extra_class); ?>">
                    <?php
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        ?>
                        <div class="position">
                            <h3><?php the_title() ?>
                                <?php
                                $id = get_the_ID();
                                $categories = get_the_terms($id, $taxonomy);
                                $categoryName = '';
                                if (isset($categories[0])) {
                                    $categories = $categories[0];
                                    $categoryName = $categories->name;
                                }
                                ?>
                                <span><?php echo esc_html_cynicSEO_string($categoryName); ?></span>
                            </h3>
                            <?php the_excerpt()?>
                            <a href="<?php echo get_permalink(); ?>" target="<?php echo esc_attr($open_type); ?>"
                               class="primary-btn"><?php echo esc_attr($button_text); ?></a>
                        </div>
                        <?php
                    } ?>
                </div>
                <?php
//                echo cynicSEO_anchor_link_html($linkArr, 'secondary-btn');
            } else {
                ?>
                <div class="list-of-jobs">
                    <p><?php echo esc_html_e('No result found.', 'cynic') ?></p>
                </div>
                <?php
            }
        }
        return ob_get_clean();
    }

}
