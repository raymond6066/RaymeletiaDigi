<?php

class CynicSeoTopBannerWithSlider
{

    public function __construct()
    {
        add_shortcode('cynic_seo_top_banners', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_top_banner', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Top Banner with Slider', 'cynic'),
                'base' => 'cynic_seo_top_banners',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_top_banner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,

                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => 'Banner Title',
                        'type' => 'textfield',
                        'param_name' => 'banner_title',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Banner Description',
                        'type' => 'textfield',
                        'param_name' => 'banner_description',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Banner Backgroupd', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'background_image',
                        'value' => '',
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
                "js_view" => 'VcColumnView'
            );
            vc_map($args);


            $args = array(
                'base' => 'cynic_seo_top_banner',
                'name' => __('Banner Slide Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_top_banners'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => 'Typed Text',
                        'type' => 'textfield',
                        'param_name' => 'typed_title',
                        'value' => '',
                    ),
                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    )
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
                'banner_title' => '',
                'banner_description' => '',
                'background_image' => '',
                'button_link' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $banner_title = $attributes['banner_title'];
        $banner_description = $attributes['banner_description'];
        $background_image = $attributes['background_image'];
        $button_link = [];
        if(!empty($attributes['button_link'])){
        $button_link = vc_build_link($attributes['button_link']);    
        }
        
        $content = do_shortcode($content);

        ob_start();
        ?>
        <!-- Start Slider Area -->
        <div class="row align-items-center <?php echo esc_attr($extra_class) ?>">
            <div class="banner-content col-lg-5 col-xl-6 text-lg-left text-center">
                <h1><?php echo esc_html_cynicSEO_string($banner_title); ?></h1>
                <p><?php echo esc_html_cynicSEO_string($banner_description); ?></p>
                <?php
                echo cynicSEO_anchor_link_html($button_link);
                ?>
            </div>
            <!-- End of .banner-content -->
            <div class="banner-slider banner-slider-cynicSEO-feature col-lg-7 col-xl-6">
                <?php echo wp_get_attachment_image($background_image, 'cynic-top-banner-browser'); ?>
                <div class="search-content">
                    <div class="search-box-container">
                        <div class="search-box">
                            <span class="typed"></span>
                        </div>
                        <!-- End of .search-box -->
                    </div>
                    <!-- End of .search-box-container -->
                    <div class="search-slider">
                        <p><?php echo apply_filters('the_content', $content); ?></p>
                    </div>
                    <!-- End of .search-slider -->
                </div>

                <!-- End of .search-content -->
            </div>
            <!-- End of .banner-slider -->
        </div>
        <!-- End Slider Area -->
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'typed_title' => '',
                'image' => ''
            ), $atts);
        $typed_title = $attributes['typed_title'];
        $image = $attributes['image'];
        $imgsrc = (!empty($image)) ? wp_get_attachment_url((int)$image, 'cynic-top-banner-img') : '';
        ob_start();
        ?>
        <img src="<?php echo esc_url($imgsrc); ?>" alt="<?php echo esc_attr($typed_title) ?>"
             class="img-fluid hide-img">
        <?php
        return ob_get_clean();
    }
}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_top_banners extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_top_banner extends WPBakeryShortCode
    {

    }


}
