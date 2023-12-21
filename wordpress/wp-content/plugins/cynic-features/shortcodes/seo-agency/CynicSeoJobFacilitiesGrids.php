<?php

class CynicSeoJobFacilitiesGrids
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_job_facilities_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_job_facilities_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Job Facilities', 'cynic'),
                'base' => 'cynic_seo_job_facilities_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_job_facilities_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                'base' => 'cynic_seo_job_facilities_grid',
                'name' => __('Facility Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_job_facilities_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

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
                        'type' => 'dropdown',
                        'heading' => __('Icon library for list', 'cynic'),
                        'value' => array(
                            __('Caviar Icons', 'cynic') => 'caviaricons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Image Icon', 'cynic') => 'image_icon',
                        ),
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('List Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-star-o',
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
                        'value' => 'icon-Umbrella',
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

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Button Link',
                        'type' => 'vc_link',
                        'param_name' => 'button_link',
                        'value' => '',
                        'description' => __('Keep empty if you don\'t want to use.', 'cynic'),
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
        $rows = 'col-md-3';
        if ($per_row == 1) {
            $rows = 'col-md-12';
        } elseif ($per_row == 2) {
            $rows = 'col-md-6';
        } elseif ($per_row == 3) {
            $rows = 'col-md-4';
        } elseif ($per_row == 4) {
            $rows = 'col-md-3';
        }

        $this->per_row = $rows;


        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="facilities-container <?php echo esc_attr($extra_class); ?>">
            <div class="row">
                <?php
                echo esc_html_cynicSEO_string($content);
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'title' => '',
                'icon_type' => 'caviaricons',
                'icon_caviaricons' => 'icon-Umbrella',
                'icon_fontawesome' => 'fa fa-star-o',
                'icon_image' => '',
                'button_link' => '',
            ), $atts);

        $per_rows = $this->per_row;
        $title = $attributes['title'];
        $icon_type = $attributes['icon_type'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_fontawesome = $attributes['icon_fontawesome'];
        $icon_image = $attributes['icon_image'];


        $iconclass = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'fa-adjust');
        $iconsHtml = '<i class="grad-icon ' . $iconclass . '"></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $iconsHtml = wp_get_attachment_image($icon_image, 'full', true);
        }

        $linkArr = vc_build_link($attributes['button_link']);
        $linkUrl = ((isset($linkArr['url']) && (!empty($linkArr['url']))) ? $linkArr['url'] : "");

        $linkAttr = '';
        if (isset($linkArr['target']) && !empty($linkArr['target'])) {
            $linkAttr = ' target="' . $linkArr['target'] . '"';
        }

        if (isset($linkArr['rel']) && !empty($linkArr['rel'])) {
            $linkAttr .= ' rel="' . $linkArr['rel'] . '"';
        }

        $startLink = '';
        if (!empty($linkUrl)) {
            $startLink = '<a href="' . $linkUrl . '" ' . $linkAttr . '>';
        }

        ob_start();
        if (!empty($title)):
            ?>
            <div class="<?php echo esc_attr($per_rows) ?>">
                <?php echo esc_html_cynicSEO_string($startLink); ?>
                <div class="content text-center">
                    <?php echo esc_html_cynicSEO_string($iconsHtml); ?>
                    <p><?php echo esc_html_cynicSEO_string($title); ?></p>
                </div>
                <?php
                if (!empty($startLink)) {
                    echo esc_html_cynicSEO_string('</a>');
                }
                ?>
            </div>
            <?php
        endif;
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_job_facilities_grids extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_job_facilities_grid extends WPBakeryShortCode
    {

    }


}
