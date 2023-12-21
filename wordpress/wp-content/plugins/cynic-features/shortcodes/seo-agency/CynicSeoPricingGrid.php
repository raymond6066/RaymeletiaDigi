<?php

class CynicSeoPricingGrid
{
    protected $per_row;

    public function __construct()
    {
        add_shortcode('cynic_seo_pricing_grids', array($this, 'shortcodecb'));
        add_shortcode('cynic_seo_pricing_grid', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $args = array(
                'name' => __('Pricing', 'cynic'),
                'base' => 'cynic_seo_pricing_grids',
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_seo_pricing_grid'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                        'admin_label' => true,
                        'param_name' => 'per_row',
                        'description' => __('Select grid per row.', 'cynic'),
                        'value' => array(2, 3, 4),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_seo_pricing_grid',
                'name' => __('Pricing Block', 'cynic'),
                "category" => __("cynic", "cynic"),
                "as_child" => array('only' => 'cynic_seo_pricing_grids'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'is_container' => true,
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
                        "class" => "",
                        'heading' => __('Title', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __('Title text.', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Currency Symbol', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'currency_symbol',
                        'value' => '',
                        'description' => __('Keep empty if you don\'t want to use.', 'cynic'),
                    ),

                    array(
                        "holder" => "",
                        "class" => "",
                        'heading' => __('Pricing', 'cynic'),
                        'type' => 'textfield',
                        'param_name' => 'pricing',
                        'value' => '',
                        'description' => __('Example :2,999 <sub>/mo</sub>', 'cynic'),
                    ),

                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Bullet Item', 'cynic'),
                        'param_name' => 'available_item',
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Short Description', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'short_content',
                                'description' => __('Tab inner content description.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => __('Make Featured', 'cynic'),
                        'param_name' => 'make_featured',
                        'value' => array(__('Yes', 'cynic') => 'featured'),
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
                'per_row' => '2',
            ), $atts);
        $extra_class = $attributes['extra_class'];
        $per_row = $attributes['per_row'];
        $rows = 'col-lg-6';
        if ($per_row == 1) {
            $rows = 'col-lg-12';
        } elseif ($per_row == 2) {
            $rows = 'col-lg-6';
        } elseif ($per_row == 3) {
            $rows = 'col-lg-4';
        } elseif ($per_row == 4) {
            $rows = 'col-lg-3';
        }

        $this->per_row = $rows;


        $content = do_shortcode($content);
        ob_start(); ?>
        <div class="pricing-container <?php echo esc_attr($extra_class); ?>">
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
                'extra_class' => '',
                'title' => '',
                'currency_symbol' => '',
                'pricing' => '',
                'make_featured' => '',
                'button_link' => '',
                'available_item' => [],
            ), $atts);

        $extra_class = $attributes['extra_class'];
        $per_rows = $this->per_row;
        $available_items = $attributes['available_item'];
        $items = vc_param_group_parse_atts($available_items);

        $title = $attributes['title'];
        $currency_symbol = $attributes['currency_symbol'];
        $pricing = $attributes['pricing'];
        $make_featured = $attributes['make_featured'];
        $linkArr = vc_build_link($attributes['button_link']);

        ob_start();
        ?>

        <div class="<?php echo esc_attr($per_rows); ?> <?php echo esc_attr($extra_class); ?> col-md-6">
            <div class="pricing-table <?php echo esc_attr($make_featured) ?>">
                <h3><?php echo esc_html_cynicSEO_string($title); ?></h3>
                <div class="price">
                    <sup><?php echo esc_html_cynicSEO_string($currency_symbol); ?></sup><?php echo esc_html_cynicSEO_string($pricing); ?>
                </div>
                <?php
                if (isset($items) && !empty($items)) {
                    ?>
                    <ul class="what-is-included">
                        <?php
                        foreach ($items as $item) {
                            if (isset($item['short_content']) || !empty($item['short_content'])) {
                                ?>
                                <li><?php echo esc_html_cynicSEO_string($item['short_content']); ?></li>
                                <?php
                            }
                            ?>
                        <?php } ?>
                    </ul>
                    <?php
                    echo cynicSEO_anchor_link_html($linkArr, 'secondary-btn');
                }
                ?>
            </div>
        </div>

        <?php
        return ob_get_clean();

    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_seo_pricing_grids extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_seo_pricing_grid extends WPBakeryShortCode
    {

    }


}
