<?php

class CynicSeoBusinessMission
{

    public function __construct()
    {
        add_shortcode('cynic_seo_business_missions', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_business_mission', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Business Mission', 'cynic'),
                'base' => 'cynic_seo_business_missions',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_business_mission'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                        "holder" => "h1",
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Description', 'cynic'),
                        'type' => 'textarea',
                        'param_name' => 'description',
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

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);


            $args = array(
                'base' => 'cynic_seo_business_mission',
                'name' => __('Business Mission List', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_business_missions'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "h4",
                        "class" => "",
                        'heading' => __('A Sentence', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'cynic_li',
                        'value' => '',
                        'description' => __('A sentence text .', 'cynic'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Caviar Icons', 'cynic') => 'caviaricons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Image Icon', 'cynic') => 'image_icon',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('List Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 400,
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('List Icon', 'cynic'),
                        'param_name' => 'icon_caviaricons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'caviaricons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'caviaricons',
                        ),
                        'value' => 'icon-users2',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),

                    array(
                        'type' => 'attach_image',
                        'heading' => __('List Icon', 'cynic'),
                        'param_name' => 'icon_image',
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'image_icon',
                        ),
                        'value' => '',
                        'description' => __('Select service icon from Image Library.', 'cynic'),
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
                'title' => '',
                'description' => '',
                'button_link' => '',
                'image' => '',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $description = $attributes['description'];
        $button_link = vc_build_link($attributes['button_link']);
        $image = $attributes['image'];
        $imgsrc = wp_get_attachment_url($image);

        $content = do_shortcode($content);
        ob_start();
        ?>
        <div class="cynic-feature-business-info <?php echo esc_attr($extra_class) ?>">
            <div class="gallery-container" data-bg="<?php echo esc_url($imgsrc) ?>">
                <?php echo wp_get_attachment_image($image, 'full', false, ['class' => 'img-fluid']); ?>
            </div>
            <div class="text-content section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 ml-auto text-left">
                            <div class="section-heading text-left">
                                <h2><?php echo esc_html_cynicSEO_string($title); ?></h2>
                            </div>
                            <p><?php echo apply_filters('the_content', $description); ?></p>
                            <ul class="mission-list-box">
                                <?php echo esc_html_cynicSEO_string($content); ?>
                            </ul>
                            <?php
                            echo cynicSEO_anchor_link_html($button_link);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'icon_type' => '',
                'icon_fontawesome' => '',
                'icon_caviaricons' => '',
                'icon_image' => '',
                'cynic_li' => '',
            ), $atts);

        $icon_type = $attributes['icon_type'];
        $icon_fontawesome = $attributes['icon_fontawesome'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_image = $attributes['icon_image'];
        $cynic_li = $attributes['cynic_li'];

        $List_icon = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Tick');
        $tabIconHtml = '<i class="' . $List_icon . '"></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $tabIconHtml = wp_get_attachment_image($icon_image, 'full', true);
        }
        ob_start();
        ?>
        <li><?php echo esc_html_cynicSEO_string($tabIconHtml) ?>
            <?php echo esc_html_cynicSEO_string($cynic_li); ?>
        </li>
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_business_missions extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_business_mission extends WPBakeryShortCode
    {

    }


}
