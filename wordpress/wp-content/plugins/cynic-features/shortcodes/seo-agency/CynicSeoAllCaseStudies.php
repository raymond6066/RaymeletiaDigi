<?php
class CynicSeoAllCaseStudies {
    public function __construct() {
        add_shortcode('cynic_seo_case_studies', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $pagearr = cynicSEO_get_all_pages();
            $args = array(
                'base' => 'cynic_seo_case_studies',
                'name' => __('All Case Studies', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
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
                        "description" => __(getCustomPostTypeAdminUrl('case_studies'))
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
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'posts_per_page',
                        'type' => 'textfield',
                        'heading' => __('Show posts in a page', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
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
                        'admin_label' => true,
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
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Read More Button Text',
                        'type' => 'textfield',
                        'param_name' => 'read_more_button_text',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $attributes = shortcode_atts(
        array(
            'listing_page' => '',
            'pagi_status' => '1',
            'posts_per_page' => '4',
            'orderby' => 'ID',
            'order' => 'DESC',
            'read_more_button_text' => 'Read More'
        ), $atts);

        $listing_page = $attributes['listing_page'];
        $pagi_status = $attributes['pagi_status'];
        $posts_per_page = $attributes['posts_per_page'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];
        $read_more_button_text = $attributes['read_more_button_text'];

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
        ob_start();
        if ($query->have_posts()) {
            $thumbsize = 'cynic-case-studies-thumbnail';?>
            <div class="row">
                <?php while($query->have_posts()){
                    $query->the_post(); ?>
                    <div class="col-md-6">
                        <div class="box-with-img">
                            <a href="<?php the_permalink() ?>" class="img-container">
                                <?php 
                                if(has_post_thumbnail()) {
                                    the_post_thumbnail($thumbsize, array('class' => 'img-fluid'));
                                } ?>
                            </a>
                            <!-- End of .img-container -->

                            <div class="text-content  text-left">
                                <h3>
                                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                </h3>
                                <p><?php the_excerpt() ?></p>
                                <a href="<?php the_permalink() ?>" class="readmore-btn">
                                    <div> <?php echo esc_html_cynicSEO_string($read_more_button_text); ?>
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <!-- End of .readmore-btn -->
                            </div>
                            <!-- End of .text-content -->
                        </div>
                        <!-- End of .content -->
                    </div>
                    <!-- End of .col-md-6 -->
                    <?php
                } ?>
                <?php 
                if ($listing_page) {
                    $mainpagelink = get_permalink((int) $listing_page);
                    if($pagi_status==1) {
                        $mod = strpos($mainpagelink, '?') !== FALSE ? '&' : '?';
                        $totalpages = ceil($query->found_posts / (int) $posts_per_page);
                        if($totalpages>1){ ?>
                            <div class="col-md-12 text-center">
                                <div class="pagination-wrapper">
                                <nav aria-label="Page navigation example">
                                    <div class="pagination justify-content-center">
                                        <?php
                                        echo paginate_links(array(
                                            'base' => $mainpagelink . $mod . 'paged=%#%',
                                            'format' => $mod . 'paged=%#%',
                                            'current' => $paging,
                                            'total' => $totalpages,
                                            'prev_text' => esc_html__('&lt;', 'cynic' ),
                                            'next_text' => esc_html__('&gt;', 'cynic' ),
                                        ));
                                        ?>
                                    </div>
                                    </nav>
                                </div>
                            </div>
                            <?php 
                        }
                    } 
                } ?>
            </div>
        <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }
}
