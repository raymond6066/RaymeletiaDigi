<?php

class CynicSeoKnowAboutUsGrids
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_know_about_us_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_know_about_us_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Know About Us', 'cynic'),
                'base' => 'cynic_seo_know_about_us_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_know_about_us_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Show per row', 'cynic'),
                        'param_name' => 'per_row',
                        'description' => __('Select grid per row.', 'cynic'),
                        'value' => array(2, 3, 4),
                        'admin_label' => true,
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_know_about_us_grid',
                'name' => __('Know About Us Items', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_know_about_us_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __('Title text.', 'cynic'),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __('Short Description', 'cynic'),
                        'param_name' => 'short_description',
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Button Link',
                        'type' => 'vc_link',
                        'param_name' => 'button_link',
                        'value' => '',
                        'description' => __('Button link details', 'cynic'),
                    ),


                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = array())
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'per_row' => '4',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];
        $rows = 'col-lg-3';
        if ($per_row == 1) {
            $rows = 'col-lg-12';
        } elseif ($per_row == 2) {
            $rows = 'col-lg-6';
        } elseif ($per_row == 3) {
            $rows = 'col-lg-4';
        } elseif ($per_row == 4) {
            $rows = 'col-lg-3';
        }

        $this->per_row = $rows;


        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="content-block <?php echo esc_attr($extra_class); ?>">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'image' => '',
                'title' => '',
                'short_description' => '',
                'button_link' => '',
            ), $atts);

        $per_rows = $this->per_row;
        $image = $attributes['image'];
        $title = $attributes['title'];
        $short_description = $attributes['short_description'];

        $linkArr = vc_build_link($attributes['button_link']);
        $linkUrl = ((isset($linkArr['url']) && (!empty($linkArr['url']))) ? $linkArr['url'] : AXILWEB_JAVASCRIPTVOID);
        $linkTitle = ((isset($linkArr['title']) && (!empty($linkArr['title']))) ? $linkArr['title'] : "View Details");
        $linkAttr = '';
        if (isset($linkArr['target']) && !empty($linkArr['target'])) {
            $linkAttr = ' target="' . $linkArr['target'] . '"';
        }

        if (isset($linkArr['rel']) && !empty($linkArr['rel'])) {
            $linkAttr .= ' rel="' . $linkArr['rel'] . '"';
        }

        ob_start();
        ?>
        <div class="col-sm-6 <?php echo esc_attr($per_rows); ?>">
            <a href="<?php echo esc_attr($linkUrl) ?>" class="box-with-img" <?php echo esc_attr($linkAttr); ?>>
                <div class="img-container">
                    <?php echo wp_get_attachment_image($image, 'full', false, ['alt' => $title, 'class' => 'img-fluid']); ?>
                </div>
                <!-- End of .img-container -->
                <div class="text-content  text-left">
                    <h4><?php echo esc_html_cynicSEO_string($title); ?></h4>
                    <p><?php echo esc_html_cynicSEO_string($short_description); ?></p>
                    <div class="readmore-btn">
                        <div> <?php echo esc_html_cynicSEO_string($linkTitle); ?>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <!-- End of .readmore-btn -->
                </div>
                <!-- End of .text-content -->
            </a>
            <!-- End of .content -->
        </div>

        <?php
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_know_about_us_grids extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_know_about_us_grid extends WPBakeryShortCode
    {

    }


}
