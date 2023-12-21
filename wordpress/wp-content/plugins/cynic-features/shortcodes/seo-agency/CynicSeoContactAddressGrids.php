<?php

class CynicSeoContactAddressGrids
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_contact_address_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_contact_address_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Contact Address', 'cynic'),
                'base' => 'cynic_seo_contact_address_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_contact_address_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                        'value' => array(1, 2, 3, 4),
                        'admin_label' => true,
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_contact_address_grid',
                'name' => __('Contact Item', 'cynic'),
                "category" => __("Cynic", "cynic"),
                "as_child" => array('only' => 'cynic_seo_contact_address_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Contact Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'contact',
                        'value' => '',
                        'description' => __('Contact text.', 'cynic'),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Contact Type', 'cynic'),
                        'param_name' => 'contact_type',
                        'description' => __('Select Contact Type', 'cynic'),
                        'value' => array(
                            __('Select Contact Type', 'cynic') => 'default',
                            __('Default', 'cynic') => 'default',
                            __('Phone Number', 'cynic') => 'tel',
                            __('Email Address', 'cynic') => 'mailto',
                            __('Website URL', 'cynic') => 'url',
                        ),
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Short Description', 'cynic'),
                        'type' => 'textarea',
                        'param_name' => 'short_desc',
                        'value' => '',
                        'description' => __('Short Descrition of an adddress.', 'cynic'),
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
                        'value' => 'icon-Phone',
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
                'per_row' => '3',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];
        $rows = 'col-md-4';
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
        <div class="contact-info <?php echo esc_attr($extra_class); ?>">
            <div class="row">
                <?php echo apply_filters('the_content', $content); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'contact' => '',
                'contact_type' => 'default',
                'short_desc' => '',
                'icon_type' => 'caviaricons',
                'icon_fontawesome' => 'fa fa-star-o',
                'icon_caviaricons' => 'icon-Phone',
                'icon_image' => '',
                'button_link' => '',
            ), $atts);

        $per_rows = $this->per_row;
        $contact = $attributes['contact'];
        $contact_type = $attributes['contact_type'];
        $icon_image = $attributes['icon_image'];

        $contactHtml = '<h3><a href="'.AXILWEB_JAVASCRIPTVOID.'">' . $contact . '</a></h3>';
        if ($contact_type == 'tel') {
            $contactHtml = '<a href="tel:' . preg_replace('/\s+/', '', $contact) . '">' . $contact . '</a>';
        } elseif ($contact_type == 'mailto') {
            $contactHtml = '<a href="mailto:' . preg_replace('/\s+/', '', $contact) . '">' . $contact . '</a>';
        } elseif ($contact_type == 'url') {
            $contactHtml = '<a target="_blank" href="' . esc_url($contact) . '">' . $contact . '</a>';
        }

        $short_desc = $attributes['short_desc'];
        $icon_type = $attributes['icon_type'];
        $icon_caviaricons = $attributes['icon_caviaricons'];
        $icon_fontawesome = $attributes['icon_fontawesome'];

        $box_icon = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Mail');
        $boxIconHtml = '<i class="grad-icon ' . $box_icon . '"></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $boxIconHtml = wp_get_attachment_image($icon_image, 'full', true);
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
        if (!empty($contact)):
            echo esc_html_cynicSEO_string($startLink);
            ?>
        <div class="<?php echo esc_html_cynicSEO_string($per_rows); ?>">
            <div class="content text-center">
                <div class="icon-container">
                    <?php echo esc_html_cynicSEO_string($boxIconHtml); ?>
                </div>
                <h3>
                    <?php echo esc_html_cynicSEO_string($contactHtml); ?>
                </h3>
                <p><?php echo esc_html_cynicSEO_string($short_desc); ?></p>
            </div>
            </div><?php
            if (!empty($startLink)) {
                echo esc_html_cynicSEO_string('</a>');
            }
            ?>
            <?php
        endif;
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_contact_address_grids extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_contact_address_grid extends WPBakeryShortCode
    {

    }


}
