<?php

class CynicLatestBlogGrids {

    public function __construct() {
        add_shortcode('cynic_latest_blogs', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $imagesizes = get_intermediate_image_sizes();
            $imgszarr = array('full' => 'full');
            foreach ($imagesizes as $imgsize) {
                $imgszarr[$imgsize] = $imgsize;
            }

            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->ID;
                }
            }

            $args = array(
                'base' => 'cynic_latest_blogs',
                'name' => __('Latest Blog Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Thumbnail Size", "cynic"),
                        'type' => 'dropdown',
                        'param_name' => 'thumb_size',
                        'value' => $imgszarr,
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
                        'heading' => 'Button Text',
                        'type' => 'textfield',
                        'param_name' => 'button_text',
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
                        'heading' => 'Link Open Type',
                        'type' => 'dropdown',
                        'param_name' => 'link_open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
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
            'thumb_size' => 'full',
            'orderby' => 'ID',
            'order' => 'DESC',
            'button_text' => 'Read More Blog',
            'button_link' => '1',
            'internal_link' => '',
            'external_link' => '#',
            'link_open_type' => '0',
                ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
        );
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if ($query->have_posts()) {
            ?>
            <div class="row">
                    <?php while ($query->have_posts()) { ?>
                    <div class="col-sm-6 col-md-4 col-xs-12">
                        <?php
                        $query->the_post();
                        $isFeatured = cynic_get_meta('cynic_post_featured');
                        $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";
                        $categories = get_the_category();
                        ?>
                        <div class="blog-left <?php echo esc_attr($class); ?> equalheight">
                                <?php the_post_thumbnail($thumb_size, array('class' => 'img-responsive blog-img')) ?>
                            <div class="box-green-border"> <span><?php echo get_the_date() ?> -</span><?php
                                if (!empty($categories)) {
                                    echo ' <a href="' . esc_url(get_category_link($categories[0]->term_id)) . '"><span>' . esc_html($categories[0]->name) . '</span></a>';
                                }
                                ?> <a class="post-title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                <?php the_excerpt() ?>
                            </div>
                        </div>
                    </div><!--col-md-4-->
            <?php } ?>
            </div><!--row-->
            <?php 
            if (isset($button_link) && !empty($button_link)) { 
            $link = (isset($internal_link) && !empty($internal_link)) ? get_permalink((int) $internal_link) : $external_link; ?>
                <!--read more blog button-->
                <div class="row">
                    <div class="col-xs-12"><a href="<?php echo esc_url($link) ?>" <?php if (isset($link_open_type) && $link_open_type == '1') { ?> target="_blank" <?php } ?> class="btn btn-fill full-width"><?php esc_html_e($button_text, 'cynic') ?></a></div>
                </div>
            <?php } ?>
            <!--end read more blog button--> 
            <?php
            wp_reset_postdata();
            return ob_get_clean();
        }
    }

}
