<?php

class CynicSeoComponentTabs
{

    protected $tabnavs = '', $tabcount = 0;

    public function __construct()
    {
        add_shortcode('cynic_seo_components', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_component', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'name' => __('Component Tab', 'cynic'),
                'base' => 'cynic_seo_components',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_component'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(

                    array(
                        'div' => '',
                        'admin_label' => false,
                        'type' => 'attach_image',
                        'heading' => __('Top Background', 'cynic'),
                        'param_name' => 'bg_image',
                        'description' => __('Add Background Image For Top Background.', 'cynic'),
                    ),

                    array(
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'tab_heading_title',
                        'admin_label' => true,
                        'type' => 'textfield',
                        'heading' => __('Tab Heading Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'tab_heading_description',
                        'type' => 'textarea',
                        'heading' => __('Tab Heading Description', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Text Alignment', 'cynic'),
                        'value' => array(
                            __('Center', 'cynic') => '0',
                            __('Left', 'cynic') => '1',
                            __('Right', 'cynic') => '2',
                        ),
                        'admin_label' => false,
                        'param_name' => 'text_alignment',
                        'description' => __('Select text alignment.', 'cynic'),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_component',
                'name' => __('SEO Component Content', 'cynic'),
                "category" => __("Cynic Component", "cynic"),
                "as_child" => array('only' => 'cynic_seo_components'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(

                    array(
                        'div' => '',
                        'admin_label' => true,
                        'type' => 'textfield',
                        'heading' => __('Tab Title', 'cynic'),
                        'param_name' => 'tab_title',
                        'description' => __('Display tab title.', 'cynic'),
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => __('Tab Image', 'cynic'),
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __('Select Tab content image.', 'cynic'),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Tab Image Position', 'cynic'),
                        'value' => array(
                            __('Right', 'cynic') => '2',
                            __('Left', 'cynic') => '1',
                        ),
                        'admin_label' => true,
                        'param_name' => 'image_position',
                        'description' => __('Select Image Position.', 'cynic'),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Tab Items', 'cynic'),
                        'param_name' => 'tab_items',
                        'params' => array(
                            array(
                                'type' => 'dropdown',
                                'heading' => __('Icon library', 'cynic'),
                                'value' => array(
                                    __('Caviar Icons', 'cynic') => 'caviaricons',
                                    __('Font Awesome', 'cynic') => 'fontawesome',
                                    __('Image Icon', 'cynic') => 'image_icon',
                                ),
                                // 'admin_label' => false,
                                'param_name' => 'icon_type',
                                'description' => __('Select icon library.', 'cynic'),
                            ),
                            array(
                                'type' => 'iconpicker',
                                'heading' => __('Tab Icon', 'cynic'),
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
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Content Title', 'cynic'),
                                'type' => 'textfield',
                                'admin_label' => true,
                                'param_name' => 'content_title',
                                'value' => '',
                                'description' => __('Tab content title.', 'cynic'),
                            ),

                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Short Description', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'short_content',
                                'description' => __('Tab inner content description.', 'cynic'),
                            ),
                        )
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = array())
    {
        $atts = shortcode_atts(
            array(
                'bg_image' => '',
                'tab_heading_title' => '',
                'tab_heading_description' => '',
                'text_alignment' => ''
            ), $atts);
        extract($atts);
        $bg_image = $atts['bg_image'];
        $tab_heading_title = $atts['tab_heading_title'];
        $tab_heading_description = $atts['tab_heading_description'];
        $text_alignment = $atts['text_alignment'];

        $content = do_shortcode($content);
        $imageurl = wp_get_attachment_url($bg_image);
        ob_start();
        if ($tab_heading_title) {

            switch ($text_alignment) {
                case '1':
                    $alignclass = 'text-left';
                    break;
                case '2':
                    $alignclass = 'text-right';
                    break;
                default:
                    $alignclass = 'text-center';
                    break;
            } ?>

            <div class="head-with-bg" data-bg="<?php echo esc_attr($imageurl); ?>">
                <div class="overlay">
                    <div class="container">
                        <div class="section-heading <?php echo esc_attr($alignclass); ?>">
                            <h2><?php echo html_entity_decode(esc_html($tab_heading_title)); ?></h2>
                            <p><?php echo html_entity_decode(esc_html($tab_heading_description)); ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="tab-container type-1">
            <div class="container">
                <ul class="nav nav-tabs row no-gutters" id="components" role="tablist">
                    <?php echo $this->tabnavs; ?>
                </ul>
                <div class="tab-content" id="components-tab-content">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <?php
        $this->tabcount = 0;
        $this->tabnavs = '';
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $attributes = shortcode_atts(
            array(
                'tab_title' => '',
                'image' => '',
                'image_position' => '2',
                'tab_items' => ''
            ), $atts);
        extract($atts);

        $tab_title = $attributes['tab_title'];
        $image = $attributes['image'];
        $image_position = $attributes['image_position'];
        $tab_items = $attributes['tab_items'];
        $tab_items = vc_param_group_parse_atts($tab_items);
        $tabactivecls = '';
        $tabNavActiveCls = '';
        if ($this->tabcount == 0) {
            $tabactivecls = 'show active current';
            $tabNavActiveCls = 'active';
        }
        $tabid = uniqid(rand(000000, 999999));

        ob_start(); ?>

        <li class="nav-item col">
            <a class="nav-link <?php echo esc_attr($tabNavActiveCls); ?>"
               id="components-tab-<?php echo esc_attr($tabid); ?>" data-toggle="tab"
               href="#components-content-<?php echo esc_attr($tabid); ?>" role="tab"
               aria-controls="components-content-<?php echo esc_attr($tabid); ?>"
               aria-selected="true">
                <span><?php echo esc_html($tab_title); ?></span>
            </a>
        </li>
        <?php
        $this->tabnavs .= ob_get_clean();
        ob_start();
        $tab_text_position = "order-md-1";
        $tab_img_position = "order-md-2";
        if (isset($image_position) && $image_position == 1) {
            $tab_text_position = "order-md-2";
            $tab_img_position = "order-md-1";
        } ?>
        <div class="tab-pane fade <?php echo esc_attr($tabactivecls); ?>"
             id="components-content-<?php echo esc_attr($tabid) ?>" role="tabpanel"
             aria-labelledby="components-content-<?php echo esc_attr($tabid); ?>">
            <div class="row">
                <div class="col-md text-left <?php echo esc_attr($tab_text_position); ?>">

                    <div class="text-content">
                        <?php
                        if (isset($tab_items) && count($tab_items) > 0) {
                            foreach ($tab_items as $item) {
                                $_icon_type = $item['icon_type'];
                                $_icon_fontawesome = $item['icon_fontawesome'];
                                $_icon_caviaricons = $item['icon_caviaricons'];
                                $icon_image = (isset($item['icon_image'])) ? $item['icon_image'] : '';
                                $_content_title = $item['content_title'];
                                $_short_content = $item['short_content'];

                                $List_icon = (!empty($_icon_caviaricons)) ? $_icon_caviaricons : ((!empty($_icon_fontawesome)) ? $_icon_fontawesome : 'icon-News');
                                $List_iconHtml = '<i class="grad-icon ' . $List_icon . '"></i>';
                                if ($_icon_type == 'image_icon' && !empty($icon_image)) {
                                    $List_iconHtml = wp_get_attachment_image($icon_image, 'full', true);
                                }
                                ?>
                                <div class="content">
                                    <?php echo esc_html_cynicSEO_string($List_iconHtml); ?>
                                    <h4><?php echo html_entity_decode($_content_title); ?></h4>
                                    <p><?php echo html_entity_decode(nl2br($_short_content)); ?></p>
                                </div>
                            <?php }
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md <?php echo esc_attr($tab_img_position); ?>">
                    <?php if (isset($image) && !empty($image)) { ?>
                        <div class="svg-container text-center">
                            <?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid')); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        $this->tabcount++;
        return ob_get_clean();
    }
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_seo_components extends WPBakeryShortCodesContainer
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
    class WPBakeryShortCode_cynic_seo_component extends WPBakeryShortCode
    {

    }
}