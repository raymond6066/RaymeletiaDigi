<?php

class CynicFeaturedPortfolios {

    public function __construct() {
        add_shortcode('cynic_featured_projects', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_featured_projects',
                'name' => __('Featured Portfolio Grids', 'cynic'),
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
                        'heading' => 'Featured Text',
                        'type' => 'textfield',
                        'param_name' => 'featured_text',
                        'value' => '',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'posts_per_page' => '-1',
            'orderby' => 'ID',
            'order' => 'DESC',
            'featured_text' => 'Featured'
                ), $atts);
        extract($atts);
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => true,
            'meta_query' => array(
                array(
                    'key' => 'portfolio_featured',
                    'value' => '1',
                ),
            )
        );

        $query = new WP_Query($args);
        $categories = array();
        $featured_text = (isset($featured_text) && !empty($featured_text)) ? $featured_text : "Featured";
        ob_start();
        if ($query->have_posts()) {
            $columncls = 'col-xs-12 col-md-4 col-sm-6';
            $thumbsize = 'cynic-onepage-portfolio-img';
            ?>
            <div class="row">
                <?php
                $counter = 0;
                $lastPost = 0;
                while ($query->have_posts()) {
                    $query->the_post();
                    $taxonomy = 'portfolio-cat';
                    $isFeatured = cynic_get_meta('portfolio_featured');
                    $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";

                    $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                    $relativetitle = '';
                    
                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $c => $cat) {
                            if ($c > 0) {
                                $relativecatcls .= ' ';
                            }
                            $relativetitle .= ', '. $cat->name;
                        }
                    }
                    $relativetitle .= ' ';
                    $relativetitle = trim($relativetitle,",");

                    $lastPost++; 
                    ?>
                    <div class="<?php echo esc_attr($columncls) ?>">
                        <div class="box-content-with-img <?php echo esc_attr($class) ?>"> 
                            <?php the_post_thumbnail($thumbsize, array('class' => 'img-responsive')) ?>
                            <div class="box-content-text equalheight">
                                <?php if (!empty($categories) && !is_wp_error($categories)) { ?>
                                    <p class="gray-text">
                                        <?php echo esc_html($featured_text) . ' - ' . esc_html($relativetitle); ?>
                                    </p>
                                <?php } ?>
                                <h3 class="semi-bold">
                                    <a href="#" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="proDetModal" data-toggle="modal"><?php the_title() ?></a>
                                </h3>
                                <?php the_excerpt() ?>
                            </div>
                        </div>
                    </div><!--end <?php echo $columncls ?>-->
                <?php } ?>
            </div><!--row-->
            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}
