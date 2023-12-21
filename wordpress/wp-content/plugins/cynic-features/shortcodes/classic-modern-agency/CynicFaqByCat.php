<?php

class CynicFaqByCat {

    public function __construct() {
        add_shortcode('cynic_faq_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $taxonomy = 'faq-cat';
            global $wpdb;
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array();
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }

            $args = array(
                'base' => 'cynic_faq_cat',
                'name' => __('FAQ By Category', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'Faq Category',
                        'type' => 'checkbox',
                        'param_name' => 'select_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        'type' => 'dropdown',
                        'param_name' => 'pp',
                        'heading' => __('Show Faq Per Page', 'cynic'),
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
            'pp' => '3',
            'orderby' => 'ID',
            'order' => 'DESC'
                ), $atts);
        extract($atts);
        if ($select_cat) {
            $taxonomy = 'faq-cat';
            $posts_per_page = $pp;
            $slugs = explode(',', $select_cat);
            $categories = array();
            foreach($slugs as $slug){
                $categories[] = get_term_by( 'slug', $slug, $taxonomy );
            }
            ob_start();
            if(!empty($categories) && !is_wp_error($categories)){
                $top_counter = 1;
                foreach($categories as $cat) { ?>
                    <div class="faqs-content <?php if($top_counter==1) { echo esc_attr('bg-white'); } else { echo esc_attr('faqs-content2'); } ?>">
                        <h2 class="b-clor">FAQs: <?php echo esc_html($cat->name); ?></h2>
                        <hr class="dark-line">
                        <div class="accordion-section">
                            <div class="panel-group" id="accordion-<?php echo esc_attr($top_counter) ?>" role="tablist" aria-multiselectable="true">
                                <?php 
                                $args = array(
                                    'post_type' => 'faq',
                                    'posts_per_page' => (int)$posts_per_page, // set number of post per category here
                                    'orderby' => $orderby,
                                    'order' => $order,
                                    'ignore_sticky_posts' => true,
                                );
                                $args['tax_query'] = array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => (string) $cat->slug,
                                    ),
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()) { 
                                    $counter = 1;
                                    while ($query->have_posts()) { $query->the_post(); ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion-<?php echo esc_attr($top_counter) ?>" href="#collapse-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>"><i class="more-less icon-plus"></i><?php the_title(); ?></a>
                                                </h4>
                                            </div>
                                            <div id="collapse-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>" class="panel-collapse collapse" role="tabpane-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>" aria-labelledby="heading-<?php echo esc_attr($top_counter) ?>-<?php echo esc_attr($counter) ?>">
                                                <div class="panel-body">
                                                    <?php the_content() ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        $counter++;
                                    } 
                                
                                }?>
                            </div>
                        </div>
                        <!-- End of .accordion-section -->
                    </div>
                    <?php
                    $top_counter++;
                }
            }
            return ob_get_clean();
        }
    }

}
