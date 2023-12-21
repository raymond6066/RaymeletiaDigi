<?php

class CynicServices
{

    public function __construct()
    {
        add_shortcode('cynic_services', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();
            $args = array(
                'base' => 'cynic_services',
                'name' => __('Services', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
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
                        'type' => 'iconpicker',
                        'heading' => __('Service Icon', 'cynic'),
                        'param_name' => 'icon_minilineicons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'minilineicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Service Title', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Service Sub Title',
                        'type' => 'textarea',
                        'param_name' => 'subtitle',
                        'value' => '',
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
                        ),
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
                        'dependency' => array(
                            'element' => 'layouts',
                            'value' => '2',
                        ),
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'layouts' => '1',
                'colors' => 'grad-style-cd-light',
                'icon_minilineicons' => '',
                'title' => '',
                'subtitle' => '',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
            ), $atts);
        extract($atts);
        $linkArr = vc_build_link($atts['button_link']);
        ob_start();
        $icon_class = "";
        if ($colors == "grad-style-ab-light") {
            $icon_class = " txt-grad-ab";
        } else if ($colors == "grad-style-ef-light") {
            $icon_class = " txt-grad-ef";
        } else if ($colors == "grad-style-cd-light") {
            $icon_class = " txt-grad-cd";
        } ?>

        <?php
        if (isset($layouts) && $layouts == 2) {
            $link = cynic_get_links($button_link, $internal_link, $external_link); ?>
            <a href="<?php echo $link; ?>"
                <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?>
               class="service-box text-center content-block">
                <div class="box-bg<?php echo esc_attr($icon_class); ?>"></div>
                <span class="icon-container <?php echo (!empty($colors)) ? " " . $colors : "grad-style-cd-light"; ?>">
                            <i class="<?php echo esc_attr($icon_minilineicons) . $icon_class; ?>"></i>
                    </span>
                <h5 class="text-center"><?php echo $title; ?></h5>
                <p><?php echo $subtitle ?></p>
            </a>
        <?php } else { ?>
            <div class="service-box text-center content-block">
                <div class="box-bg<?php echo esc_attr($icon_class); ?>"></div>
                <span class="icon-container<?php echo (!empty($colors)) ? " " . $colors : "grad-style-cd-light"; ?>">
                            <i class="<?php echo esc_attr($icon_minilineicons) . $icon_class; ?>"></i>
                        </span>
                <h5 class="text-center"><?php echo $title; ?></h5>
                <p><?php echo $subtitle ?></p>

            </div>
        <?php } ?>
        <?php
        return ob_get_clean();
    }

}
