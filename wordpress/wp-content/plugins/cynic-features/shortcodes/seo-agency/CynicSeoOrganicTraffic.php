<?php

class CynicSeoOrganicTraffic
{

    public function __construct()
    {
        add_shortcode('cynic_seo_organic_traffics', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_organic_traffic', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('SEO Organic Traffic', 'cynic'),
                'base' => 'cynic_seo_organic_traffics',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_organic_traffic'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
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
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Image Position', 'cynic'),
                        'value' => array(
                            __('Right', 'cynic') => '2',
                            __('Left', 'cynic') => '1',
                        ),
                        'admin_label' => true,
                        'param_name' => 'image_position',
                        'description' => __('Select Image Position.', 'cynic'),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);


            $args = array(
                'base' => 'cynic_seo_organic_traffic',
                'name' => __('Organic Traffic Bullet Item', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_organic_traffics'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
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
                'description' => '1',
                'button_link' => '',
                'image' => '',
                'image_position' => '2',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        $description = $attributes['description'];
        $button_link = vc_build_link($attributes['button_link']);
        $image = $attributes['image'];
        $image_position = $attributes['image_position'];

        $text_positionClass = ($image_position == 1) ? ' pl-lg-0 ml-auto order-lg-2' : '';
        $img_positionClass = ($image_position == 1) ? ' order-lg-1' : 'ml-auto pl-lg-0';
        $content = do_shortcode($content);
        ob_start();
        ?>

        <div class="content-block <?php echo esc_attr($extra_class) ?>">
            <div class="row align-items-center">
                <div class="col-lg-5 <?php echo esc_attr($text_positionClass); ?>">
                    <h3><?php echo esc_html_cynicSEO_string($title); ?></h3>
                    <p><?php echo esc_html_cynicSEO_string($description); ?></p>
                    <ul class="search-list-box">
                        <?php echo apply_filters('the_content', $content); ?>
                    </ul>
                    <!-- End of .search-list-box -->
                    <?php
                    echo cynicSEO_anchor_link_html($button_link);
                    ?>
                </div>
                <!-- End of col-ms-5 -->
                <div class="col-lg-6 img-container <?php echo esc_attr($img_positionClass); ?>">
                    <?php echo wp_get_attachment_image($image, 'full', false, []); ?>
                </div>
                <!-- End of .col-lg-7 -->
            </div>
            <!-- End of .row -->
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

    class WPBakeryShortCode_cynic_seo_organic_traffics extends WPBakeryShortCodesContainer
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

    class WPBakeryShortCode_cynic_seo_organic_traffic extends WPBakeryShortCode
    {

    }


}
