<?php
class CynicSeoFeaturedCaseStudies{
    public function __construct() {
        add_shortcode('cynic_seo_featured_case_studies', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $postsarr = cynicSEO_get_all_case_studies($post_type="case_studies");
            $args = array(
                'base' => 'cynic_seo_featured_case_studies',
                'name' => __('Featured Case Studies', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Case Studies"),
                        "param_name" => "case_studies_param",
                        "admin_label" => true,
                        "value" => $postsarr, //value
                        "std" => "",
                        "description" => __(getCustomPostTypeAdminUrl('case_studies'))
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
                        'heading' => 'Read More Button Text',
                        'type' => 'textfield',
                        'param_name' => 'read_more_button_text',
                        'value' =>'Read More'
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $attributes = shortcode_atts(
        array(
            'case_studies_param' => '',
            'orderby' => 'ID',
            'order' => 'ASC',
            'read_more_button_text' => 'Read More',
        ), $atts);

        $case_studies_param = $attributes['case_studies_param'];
        $orderby = $attributes['orderby'];
        $order = $attributes['order'];
        $read_more_button_text = $attributes['read_more_button_text'];

        global $wpdb;

        $postNamesArray = explode(',', $case_studies_param);
        $postNameString = implode("','", $postNamesArray);

        $postNames = "'".$postNameString."'";

        $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='case_studies' AND post_name IN ($postNames) ORDER BY $orderby $order");
        ob_start();
        if (!empty($posts) && !is_wp_error($posts)) {
            $thumbsize = 'cynic-case-studies-thumbnail'; ?>
            <div class="tab-container">
                <ul class="nav nav-tabs row no-gutters" id="f-projects" role="tablist">
                    <?php $i=1; foreach ($posts as $post) {
                        $tabImage = get_post_meta($post->ID, 'cynic_case_studies_tab_logo', true); ?>
                        <li class="nav-item col">
                            <a class="nav-link <?php if($i==1){ echo esc_attr('active'); } ?>" id="<?php echo esc_attr('projects-tab-'.$i) ?>" data-toggle="tab" href="<?php echo esc_attr('#projects-content-'.$i) ?>" role="tab" aria-controls="<?php echo esc_attr('projects-content-'.$i)?>"
                                aria-selected="true">
                                <?php echo wp_get_attachment_image( (int) $tabImage , 'full' , "", array( "class" => "d-block mx-auto" ) );  ?>
                            </a>
                        </li>
                    <?php $i++; } ?>
                </ul>
                <!-- End of .nav-tabs -->
                <div class="tab-content" id="projects-tab-content">
                    <?php $i=1; foreach ($posts as $post) { ?>
                        <div class="tab-pane fade show <?php if($i==1){ echo esc_attr('active'); } ?>" id="<?php echo esc_attr('projects-content-'.$i) ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr('projects-content-'.$i) ?>">
                            <div class="row">
                                <div class="col-md-6 text-center text-md-left">
                                    <div class="content box-with-img">
                                        <a href="<?php echo get_permalink($post->ID) ?>" class="img-container">
                                            <?php echo get_the_post_thumbnail( $post->ID, $thumbsize, array( 'class' => 'img-fluid' ) ); ?>
                                        </a>
                                        <!-- End of .img-container -->

                                        <div class="text-content  text-left">
                                            <h3>
                                                <a href="<?php echo get_permalink($post->ID) ?>"><?php echo esc_html($post->post_title) ?></a>
                                            </h3>
                                            <p><?php echo cynicSEO_excerpt_by_id($post->ID); ?></p>
                                            <a href="<?php echo get_permalink($post->ID) ?>" class="readmore-btn">
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
                                <?php $counters = get_post_meta($post->ID, 'cynic_case_studies_counter_counter');
                                //echo "<pre>";print_r($counter); 
                                if(isset($counters[0]) && !empty($counters[0])) {?>
                                    <div class="col-md-6">
                                        <div class="counter-box">
                                            <div class="row">
                                                <?php foreach ($counters[0] as $counter) {
                                                                                                   ?>
                                                    <div class="col-md-6">
                                                        <div class="content text-center">
                                                            <?php
                                                            $fontIcon='grad-icon ';
                                                            if(isset($counter['cynic_case_studies_counter_icon'])){
                                                            $fontIcon ="grad-icon ".esc_attr__(($counter['cynic_case_studies_counter_icon']));
                                                            }
                                                            $counterHtml = "<i class=\"$fontIcon\"></i>";
                                                            if ((isset($counter['icon_type']) && $counter['icon_type'] == 'image_icon') && (isset($counter['cynic_case_studies_counter_image_icon'][0]))) {
                                                                $imagehtml = wp_get_attachment_image($counter['cynic_case_studies_counter_image_icon'][0], 'full');
                                                                if (!empty($imagehtml)) {
                                                                    $counterHtml = $imagehtml;
                                                                }
                                                            }
                                                            echo esc_html_cynicSEO_string($counterHtml);
                                                            ?>
                                                            <p>
                                                                <span class="d-block">
                                                                    <i class="counter"><?php echo esc_html($counter['cynic_case_studies_counter_value']); ?></i>%
                                                                </span> <?php echo esc_html($counter['cynic_case_studies_counter_title']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <!-- End of .col-md-6 -->
                                            </div>
                                            <!-- End of .row -->
                                        </div>
                                        <!-- End of .counter-box -->
                                    </div>
                                <?php } ?>
                                <!-- End of .col-sm -->
                            </div>
                            <!-- End of .row -->
                        </div>
                    <?php $i++; } ?>
                    <!-- End of .tab-pane-->
                </div>
                <!-- End of .tab-content -->
            </div>
            <!-- End of .tab-content -->
            <?php
        wp_reset_postdata(); 
        return ob_get_clean();
        }
    }
}