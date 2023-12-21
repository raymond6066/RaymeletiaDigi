<?php

class CynicCaseStudiesGrids {

    public function __construct() {
        add_shortcode('cynic_case_studies', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }
            $args = array(
                'base' => 'cynic_case_studies',
                'name' => __('Case Studies Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Listing Page',
                        'type' => 'dropdown',
                        'param_name' => 'listing_page',
                        'value' => $pagearr,
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
                        'heading' => 'Display Pagination',
                        'type' => 'dropdown',
                        'param_name' => 'pagi_status',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '0',
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
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'listing_page' => '',
            'col_size' => '6',
            'pagi_status' => '1',
            'posts_per_page' => '4',
            'orderby' => 'ID',
            'order' => 'DESC',
                ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'case_studies',
            'posts_per_page' => (int) $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        if ($pagi_status == 1) {
            $args['paged'] = $paging = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        }

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
            if ($listing_page) {
                $mainpagelink = get_permalink((int) $listing_page);
                if ($pagi_status == 1) {
                    $mod = strpos($mainpagelink, '?') !== FALSE ? '&' : '?';
                    $totalpages = ceil($query->found_posts / (int) $posts_per_page);
                    if($totalpages>1){ ?>
                        <div class="col-xs-12">
                            <nav class="pagination-case">
                                <div class="pagination justify-content-center">
                                    <?php
                                    echo paginate_links(array(
                                        'base' => $mainpagelink . $mod . 'paged=%#%',
                                        'format' => $mod . 'paged=%#%',
                                        'current' => $paging,
                                        'total' => $totalpages,
                                        'prev_text' => wp_kses_post(__('<span class="icon-chevron-left"></span>', 'cynic')),
                                        'next_text' => wp_kses_post(__('<span class="icon-chevron-right"></span>', 'cynic')),
                                    ));
                                    ?>
                                </div>
                            </nav>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="row">
                        <div class="col-xs-12"> <a href="<?php echo esc_url($mainpagelink) ?>" class="btn btn-fill full-width"><?php esc_html_e('Discover more', 'cynic') ?></a> 
                        </div>
                    </div>
                    <?php
                }
            }
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}
