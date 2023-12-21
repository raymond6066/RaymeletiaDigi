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
                "category" => __("Illustration", "cynic"),
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
                    )
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
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'block_title',
                        'type' => 'textarea',
                        'heading' => __('Pricing Block Title', 'cynic'),
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
                                "holder" => "div",
                                "class" => "",
                                'param_name' => 'grid_title',
                                'type' => 'textfield',
                                'heading' => __('Grid Title', 'cynic'),
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
                                'heading' => __('Bullet Points', 'cynic'),
                                'param_name' => 'bullet_points',
                                'params' => array(
                                    array(
                                        "holder" => "",
                                        "class" => "",
                                        'heading' => __('Image', 'cynic'),
                                        'type' => 'attach_image',
                                        'param_name' => 'image',
                                        'value' => '',
                                    ),

                                    array(
                                        "holder" => "div",
                                        "class" => "",
                                        'param_name' => 'bullet_features',
                                        'type' => 'textarea',
                                        'heading' => __('Features', 'cynic'),
                                        'value' => '',
                                        'admin_label' => true,
                                    ),

                                ),
                            ),

                            array(
                                'heading' => 'Button Text',
                                'type' => 'textfield',
                                'param_name' => 'button_text',
                            ),

                            array(
                                'heading' => 'Button Link',
                                'type' => 'dropdown',
                                'param_name' => 'button_link',
                                'value' => array(
                                    'Internal Link' => '1',
                                    'External Link' => '2',
                                    'Bookmark' => '3',
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
                                'heading' => 'External/Bookmark Link',
                                'type' => 'textfield',
                                'param_name' => 'external_link',
                                'dependency' => array(
                                    'element' => 'button_link',
                                    'value' => array('2','3'),
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
                                'dependency' => array(
                                    'element' => 'button_link',
                                    'value' => array('1','2'),
                                ),
                            )
                        )
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
                'extra_class' => ''
            ), $atts);
        extract($atts);
        $content = do_shortcode($content);
        $align_class = $extra_class;
        ob_start(); ?>
        <div class="container <?php echo esc_attr($align_class); ?>">
            <div class="grid-wrapper pricing-grid-wrapper">
                <div class="row align-items-center no-gutters">
                    <?php echo do_shortcode($content); ?>
                </div>
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
                'block_title' => '',
                'pricing' => '',
                'features' => ''
            ), $atts);
        extract($atts);
        ob_start();
        $pricing_features = vc_param_group_parse_atts($features);
        $featuresCount = count($pricing_features); ?>
        <div class="col-xl-6">
            <div class="pricing-group">
                <div class="group-title text-center">
                    <?php echo esc_html($block_title) ?>
                </div>
                <!-- End of .group-title -->
                <?php if($featuresCount>0) { ?>
                    <div class="row no-gutters">
                        <?php
                        $i=1;
                        $active = "";
                        foreach($pricing_features as $feature) {
                            $active = ($this->block_count==2 && $i==1) ? "active" : "";?>
                            <div class="col-md-6">
                                <div class="pricing-block <?php echo esc_attr($active); ?> text-center">
                                    <h3 class="pricing-level">
                                        <?php echo esc_html($feature['grid_title']) ?>
                                    </h3>
                                    <div class="price">
                                        <?php echo html_entity_decode(cynic_nl2br($feature['pricing'])); ?>
                                    </div>
                                    <!-- End of .price -->
                                    <?php
                                    $bullet_points = vc_param_group_parse_atts($feature['bullet_points']);
                                    $bulletCount = count($bullet_points);
                                    if($bulletCount > 0) { ?>
                                        <div class="facilities text-left">
                                            <?php foreach($bullet_points as $bullet) { ?>
                                            <div>
                                                <?php echo wp_get_attachment_image($bullet['image'], 'full', false) ?><?php echo html_entity_decode(cynic_nl2br($bullet['bullet_features'])); ?></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <!-- End of .facilities -->
                                    <?php
                                    $button_link = $feature['button_link'];
                                    $internal_link = (isset($feature['internal_link'])) ? $feature['internal_link'] : "";
                                    $external_link = (isset($feature['external_link'])) ? $feature['external_link'] : "";
                                    $link = cynic_get_links($button_link, $internal_link, $external_link);
                                    $page_scroll = ($feature['button_link'] == 3) ? "page-scroll" : "";
                                    $btn_class = ($this->block_count==2 && $i==1) ? "custom-btn " : "custom-btn secondary-btn ";
                                    if (!empty($link)) { ?>
                                        <a href="<?php echo esc_url($link) ?>"
                                           class="<?php echo esc_attr($btn_class) . esc_attr($page_scroll); ?>">
                                            <?php echo esc_html($feature['button_text']) ?></a>
                                    <?php } ?>
                                </div>
                                <!-- End of .pricing-block -->
                            </div>
                        <?php $i++; } ?>
                        <!-- End of .col-md-6 -->
                    </div>
                <?php } ?>
                <!-- End of .row -->
            </div>
            <!-- End of .pricing-group -->
        </div>
        <!-- End of .col-lg-6 -->
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
