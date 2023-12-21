<?php

class CynicSeoTopBannerWithForm
{
    public function __construct()
    {
        add_shortcode('cynic_seo_top_banner_with_form', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_top_banner_with_form',
                'name' => __('Top Banner with Form', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "is_container" => false,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
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
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Background Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'bg_image',
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                    ),
                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => 'Title',
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "p",
                        "class" => "",
                        'heading' => 'Short Description',
                        'type' => 'textarea',
                        'param_name' => 'short_description',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Read More Link',
                        'type' => 'vc_link',
                        'param_name' => 'readmore_link',
                        'value' => '',
                        'description' => __('Keep URL empty URL if you don\'t want', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Form',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Form Position', 'cynic'),
                        'value' => array(
                            __('Right', 'cynic') => '2',
                            __('Left', 'cynic') => '1',
                        ),
                        'admin_label' => true,
                        'param_name' => 'form_position',
                        'description' => __('Select Image Position.', 'cynic'),
                    ),

                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'extra_class' => '',
                'bg_image' => '',
                'title' => '',
                'short_description' => '',
                'readmore_link' => '',
                'form_shortcode' => '',
                'form_position' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $bg_image = $attributes['bg_image'];
        $bg_imgsrc = wp_get_attachment_url($bg_image, 'full');
        $bgattr = ' ';
        if (!empty($bg_imgsrc)) {
            $bgattr = 'data-bg=' . $bg_imgsrc;
        }

        $title = $attributes['title'];
        $short_description = $attributes['short_description'];
        $readMorelink = $attributes['readmore_link'];
        $readMorelink = vc_build_link($readMorelink);
        $form_position = $attributes['form_position'];
        $form_positionClass = ($form_position == 1) ? ' order-1' : '';
        ob_start();
        ?>
        <div class="ip-banner fullscreen-banner banner-with-form <?php echo esc_attr($extra_class) ?>" <?php echo esc_attr($bgattr); ?>>
            <div class="content d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-7 text-md-left text-center <?php echo esc_attr($form_positionClass); ?>">
                            <h1><?php echo esc_html_cynicSEO_string($title); ?></h1>
                            <p><?php echo esc_html_cynicSEO_string($short_description) ?></p>
                            <?php echo cynicSEO_anchor_link_html($readMorelink, 'primary-btn btn-white'); ?>
                        </div>
                        <div class="col-md-5">
                            <?php
                            echo apply_filters('the_content', $content);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .content -->
        </div>
        <?php
        return ob_get_clean();
    }
}
