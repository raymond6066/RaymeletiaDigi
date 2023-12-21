<?php

class CynicGlobalHeading {

    public function __construct() {
        add_shortcode('cynic_global_heading', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_global_heading',
                'name' => __('Global Heading', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'cynic_global_heading',
                        'type' => 'textfield',
                        'heading' => __('Cynic Global Heading', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'param_name' => 'heading_row_id',
                        'type' => 'textfield',
                        'heading' => __('Row ID', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'param_name' => 'heading_row_class',
                        'type' => 'textfield',
                        'heading' => __('Row Class', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __('Global Heading Options', 'cynic'),
                        'param_name' => 'css',
                        'group' => __('Design options', 'cynic'),
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
            array(
                'cynic_global_heading' => '',
                'heading_row_id' => '',
                'heading_row_class' => '',
                'css' => ''        
            ), $atts);
        extract($atts);
        $css_class = vc_shortcode_custom_css_class( $css );
        ob_start(); ?>
        <h2 <?php if(!empty($heading_row_id)) { ?>id="<?php echo esc_attr($heading_row_id)?>" <?php } ?> class="b-clor <?php echo esc_attr( $css_class ); ?> <?php echo esc_attr($heading_row_class); ?>"><?php echo esc_html_e($cynic_global_heading, 'cynic') ?></h2>
        <?php
        return ob_get_clean();
    }

}