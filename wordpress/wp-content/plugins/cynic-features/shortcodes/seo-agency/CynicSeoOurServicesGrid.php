<?php

class CynicSeoOurServicesGrid
{

    protected $number_of_grids;

    public function __construct()
    {
        add_shortcode('cynic_seo_our_services', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_our_service', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Our Services Grid', 'cynic'),
                'base' => 'cynic_seo_our_services',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_our_service'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                        'div' => '',
                        'type' => 'dropdown',
                        'heading' => __('Number Of Grids', 'cynic'),
                        'param_name' => 'number_of_grids',
                        'description' => __('Display nunber of grids in section.', 'cynic'),
                        'value' => array(
                            __('2', 'cynic') => '2',
                            __('3', 'cynic') => '3',
                            __('4', 'cynic') => '4',
                        ),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_our_service',
                'name' => __('Service Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_our_services'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __('Title of the service', 'cynic'),
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => __('Short Description', 'cynic'),
                        'type' => 'textarea',
                        'param_name' => 'short_desc',
                        'value' => '',
                        'description' => __('Short Description of the service', 'cynic'),
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
                        "holder" => "",
                        "class" => "",
                        'heading' => 'On Click Link',
                        'type' => 'vc_link',
                        'param_name' => 'button_link',
                        'description' => __('Leave empty if you don\'t want to use it.', 'cynic'),
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
                'number_of_grids' => '3'
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $this->number_of_grids = $attributes['number_of_grids'];;
        $content = do_shortcode($content);
        ob_start(); ?>

        <div class="row no-gutters">
            <?php echo $content; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'title' => '',
                'icon_type' => '',
                'icon_fontawesome' => '',
                'icon_caviaricons' => '',
                'icon_image' => '',
                'short_desc' => '',
                'button_link' => '',
            ), $atts);

        $title = $attributes['title'];
        $icon_type = $attributes['icon_type'];
        $icon_fontawesome = $attributes['icon_fontawesome'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_image = $attributes['icon_image'];
        $description = $attributes['short_desc'];
        $linkArr = vc_build_link($attributes['button_link']);
        $linkUrl = (isset($linkArr['url']) && !empty($linkArr['url'])) ? esc_url($linkArr['url']) : AXILWEB_JAVASCRIPTVOID;
        $linkTarget = (isset($linkArr['target']) && !empty($linkArr['target'])) ? ' target='.$linkArr['target'] : '';
        $linkRel = (isset($linkArr['rel']) && !empty($linkArr['rel'])) ? ' rel='.$linkArr['rel'] : '';

        $gridNumber = $this->number_of_grids;

        $_class = "col-md-4";
        if ($gridNumber == "2") {
            $_class = "col-md-6";
        } elseif ($gridNumber == "4") {
            $_class = "col-md-3";
        }
        $icon_class = "grad-icon ";


        $grid_icon = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Files');
        $iconsHtml = '<i class=" ' . $icon_class . $grid_icon . '"  ></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $iconsHtml = wp_get_attachment_image($icon_image, 'full', true);
        }

        ob_start(); ?>
        <div class="<?php echo esc_attr($_class) ?>">
            <a href="<?php echo $linkUrl; ?>" class="content text-center" <?php echo esc_attr__($linkTarget, 'cynic'). esc_attr__($linkRel,'cynic');?>>
                <?php echo esc_html_cynicSEO_string($iconsHtml); ?>
                <h3><?php echo esc_html_cynicSEO_string($title) ?></h3>
                <p><?php echo esc_html_cynicSEO_string($description) ?></p>
            </a>
        </div>
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_seo_our_services extends WPBakeryShortCodesContainer
    {

    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_cynic_seo_our_service extends WPBakeryShortCode
    {

    }
}