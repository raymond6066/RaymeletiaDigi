<?php

class CynicSeoFormWithText
{

    public function __construct()
    {
        add_shortcode('cynic_seo_form_with_text_sections', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_form_with_text_section', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Form with Text', 'cynic'),
                'base' => 'cynic_seo_form_with_text_sections',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_form_with_text_section'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "h1",
                        "class" => "cynic_vc_parent_padding",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'admin_label' => true,
                        'value' => '',
                    ),

                    array(
                        "holder" => "p",
                        "class" => "cynic_vc_parent_padding",
                        'heading' => __('Sub Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'sub_title',
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        'heading' => __('Description', 'cynic'),
                        'type' => 'textarea',
                        'param_name' => 'description',
                    ),

                    array(
                        "holder" => "",
                        'heading' => __('Form HTML', 'cynic'),
                        'type' => 'textarea_raw_html',
                        'param_name' => 'form_html',
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
                "js_view" => 'VcColumnView'
            );
            vc_map($args);


            $args = array(
                'base' => 'cynic_seo_form_with_text_section',
                'name' => __('Text Bullet Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_form_with_text_sections'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "h2",
                        "class" => "",
                        'heading' => __('Bullet Text', 'cynic'),
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
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Bullet Icon', 'cynic'),
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
                        'heading' => __('Bullet Icon', 'cynic'),
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
                        'heading' => __('Bullet Icon', 'cynic'),
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
                'sub_title' => '',
                'description' => '1',
                'form_html' => '',
                'form_position' => '2',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $sub_title = $attributes['sub_title'];
        $description = $attributes['description'];
        $form = rawurldecode(base64_decode(strip_tags($attributes['form_html'])));
        $form_position = $attributes['form_position'];

        $text_positionClass = ($form_position == 1) ? ' order-lg-2' : '';
        $form_positionClass = ($form_position == 1) ? ' order-lg-1' : '';
        $content = do_shortcode($content);
        ob_start();
        ?>
        <div class="row align-items-center <?php echo esc_attr($extra_class) ?>">
            <div class="col-md-7 <?php echo esc_attr($text_positionClass) ?>">
                <div class="section-heading text-left">
                    <?php
                    if (!empty($title)) {
                        echo esc_html_cynicSEO_string('<h2>' . $title . '</h2>');
                    }
                    if (!empty($sub_title)) {
                        echo esc_html_cynicSEO_string('<p>' . $sub_title . '</p>');
                    }
                    ?>
                </div>
                <p><?php echo esc_html_cynicSEO_string($description); ?></p>
                <?php
                if (!empty($content)) {
                    ?>
                    <ul class="search-list-box">
                        <?php echo apply_filters('the_content', $content); ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-5 <?php echo esc_attr($form_positionClass) ?>">
                <?php echo apply_filters('the_content', $form); ?>
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


        $iconclass = (!empty($icon_caviaricons)) ? $icon_caviaricons : ((!empty($icon_fontawesome)) ? $icon_fontawesome : 'icon-Tick');
        $iconsHtml = '<i class="grad-icon ' . $iconclass . '"></i>';
        if ($icon_type == 'image_icon' && !empty($icon_image)) {
            $iconsHtml = wp_get_attachment_image($icon_image, 'full', true);
        }

        ob_start();
        ?>
        <li><?php echo esc_html_cynicSEO_string($iconsHtml); ?><?php echo esc_html_cynicSEO_string($cynic_li); ?>
        </li>
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_form_with_text_sections extends WPBakeryShortCodesContainer
    {

        public function contentAdmin( $atts, $content = null ) {
            $width = '';

            $atts = shortcode_atts( $this->predefined_atts, $atts );
            extract( $atts );
            $this->atts = $atts;
            $output = '';

            $output .= '<div ' . $this->mainHtmlBlockParams( $width, 1 ) . '>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( $this->settings( 'controls' ) );
            }
            $output .= '<div class="wpb_element_wrapper">';

            if ( isset( $this->settings['custom_markup'] ) && '' !== $this->settings['custom_markup'] ) {
                $markup = $this->settings['custom_markup'];
                $output .= $this->customMarkup( $markup );
            } else {
                $output .= $this->outputTitle( $this->settings['name'] );
                $output .= $this->paramsHtmlHolders( $atts );
                $output .= '<div ' . $this->containerHtmlBlockParams( $width, 1 ) . '>';
                $output .= do_shortcode( shortcode_unautop( $content ) );
                $output .= '</div>';
            }

            $output .= '</div>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( 'add', 'bottom-controls' );

            }
            $output .= '</div>';

            return $output;
        }

    }


}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_form_with_text_section extends WPBakeryShortCode
    {

    }


}
