<?php
/**
 * Description of CynicCaseStudiesByCat
 *
 * @author Axilweb
 */
class CynicCaseStudiesByCat {

    public function __construct() {
        add_shortcode('cynic_case_studies_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            /* Get All Pages*/
            
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }
            
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
                'base' => 'cynic_case_studies_by_cat',
                'name' => __('Case Studies By Category', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Select Case Studies Category',
                        'type' => 'dropdown',
                        'param_name' => 'case_studies_cat',
                        'value' => $termsarr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Column size',
                        'type' => 'dropdown',
                        'param_name' => 'col_size',
                        'value' => array(
                            'One Half' => '6',
                            'One Third' => '4',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show posts in a page', 'cynic'),
                        'value' => '',
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
                )
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'case_studies_cat' => '',
            'col_size' => '6',
            'posts_per_page' => '4',
            'orderby' => 'ID',
            'order' => 'DESC',
            'button_text' => 'View Details',
            'button_link' => '1',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        $taxonomy = 'case_studies_cat';
        $args = array(
            'post_type' => 'case_studies',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => (string) $case_studies_cat,
            ),
        );
        
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) {
            $thumbsize = 'cynic-related-case';
            $columncls = 'col-xs-12 col-sm-6';
            if ($col_size == '4') {
                $columncls = 'col-xs-12 col-sm-4';
                $thumbsize = 'cynic-related-case-medium';
            }
            ?>
            <div class="row">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $challenge_text = cynic_get_meta('cynic_case_studies_challenges_text');
                    ?>
                    <div class="<?php echo esc_attr($columncls) ?>">
                        <div class="box-content-with-img margin-btm-60 equalheight"> 
                            <?php the_post_thumbnail($thumbsize, array('class' => 'img-responsive')) ?>
                            <div class="box-content-text">
                                <h3 class="semi-bold"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                <?php the_excerpt() ?>
                                <a href="<?php the_permalink() ?>" class="medium-btn2 btn btn-fill"><?php esc_html_e('VIEW DETAILS', 'cynic') ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div><!--row-->
            
            <?php 
            if (isset($button_link) && !empty($button_link)) { 
                $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <!--read more blog button-->
                <div class="row">
                    <div class="col-xs-12"><a href="<?php echo esc_url($link) ?>" <?php if (isset($open_type) && $open_type == '1') { ?> target="_blank" <?php } ?> class="btn btn-fill full-width"><?php esc_html_e($button_text, 'cynic') ?></a></div>
                </div>
                <?php 
            } 
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}

