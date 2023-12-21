<?php

class CynicPositionGrids {

    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_positions', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        self::$noncePlain = 'd23b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);


        /* To limit excerpt length and remove dot*/
        function custom_excerpt_more($more) {
            return ''; //you can change this to whatever you want
        }
        add_filter('excerpt_more', 'custom_excerpt_more');
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_positions',
                'name' => __('Positions Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
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
                        'heading' => 'Show post per page',
                        'type' => 'dropdown',
                        'param_name' => 'post_per_page',
                        'value' => array(
                            'all' => '-1',
                            '3' => '3',
                            '6' => '6',
                            '9' => '9',
                            '12' => '12',
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
                        'heading' => 'Button Text',
                        'type' => 'textfield',
                        'param_name' => 'button_text',
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'orderby' => 'ID',
                'post_per_page' => '',
                'order' => 'DESC',
                'button_text' => 'View Details'
            ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'positions',
            'posts_per_page' => $post_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $button_text = (isset($button_text) && !empty($button_text)) ? $button_text : 'Load More';
        ob_start();
        if ($query->have_posts()) {
            $counter = 0;
            $taxonomy = 'positions_cat';
            $termsArgs = array('taxonomy'=>$taxonomy, 'hide_empty'=>false);
            $categories = get_terms($termsArgs);
            ?>
            <div class="row">
            <?php
            $thumbsize = 'cynic-positions-hveq';
            while ($query->have_posts()) {
                $query->the_post();
                $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                $imgsrc = false;
                $cat_name = '';
                if (!empty($categories) && !is_wp_error($categories)) {
                    $cats = array();
                    foreach ($categories as $c => $cat) {
                        $cats[] = $cat->name;
                    }
                    $cat_name = (isset($cats) && !empty($cats)) ? implode(',', $cats) : "";
                }
                if (has_post_thumbnail()) {
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);
                    $imgsrc = $imgsrc[0];
                }
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="content">
                        <h3> <?php esc_html_e(the_title(), 'cynic') ?> <span>department: <?php esc_html_e($cat_name, 'cynic'); ?></span></h3>
                        <div class="inner_content  equalheight">
                            <?php the_excerpt(); ?>
                            <a href="javascript:void(0)"class="btn btn-fill proDetModal" data-postid="<?php echo (int) esc_attr(get_the_ID()); ?>" data-posttype="positions"><?php echo esc_html($button_text); ?></a>
                        </div>
                        <!-- End of .inner_content -->
                    </div>
                    <!-- End of .content -->
                </div>
                <?php if ($post_per_page > 3 && $counter % 3 === 2) { ?>
                    </div><div class="row">
                <?php } ?>
                <!-- End of .col-md-4 -->
                <?php
                $counter++;
            }
            ?>
            </div>
            <!-- End of .row -->
            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}
