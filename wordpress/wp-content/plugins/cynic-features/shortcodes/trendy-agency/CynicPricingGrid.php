<?php

class CynicPricingGrid
{
    protected $block_count = 1;

    public function __construct()
    {
        add_shortcode('cynic_pricing_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_pricing_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();

            $args = array(
                'name' => __('Pricing Grid', 'cynic'),
                'base' => 'cynic_pricing_grids',
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_pricing_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'extra_class',
                        'type' => 'textfield',
                        'heading' => __('Extra Classes', 'cynic'),
                        'value' => '',
                    ),

                    array(
                        "holder" => "h2",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'block_heading',
                        'type' => 'textfield',
                        'heading' => __('Block Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "h2",
                        "class" => "cynic_vc_parent_padding",
                        'param_name' => 'block_sub_heading',
                        'type' => 'textfield',
                        'heading' => __('Block Sub Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(

                'base' => 'cynic_pricing_grid',
                'name' => __('Pricing Items', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                "as_child" => array('only' => 'cynic_pricing_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',

                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Select Layout', 'cynic'),
                        'value' => array(
                            __('Onepage Layout', 'cynic') => '1',
                            __('Multipage Layout', 'cynic') => '2',
                        ),
                        'admin_label' => true,
                        'param_name' => 'layouts',
                        'description' => __('Select layouts for different agencies.', 'cynic'),
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => __('Select Colors', 'cynic'),
                        'value' => array(
                            __('Primary Color', 'cynic') => 'grad-style-cd-light',
                            __('Secondary Color', 'cynic') => 'grad-style-ab-light',
                            __('Tertiary Color', 'cynic') => 'grad-style-ef-light',
                        ),
                        'admin_label' => true,
                        'param_name' => 'colors',
                        'description' => __('Select colors for different blocks.', 'cynic'),
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'block_title',
                        'type' => 'textarea',
                        'heading' => __('Pricing Block Title', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'pricing',
                        'type' => 'textarea',
                        'heading' => __('Pricing', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Pricing Features', 'cynic'),
                        'param_name' => 'features',
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Features', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'featured_title',
                                'description' => __('Featured counter title.', 'cynic'),
                                'admin_label' => true,
                            )
                        )
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bookmark Button text',
                        'type' => 'textfield',
                        'param_name' => 'bookmark_button_text',
                        'value' => '',
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '1',
                        ),
                        'description' => __('Button link details', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => 'Bookmark Button Link',
                        'type' => 'textfield',
                        'param_name' => 'bookmark_button_link',
                        'value' => '',
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '1',
                        ),
                        'description' => __('Button link details', 'cynic'),
                    ),

                    array(
                        'heading' => 'Button Text',
                        'type' => 'textfield',
                        'param_name' => 'button_text',
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '2',
                        )
                    ),

                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                        ),
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '2',
                        )
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Internal Link',
                        'type' => 'dropdown',
                        'param_name' => 'internal_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '1',
                        ),
                        'value' => $pagearr,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'External Link',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => '2',
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
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
                'extra_class' => '',
                'block_heading' => '',
                'block_sub_heading' => ''
            ), $atts);
        extract($atts);
        $content = do_shortcode($content);
        $align_class = $extra_class;
        ob_start(); ?>

        <div class="container">
            <h2 class="<?php echo esc_attr($align_class); ?>"><?php echo esc_html($block_heading) ?></h2>
            <p class="section-subheading<?php echo " " . esc_attr($align_class); ?>">
                <?php echo html_entity_decode(cynic_nl2br($block_sub_heading)); ?>
            </p>
            <div class="row pricing-wrapper">
                <?php echo $content; ?>
            </div>
        </div>
        <?php
        $this->block_count = 1;
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'layouts' => '1',
                'colors' => 'grad-style-cd-light',
                'block_title' => '',
                'pricing' => '',
                'features' => '',
                'bookmark_button_text' => '',
                'bookmark_button_link' => '',
                'bookmark_link' => '',
                'button_text' => 'KICKSTART YOUR BUSINESS',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0'
            ), $atts);
        extract($atts);
        ob_start();

        $default_classes = "custom-btn btn-big grad-style-ef";
        if ($layouts && $layouts == 1) {
            $linkArr['url'] = $bookmark_button_link;
            $linkArr['title'] = $bookmark_button_text;
            $linkArr['rel'] = '';
            $linkArr['target'] = '';
            $default_classes .= " page-scroll";
        } else {
            $linkArr = cynic_get_links($button_link, $internal_link, $external_link);
        }
        $group_features = vc_param_group_parse_atts($features);
        $countFeatures = count($group_features);
        $icon_class = "";
        if ($colors == "grad-style-ab-light") {
            $icon_class = "txt-grad-ab";
        } else if ($colors == "grad-style-ef-light") {
            $icon_class = "txt-grad-ef";
        } else if ($colors == "grad-style-cd-light") {
            $icon_class = "txt-grad-cd";
        } ?>
        <div class="col-lg-4 col-md-6">
            <!-- Start of .pricing-block -->
            <div class="pricing-block text-center content-block">
                <span class="icon-container <?php echo esc_attr($colors) ?>">
                    <i class="<?php echo esc_attr($icon_class) ?>"><?php echo "0" . esc_html($this->block_count) ?></i>
                </span>
                <h6><?php echo html_entity_decode(cynic_nl2br($block_title)); ?></h6>
                <div class="price txt-grad-ef"><?php echo esc_html($pricing); ?></div>
                <?php if ($countFeatures > 0) { ?>
                    <div class="facilities">
                        <?php foreach ($group_features as $feature) { ?>
                            <div><?php echo html_entity_decode(nl2br($feature['featured_title'])); ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <!-- End of .facilities -->
                <?php
                if ($layouts && $layouts == 1) {
                    echo cynic_trendy_anchor_link_html($linkArr, '' . $default_classes . '');
                } else {
                    if (!empty($linkArr)) { ?>
                        <a href="<?php echo esc_url($linkArr) ?>"
                           class="custom-btn btn-big grad-style-ef"
                            <?php if(isset($open_type) && $open_type==1) { ?>
                                target="_blank" <?php } ?>><?php echo esc_html($button_text) ?></a>
                    <?php } ?>

                <?php } ?>
            </div>
            <!-- End of .pricing-block -->
        </div>
        <?php
        $this->block_count++;
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_cynic_pricing_grids extends WPBakeryShortCodesContainer
    {
        public function contentAdmin($atts, $content = null)
        {
            $width = '';

            $atts = shortcode_atts($this->predefined_atts, $atts);
            extract($atts);
            $this->atts = $atts;
            $output = '';

            $output .= '<div ' . $this->mainHtmlBlockParams($width, 1) . '>';
            if ($this->backened_editor_prepend_controls) {
                $output .= $this->getColumnControls($this->settings('controls'));
            }
            $output .= '<div class="wpb_element_wrapper">';

            if (isset($this->settings['custom_markup']) && '' !== $this->settings['custom_markup']) {
                $markup = $this->settings['custom_markup'];
                $output .= $this->customMarkup($markup);
            } else {
                $output .= $this->outputTitle($this->settings['name']);
                $output .= $this->paramsHtmlHolders($atts);
                $output .= '<div ' . $this->containerHtmlBlockParams($width, 1) . '>';
                $output .= do_shortcode(shortcode_unautop($content));
                $output .= '</div>';
            }

            $output .= '</div>';
            if ($this->backened_editor_prepend_controls) {
                $output .= $this->getColumnControls('add', 'bottom-controls');

            }
            $output .= '</div>';

            return $output;
        }
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_cynic_pricing_grid extends WPBakeryShortCode
    {

    }
}
