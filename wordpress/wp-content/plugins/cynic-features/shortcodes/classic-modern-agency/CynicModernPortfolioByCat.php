<?php
class CynicModernPortfolioByCat {
    public static $securityNonce, $noncePlain;

    public function __construct() {
        add_shortcode('cynic_modern_portfolio_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
        self::$noncePlain = 'd21b#com2%$fd@ad';
        self::$securityNonce = wp_create_nonce(self::$noncePlain);
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $taxonomy = 'portfolio-cat';
            global $wpdb;

            /*Gel All Portfolio Category*/
            $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
            $termsarr = array('Select' => '');
            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $termsarr[$term->name] = $term->slug;
                }
            }
            
            /* Get all pages */
            $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
            $pagearr = array('Select' => '');
            if ($pages && !is_wp_error($pages)) {
                foreach ($pages as $page) {
                    $pagearr[$page->post_title] = $page->post_name;
                }
            }
            
            $args = array(
                'base' => 'cynic_modern_portfolio_by_cat',
                'name' => __('Modern portfolio By Category', 'cynic'),
                "category" => __("Cynic Modern", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "dropdown",
                        "heading" => __("Select Portfolio"),
                        "param_name" => "select_cat",
                        "admin_label" => true,
                        "value" => $termsarr, //value
                        "std" => " ",
                        "description" => __("Please choose the portfolio to display best portfolio\'s.")
                    ),
                    array(
                        "holder" => "div",
                        'param_name' => 'pp',
                        'type' => 'textfield',
                        'heading' => __('Show Portfolio', 'cynic'),
                        'value' => '6',
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
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Select Layout',
                        'type' => 'dropdown',
                        'param_name' => 'theme_layout',
                        'value' => array(
                            'Modern Layout' => 'modern',
                            'Classic Layout' => 'classic',
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
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'select_cat' => '',
            'pp' => 6,
            'orderby' => 'ID',
            'order' => 'DESC',
            'theme_layout' => 'modern',
            'button_text' => 'discover more',
            'button_link' => '',
            'internal_link' => '',
            'external_link' => '#',
            'open_type' => '0',
                ), $atts);
        extract($atts);
        if ($select_cat) {
                $taxonomy = 'portfolio-cat';
                $posts_per_page = $pp;
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => (int) $posts_per_page,
                    'orderby' => $orderby,
                    'order' => $order,
                    'ignore_sticky_posts' => true,
                );
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $select_cat,
                    ),
                );
                
                $query = new WP_Query($args);
                ob_start();
                $elemid = 'portfolio-' . rand(000000, 999999);
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
                        
                            if (has_post_thumbnail()) {
                                $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbsize);
                                $imgsrc = $imgsrc[0];
                            }
                            $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type', TRUE);
                            $video_url = get_post_meta(get_the_ID(), 'portfolio_video_link', TRUE);
                            $button_hover_text = get_post_meta(get_the_ID(), 'portfolio_button_hover_text', TRUE);
                            $image_button_hover_text = (isset($button_hover_text) && !empty($button_hover_text)) ? $button_hover_text : esc_html('DISCOVER');
                            $type = "image"; ?>
                            <div class="mix logo col-md-4 col-sm-4 col-xs-6">
                                <?php if (!$portfolio_type) { ?>
                                    <div class="pro-item-img" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                                        <div class="por-overley">
                                            <div class="text-inner"> 
                                                <a href="javascript:void(0)" data-type="image" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="btn btn-nofill proDetModal" data-toggle="modal"><?php echo esc_html($image_button_hover_text) ?></a> 
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { $type="video"; ?>
                                    <div class="pro-item-img video_popup" data-bg="<?php echo $imgsrc ? esc_url($imgsrc) : null; ?>">
                                        <div class="por-overley">
                                            <div class="text-inner"> <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="video-popup"><span class="icon-play-circle"></span></a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End of .video_popup -->
                                <?php if(isset($theme_layout) && $theme_layout=="modern") { ?>
                                    <div class="text-content">
                                        <h3>
                                        <?php if (!$portfolio_type) { ?>
                                            <a href="javascript:void(0)" data-type="<?php echo esc_attr($type); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="proDetModal" data-toggle="modal"><?php the_title() ?><span><?php echo esc_html($relativetitle); ?></span></a>
                                        <?php } else {?>
                                            <a href="<?php echo esc_attr($video_url); ?>" data-type="video" data-video="<?php echo esc_attr($video_url); ?>" data-postid="<?php the_ID() ?>" data-posttype="portfolio" class="video-popup"><?php the_title(); ?>
                                                <span><?php echo esc_html($relativetitle); ?></span>
                                            </a>
                                        <?php } ?>
                                        </h3>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div><!--row-->
                    <?php
                    $link="";
                    if((isset($internal_link)) && is_numeric($internal_link)){
                        $page_link = get_permalink((int) $internal_link);
                        $link = (!empty($page_link)) ? $page_link : $external_link;
                    }else{
                        $pageObj = get_page_by_path( $internal_link );
                        if($pageObj){
                            $link = get_permalink((int) $pageObj->ID);
                        }else{
                            $link = $external_link;
                        }
                    }

                    if (!empty($link)) { ?>
                        <div class="row">
                            <div class="col-xs-12"> 
                                <a href="<?php echo esc_url($link) ?>" <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?> class="btn btn-fill full-width"><?php esc_html_e($button_text, 'cynic') ?></a> 
                            </div>
                        </div><!--row-->
                        <?php
                    }
                }
                wp_reset_postdata(); 
                return ob_get_clean();
            }
        }

}