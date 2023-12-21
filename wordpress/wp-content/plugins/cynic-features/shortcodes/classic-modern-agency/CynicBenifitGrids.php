<?php

class CynicBenifitGrids {

    public function __construct() {
        add_shortcode('cynic_benifit', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_benifit',
                'name' => __('Benifit Grids', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'CMS Image',
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'cms_title',
                        'type' => 'textfield',
                        'heading' => __('CMS Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'heading' => __('List Items', 'cynic'),
                        'param_name' => 'cms_list',
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => __('List Items', 'cynic'),
                                'param_name' => 'cms_list',
                            )
                        )
                    ),
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
        array(
            'image' => '',
            'cms_title' => '',
            'cms_list' => '',
        ), $atts);
        extract($atts);
        $cms_list = vc_param_group_parse_atts($cms_list);
        ob_start(); ?>
            <div class="content">
                <h3><?php esc_html_e($cms_title, 'cynic'); ?><?php echo wp_get_attachment_image((int)$image, 'full', false, array('class' => ''));?></h3>
                <?php if (isset($cms_list[0]) && !empty($cms_list[0])) { ?>
                <ul class="content_inner">
                    <?php 
                    $count = count($cms_list);
                    for ($i = 0; $i < $count; $i++) {
                        ?>
                        <li><span class="icon-chevron-right"></span><?php echo html_entity_decode(esc_html__($cms_list[$i]['cms_list'], 'cynic')); ?></li>
                        <?php
                    } ?>
                </ul>
                <?php } ?>
                <!-- End of .content_inner -->
            </div>
            <!-- End of .content -->
        <?php
        return ob_get_clean();
    }

}
