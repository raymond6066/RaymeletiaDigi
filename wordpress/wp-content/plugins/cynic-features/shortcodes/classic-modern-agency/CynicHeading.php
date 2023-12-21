<?php

class CynicHeading {

    public function __construct() {
        add_shortcode('cynic_heading', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_heading',
                'name' => __('Heading with sub heading', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
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

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'title' => '',
            'alignment' => '0',
                ), $atts);
        extract($atts);
        ob_start();
        if ($title) {
            switch ($alignment) {
                case '1':
                    $alignclass = 'text-left';
                    break;
                case '2':
                    $alignclass = 'text-right';
                    break;
                default:
                    $alignclass = 'text-align-center';
                    break;
            } ?>
            <h2 class="b-clor <?php echo esc_attr($alignclass) ?>"><?php echo esc_html($title) ?></h2>
            <div class="heading-subtext regular-text <?php echo esc_attr($alignclass) ?>"><?php echo do_shortcode($content) ?></div>
            <?php
        }
        return ob_get_clean();
    }

}
