<?php

class CynicSeoGoogleMapTab
{

    protected $tabnavs = '', $tabcount = 0;
    protected $newAddress;

    public function __construct()
    {
        add_shortcode('cynic_seo_google_map_tabs', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_google_map_tab', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'base' => 'cynic_seo_google_map_tabs',
                'name' => __('Google Map Tab', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_parent" => array('only' => 'cynic_seo_google_map_tab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => FALSE,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
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
                        "holder" => "h2",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_google_map_tab',
                'name' => __('Google Map Tab', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                "as_child" => array('only' => 'cynic_seo_google_map_tabs'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "show_settings_on_create" => true,
                'params' => array(
                    array(
                        "holder" => "p",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Tab Title', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'param_name' => 'address',
                        'type' => 'textfield',
                        'heading' => __('Address', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Image Icons', 'cynic') => 'image_icons',
                            __('Linear Icons', 'cynic') => 'caviaricons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Image Icons', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image_icons',
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'image_icons',
                        ),
                        'value' => '',
                        'description' => __('Select images from media library.', 'cynic'),
                        'admin_label' => true,
                    ),


                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
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
                        'value' => 'icon-World',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-globe',
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
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Map Content',
                        'type' => 'textarea',
                        'param_name' => 'content',
                        'value' => '',
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
                'title' => '',
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $title = $attributes['title'];
        ob_start();
        $content = do_shortcode($content);
        ?>
        <div class="container-fluid p-0 cynicSEO-google-map-section">
            <div class="section-heading text-center">
                <?php if (!empty($title)) { ?>
                    <h2><?php echo esc_html_cynicSEO_string($title); ?></h2>
                <?php } ?>
                <p class="addressbox"><?php echo esc_html_cynicSEO_string($this->newAddress); ?></p>
            </div>
            <div class="map-tab-wrapper <?php echo esc_attr($extra_class); ?>">
                <div class="tab-container type-1">
                    <ul class="nav nav-tabs row no-gutters mx-auto" role="tablist">
                        <?php echo esc_html_cynicSEO_string($this->tabnavs) ?>
                    </ul>
                </div>
                <div class="tab-content" id="projects-tab-content">
                    <?php echo apply_filters('the_content', $content); ?>
                </div>
            </div>
        </div>
        <!-- End Tabs Area -->
        <?php
        $this->tabcount = 0;
        $this->tabnavs = '';
        $this->newAddress='';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'title' => '',
                'address' => '',
                'icon_type' => '',
                'image_icons' => '',
                'icon_caviaricons' => 'icon-World',
                'icon_fontawesome' => 'fa fa-globe',
            ), $atts);

        $title = $attributes['title'];
        $address = $attributes['address'];
        $icon_type = $attributes['icon_type'];
        $image = (int)$attributes['image_icons'];
        $icon_linearicons = $attributes['icon_caviaricons'];
        $icon_fontawesome = $attributes['icon_fontawesome'];


        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = $icon_fontawesome;
        } else {
            $iconclass = $icon_linearicons;
        }

        $iconsHtml = '<i class="grad-icon icon-World"></i>';

        if (!empty($image)) {
            $iconsHtml = wp_get_attachment_image($image, 'full', false, ['alt' => 'map icon', 'class' => '']);
        } elseif ($icon_type == 'caviaricons' || $icon_type == 'fontawesome') {
            $iconsHtml = '<i class="grad-icon ' . $iconclass . '"></i>';
        }

        $tabactivecls = '';
        $tabbtnactiveclass = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'show active';
            $tabbtnactiveclass = ' active';
            $this->newAddress = $address;
        }
        $tabid = 'maptab-' . uniqid(rand(000000, 999999));
        ob_start();
        ?>
        <li class="nav-item col">
            <a data-address="<?php echo esc_html($address); ?>"
               class="nav-link <?php echo esc_attr($tabbtnactiveclass); ?>" data-toggle="tab"
               href="#<?php echo $tabid ?>" role="tab"
               aria-controls="<?php echo esc_attr($tabid) ?>"
               aria-selected="true">
                <?php echo esc_html_cynicSEO_string($iconsHtml); ?>
                <span><?php echo esc_html($title) ?></span>
            </a>
        </li>

        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start();
        ?>
        <div class="tab-pane fade <?php echo $tabactivecls ?>" id="<?php echo $tabid ?>" role="tabpanel"
             aria-labelledby="<?php echo $tabid ?>">
            <?php echo apply_filters('the_content', $content) ?>
        </div>

        <?php
        $this->tabcount++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_google_map_tabs extends WPBakeryShortCodesContainer
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

    class WPBakeryShortCode_cynic_seo_google_map_tab extends WPBakeryShortCode
    {

    }

}
