<?php
class CynicModernFeaturedPortfolio {
    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_modern_featured_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        self::$noncePlain = 'd21b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_modern_featured_portfolio',
                'name' => __('Modern Featured portfolio', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
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
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
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
                'posts_per_page' => '-1',
                'orderby' => 'ID',
                'order' => 'DESC',
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
        $elemid = 'portfolio-' . rand(000000, 999999);
        $categories = array();
        ob_start();
        $counter = 0;
        $lastPost = 0;
        if ($query->have_posts()) {
            $thumbsize = 'cynic-onepage-portfolio-img';
            $taxonomy = 'portfolio-cat';

            $termsArgs = array('taxonomy'=>$taxonomy, 'hide_empty'=>false);
            $categories = get_terms($termsArgs);

            if (!empty($categories) && !is_wp_error($categories)) {
                $termID = 1;
                foreach ($categories as $c => $cat) {
                    $mixitupcats[$cat->slug] = $cat->name;
                    $catsTerms[$cat->slug] = $cat->term_id;
                    $termID++;
                }
            } ?>
            <div class="port-cat-con row">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();

                    $isFeatured = cynic_get_meta('portfolio_featured');
                    $class = (isset($isFeatured) && $isFeatured == 1) ? "is-featured" : "";

                    $categories = wp_get_post_terms(get_the_ID(), $taxonomy);
                    $imgsrc = false;

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
                    $image_id = get_post_thumbnail_id(get_the_ID());
                    $imgsrc = wp_get_attachment_url($image_id, 'full');

                    $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                    $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                    $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                    $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : esc_html('DISCOVER');
                    $type = "image"; ?>
                    <div class="mix col-md-4 col-sm-4 col-xs-6">
                        <?php if (!$portfolio_type) { ?>
                            <div class="pro-item-img <?php echo esc_attr($class) ?>" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                                <div class="por-overley">
                                    <div class="text-inner">
                                        <a href="javascript:void(0)" data-type="image" data-postid="<?php echo esc_attr(get_the_ID()) ?>" data-posttype="portfolio" class="btn btn-nofill proDetModal" data-toggle="modal"><?php echo esc_html($image_button_hover_text) ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php } else { $type="video"; ?>
                            <div class="pro-item-img video_popup <?php echo esc_attr($class) ?>" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                                <div class="por-overley">
                                    <div class="text-inner"> <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php echo esc_attr(get_the_ID()) ?>" data-posttype="portfolio" class="video-popup"><span class="icon-play-circle"></span></a></div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- End of .video_popup -->
                        <div class="text-content">
                            <h3>
                                <?php if (!$portfolio_type) { ?>
                                    <a href="javascript:void(0)" data-type="<?php echo esc_attr($type); ?>" data-postid="<?php echo esc_attr(get_the_ID()) ?>" data-posttype="portfolio" class="proDetModal" data-toggle="modal"><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a>
                                <?php } else { $type="video"; ?>
                                    <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="video-popup"><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a>
                                <?php } ?>
                            </h3>
                        </div>
                    </div>
                <?php } ?>
            </div><!--row-->
            <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

}