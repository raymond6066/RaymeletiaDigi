<?php

class CynicHeading
{

    public function __construct()
    {
        add_shortcode('cynic_heading_with_subheading', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap()
    {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_heading_with_subheading',
                'name' => __('Heading with Subheading', 'cynic'),
                "category" => __("Trendy Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
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
                        'type' => 'textarea_html',
                        'param_name' => 'content',
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
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
            array(
                'heading' => '',
                'alignment' => '0',
            ), $atts);
        extract($atts);
        ob_start();
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
                <h2 class="<?php echo esc_attr($alignclass) ?>"><?php echo esc_html($heading) ?></h2>
                <?php
            }
            if($content) { ?>
                <p class="section-subheading <?php echo esc_attr($alignclass) ?>"><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                <?php
            }
        }
        return ob_get_clean();
    }

}
