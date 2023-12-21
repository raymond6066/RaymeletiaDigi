<?php

class CynicAboutUs {

    public function __construct() {
        add_shortcode('cynic_impressive_reviews', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'), 1000);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            global $wpdb;
            $postsarr = cynic_get_posts('reviews');

            /* Get all pages */
            $pagearr = cynic_get_pages();

            $args = array(
                'base' => 'cynic_impressive_reviews',
                'name' => __('Impressive Customer Reviews', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Customer Review"),
                        "param_name" => "reviews_param",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => " ",
                        "description" => __("Please choose the reviews to display in impressive review section\'s.")
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'post_title',
                            'Publish Date' => 'post_date',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'revieworder',
                        'value' => array(
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Display More Button', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'display_load_more',
                        'value' => array(
                            'Yes' => '1',
                            'No' => '2',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        ),
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
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
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
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
                'reviews_param' => '',
                'orderby' => 'ID',
                'revieworder' => 'ASC',
                'display_load_more' => '2',
                'button_text' => 'discover more',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
            ), $atts);
        extract($atts);
        if ($reviews_param) {

            global $wpdb;
            $postNamesArray = explode(',', $reviews_param);
            $postNameString = implode("','", $postNamesArray);

            $postNames = "'".$postNameString."'";
            $post_per_page = count($postNamesArray);
            $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='reviews' AND post_name IN ($postNames) ORDER BY $orderby $revieworder");
            ob_start();
            if (!empty($posts) && !is_wp_error($posts)) { ?>
                <div class="container">
                    <div class="grid-wrapper">
                        <div class="row justify-content-center">
                            <?php
                            foreach ($posts as $post) {
                                $image_id = get_post_thumbnail_id( $post->ID );
                                $reviewer_designation = get_post_meta($post->ID, 'reviews_reviewer_org', TRUE);
                                $category = get_the_terms( $post->ID, 'reviews-cat' ); ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="img-card review-card text-left">
                                        <div class="media align-items-center">
                                            <?php if($image_id > 0) { ?>
                                                <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                            <?php } ?>
                                            <div class="media-body">
                                                <h5><?php echo $post->post_title; ?></h5>
                                                <p><?php echo $reviewer_designation; ?></p>
                                            </div>
                                        </div>
                                        <p class="regular-text"><?php echo $post->post_content; ?></p>
                                    </div>
                                    <!-- End of .content -->
                                </div>
                                <!-- End of .col-sm-4 -->
                                <?php
                                if($display_load_more==1) {
                                    $link = cynic_get_links($button_link, $internal_link, $external_link);
                                    if (!empty($link)) {?>
                                    <div class="col-lg-12 text-center">
                                        <a href="<?php echo esc_url($link) ?>"
                                           class="custom-btn secondary-btn"
                                            <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?>>
                                            <?php echo esc_html($button_text); ?></a>
                                    </div>
                                    <?php
                                    }
                                }
                            } ?>
                        </div>
                    </div>
                </div>
                <?php
                return ob_get_clean();
            }
        }
    }

}
