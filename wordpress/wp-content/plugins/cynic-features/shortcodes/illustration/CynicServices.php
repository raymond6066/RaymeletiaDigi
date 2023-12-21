<?php

class CynicServices
{
    public function __construct()
    {
        add_shortcode('cynic_services', array($this, 'shortcodecb'));
        add_shortcode('cynic_service', array($this, 'shortcodechildcb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {

            $pagearr = cynic_get_pages();

            $args = array(
                'base' => 'cynic_services',
                'name' => __('Cynic Services', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                "as_parent" => array('only' => 'cynic_service'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => false,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'heading',
                        'type' => 'textfield',
                        'heading' => __('Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Sub Heading',
                        'type' => 'textarea',
                        'param_name' => 'sub_heading',
                        'value' => '',
                    ),
                    array(
                        'div' => '',
                        'type' => 'dropdown',
                        'heading' => __('Text Alignment', 'cynic'),
                        'value' => array(
                            __('Center', 'cynic') => '0',
                            __('Left', 'cynic') => '1',
                            __('Right', 'cynic') => '2',
                        ),
                        'admin_label' => true,
                        'param_name' => 'alignment',
                        'description' => __('Select text alignment.', 'cynic'),
                    ),
                ),
                "js_view" => 'VcColumnView'
            );
            vc_map($args);

            $args = array(
                'base' => 'cynic_service',
                'name' => __('Service', 'cynic'),
                "category" => __("Illustration", "cynic"),
                "as_child" => array('only' => 'cynic_services'),
                "content_element" => true,
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Upload Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
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
                            '--Select--' => '',
                            'Internal Link' => '1',
                            'External Link' => '2',
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
                            'element' => 'button_link',
                            'value' => array('1', '2'),
                        ),
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('Bullet Points', 'cynic'),
                        'param_name' => 'features',
                        'params' => array(
                            array(
                                "holder" => "",
                                "class" => "",
                                'type' => 'attach_image',
                                'param_name' => 'bullet_image',
                                'heading' => __('Upload Image', 'cynic'),
                                'value' => '',
                                'admin_label' => true,
                            ),
                            array(
                                "holder" => "",
                                "class" => "",
                                'heading' => __('Bullet Text', 'cynic'),
                                'type' => 'textarea',
                                'param_name' => 'bullet_text',
                                'description' => __('Bulllet text here.', 'cynic'),
                                'admin_label' => true,
                            ),
                        )
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'heading' => '',
                'sub_heading' => '',
                'alignment' => '0',
            ), $atts);
        extract($atts);
        ob_start();
        $content = do_shortcode($content); ?>
        <div class="floating-service-wrapper section-gap">
            <div class="container">
                <?php
                if ($heading) {
                    switch ($alignment) {
                        case '1':
                            $alignclass = 'text-left';
                            break;
                        case '2':
                            $alignclass = 'text-right';
                            break;
                        default:
                            $alignclass = 'text-center';
                            break;
                    }
                    if($heading) { ?>
                        <h2 class="section-title <?php echo esc_attr($alignclass) ?>"><?php echo esc_html($heading) ?></h2>
                        <?php
                    }
                    if($sub_heading) { ?>
                        <p class="larger-txt <?php echo esc_attr($alignclass) ?>"><?php echo html_entity_decode(cynic_nl2br($sub_heading)); ?></p>
                        <?php
                    }
                } ?>
                <div class="grid-wrapper">
                    <div class="row justify-content-center">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function shortcodechildcb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'image' => '',
                'title' => '',
                'subtitle' => '',
                'button_link' => '',
                'internal_link' => '',
                'external_link' => '#',
                'open_type' => '0',
                'features' => ''
            ), $atts);
        extract($atts);
        $image_url = wp_get_attachment_url($image);
        $features = vc_param_group_parse_atts($features);
        $bullets = count($features);
        ob_start();
        $link = cynic_get_links($button_link, $internal_link, $external_link);?>
        <div class="col-xl-4 col-lg-6">
            <div class="service-block text-center">
                <a href="<?php echo esc_url($link) ?>"
                    <?php if(isset($open_type) && $open_type==1) { ?> target="_blank" <?php } ?>>
                    <img src="<?php echo esc_url($image_url) ?>" alt="">
                    <h4>
                        <?php echo esc_html($title) ?>
                    </h4>
                    <p><?php echo html_entity_decode(cynic_nl2br($subtitle)); ?></p>
                </a>
                <?php if(isset($features[0]) && !empty($features[0])) { ?>
                    <div class="service-overlay">
                        <div class="facilities text-left">
                            <?php
                            foreach($features as $feature) {
                                if(isset($feature) && !empty($feature)) {
                                    $bullets_image = wp_get_attachment_url($feature['bullet_image']); ?>
                                    <div>
                                        <img src="<?php echo esc_url($bullets_image) ?>"
                                             alt="<?php echo esc_html($feature['bullet_text']) ?>"><?php echo esc_html($feature['bullet_text']) ?>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                        <!-- End of .facilities -->
                    </div>
                <?php } ?>
                <!-- End of .service-overlay -->
            </div>
        </div>
        <!-- End of .col-4 -->
        <?php
        return ob_get_clean();
    }

}

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_cynic_Services extends WPBakeryShortCodesContainer
    {

    }

}
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_cynic_Service extends WPBakeryShortCode
    {

    }

}
