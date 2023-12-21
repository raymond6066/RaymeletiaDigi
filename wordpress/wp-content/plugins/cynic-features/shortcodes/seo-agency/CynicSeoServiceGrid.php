<?php

class CynicSeoServiceGrid
{
    public function __construct()
    {
        add_shortcode('cynic_seo_services', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_service', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Services', 'cynic'),
                'base' => 'cynic_seo_services',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_service'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
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
                        'heading' => __('Layout', 'cynic'),
                        'admin_label' => true,
                        'param_name' => 'design_layout',
                        'description' => __('Select Design Layout.', 'cynic'),
                        'value' => array(
                            __('SEO Layout', 'cynic') => '1',
                            __('SMM Layout', 'cynic') => '2',
                        ),
                    ),

                    array(
                        'div' => '',
                        'type' => 'dropdown',
                        'heading' => __('Number Of Grids', 'cynic'),
                        'param_name' => 'number_of_grids',
                        'description' => __('Display nunber of grids in section.', 'cynic'),
                        'value' => array(
                            __('2', 'cynic') => '2',
                            __('3', 'cynic') => '3',
                        ),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_service',
                'name' => __('Service Grid', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_services'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => __('Icon Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'icon_title',
                        'value' => '',
                        'description' => __('Icon text.', 'cynic'),
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
                        'heading' => __('Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
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
                        'heading' => __('Icon', 'cynic'),
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
                        'heading' => __('Icon', 'cynic'),
                        'param_name' => 'icon_image',
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'image_icon',
                        ),
                        'value' => '',
                        'description' => __('Select service icon from Image Library.', 'cynic'),
                    ),

                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __("Icon color", "cynic"),
                        "param_name" => "icon_color",
                        "value" => "#5c81fa",
                        "description" => __("Choose color for icon", "cynic")
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Description', 'cynic'),
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = array())
    {
        $atts = shortcode_atts(
            array(
                'extra_class' => '',
                'design_layout' => '1',
                'number_of_grids' => '2'
            ), $atts);
        extract($atts);
        global $layout;
        global $gridNumber;
        $layout = $design_layout;
        $gridNumber = $number_of_grids;
        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="container <?php echo esc_attr($extra_class); ?>">
            <div class="service-content <?php if (isset($layout) && $layout == '2') {
                echo esc_attr('type-2');
            } ?>">
                <div class="row">
                    <?php echo $content; ?>
                </div>
                <!-- End of .row -->
            </div>
        </div>
        <!-- End of .service-content -->
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'icon_title' => '',
                'icon_type' => '',
                'icon_fontawesome' => '',
                'icon_caviaricons' => '',
                'icon_image' => '',
                'icon_color' => '#5c81fa',
                'description' => '',
            ), $atts);
        extract($atts);
        $icon_title = $atts['icon_title'];
        $icon_type = $atts['icon_type'];
        $icon_fontawesome = $atts['icon_fontawesome'];
        $icon_caviaricons = $atts['icon_caviaricons'];
        $icon_image = $atts['icon_image'];
        $icon_color = $atts['icon_color'];
        $description = $atts['description'];

        global $layout;
        global $gridNumber;

        $_class = "col-md-6";
        if ($gridNumber == "3") {
            $_class = "col-md-4";
        }
        $icon_class = "grad-icon ";
        $icon_color = (!empty($icon_color)) ? $icon_color : "#5c81fa";
        $data_bg_color = 'data-bgcolor=' . $icon_color . '';
        $data_color = "";
        if ($icon_color != "#5c81fa") {
            $icon_class = "";
            $data_color = ' style=color:' . $icon_color . '';
        }

        $grid_icon = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Files');
        $iconsHtml = '<i class=" ' .$icon_class. $grid_icon . '"  '.$data_color.'></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $iconsHtml = wp_get_attachment_image($icon_image, 'full', true);
        }

        ob_start(); ?>
        <div class="<?php echo esc_attr($_class); ?>">
            <div class="content">
                <?php if (isset($layout) && $layout == 1) { ?>
                    <?php echo esc_html_cynicSEO_string($iconsHtml); ?>
                    <h4><?php echo esc_html($icon_title); ?></h4>
                    <p><?php echo apply_filters('the_content', $content); ?></p>
                <?php } else { ?>
                    <h3>
                        <div class="img-container" <?php echo esc_attr($data_bg_color); ?>>
                            <i class="<?php echo esc_attr($grid_icon); ?>"></i>
                        </div>
                        <!-- End of .img-container -->
                        <?php echo esc_html($icon_title); ?>
                    </h3>
                    <p><?php echo apply_filters('the_content', $content); ?></p>
                    </h3>
                <?php } ?>
            </div>
            <!-- End of .content -->
        </div>
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_seo_services extends WPBakeryShortCodesContainer
    {

    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_cynic_seo_service extends WPBakeryShortCode
    {

    }
}