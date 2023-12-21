<?php

class CynicSeoFaqsByCategory
{
    public function __construct()
    {
        add_shortcode('cynic_seo_faq_by_cat', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            //All Categories
            $taxonomy = 'faq-cat';
            $termsarr = cynicSEO_feature_get_catetories_by_texonomy($taxonomy);

            $args = array(
                'base' => 'cynic_seo_faq_by_cat',
                'name' => __('FAQs', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        'heading' => 'FAQ Title',
                        'type' => 'textfield',
                        'param_name' => 'faq_title',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Select FAQ"),
                        "param_name" => "select_cat",
                        "admin_label" => true,
                        "value" => $termsarr, //value
                        "std" => " ",
                        "description" => __(getCustomPostTypeAdminUrl('faq'))
                    ),
                    array(
                        "holder" => "div",
                        'param_name' => 'pp',
                        'type' => 'textfield',
                        'heading' => __('Show FAQ', 'cynic'),
                        'value' => '6',
                        'admin_label' => true,
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
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'value' => array(
                            'Select Order' => '',
                            'Ascending' => 'ASC',
                            'Decending' => 'DESC',
                        ),
                        'admin_label' => true,
                    ),

                ),
            );
            vc_map($args);

        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'faq_title' => '',
                'select_cat' => '',
                'pp' => 6,
                'orderby' => 'ID',
                'order' => 'DESC',
            ), $atts);
        extract($atts);

        if ($select_cat) {
            $taxonomy = 'faq-cat';
            $posts_per_page = $pp;
            $args = array(
                'post_type' => 'faq',
                'orderby' => $orderby,
                'order' => $order,
                'posts_per_page' => (int)$posts_per_page
            );
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $select_cat,
                ),
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
            ob_start();
                ?>

                <div class="accordion-container">
                    <?php
                    if (!empty($faq_title)) {
                        ?>
                        <h2><?php echo esc_html_cynicSEO_string($faq_title); ?></h2>
                        <?php
                    }
                    $prefixID = rand(0, 100);
                    ?>
                    <div id="accordion-<?php echo esc_attr($prefixID); ?>" role="tablist">
                        <?php $faqCounter = 1;
                        while ($query->have_posts()) {
                            $query->the_post();
                            if ($faqCounter == 1) {
                                $showClass = "collapse show";
                                $showClass2 = "";
                                $expandedClass="true";
                            } else {
                                $showClass = "collapse";
                                $showClass2 = "collapsed";
                                $expandedClass="false";
                            } ?>
                            <div class="card">
                                <div class="card-header" role="tab" id="heading<?php echo esc_attr($prefixID.$faqCounter); ?>">
                                    <h4 class="mb-0">
                                        <a class="<?php echo esc_attr($showClass2); ?>" data-toggle="collapse"
                                           href="#collapse<?php echo esc_attr($prefixID.$faqCounter); ?>" aria-expanded="<?php echo $expandedClass; ?>"
                                           aria-controls="collapse<?php echo esc_attr($prefixID.$faqCounter); ?>">
                                            <?php the_title() ?>
                                        </a>
                                    </h4>
                                </div>
                                <!-- End of .card-header -->
                                <div id="collapse<?php echo esc_attr($prefixID.$faqCounter); ?>"
                                     class="<?php echo esc_attr($showClass) ?>" role="tabpanel"
                                     aria-labelledby="heading<?php echo esc_attr($prefixID.$faqCounter); ?>"
                                     data-parent="#accordion-<?php echo esc_attr($prefixID) ?>">
                                    <div class="card-body">
                                        <p><?php the_content() ?></p>
                                    </div>
                                    <!-- End of .card-body -->
                                </div>
                                <!-- End of #collapseOne -->
                            </div>
                            <!-- End of .card -->
                            <?php $faqCounter++;
                        } ?>
                    </div>
                    <!-- End of #accordion -->
                </div>
                <!-- End of .accordion-container -->
                <?php
                //wp_reset_postdata(); 
            return ob_get_clean();
            }
        }
}
}