<?php

class CynicHomeBanner {

    public function __construct() {
        add_shortcode('cynic_homepage_banner', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $pagearr = cynic_get_pages();
            $args = array(
                'base' => 'cynic_homepage_banner',
                'name' => __('Homepage Banner', 'cynic'),
                "category" => __("Illustration", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "",
                        "class" => "",
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => __('Banner Image', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Banner Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Banner Sub Heading',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'button_text',
                        'type' => 'textfield',
                        'heading' => __('Button Text', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'heading' => 'Button Link',
                        'type' => 'dropdown',
                        'param_name' => 'button_link',
                        'dependency' => array(
                            'element' => 'display_load_more',
                            'value' => '1',
                        ),
                        'value' => array(
                            'Internal Link' => '1',
                            'External Link' => '2',
                            'Bookmark' => '3'
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
                        'heading' => 'External Link/ Bookmark',
                        'type' => 'textfield',
                        'param_name' => 'external_link',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('2', '3'),
                        ),
                        'value' => '#',
                    ),
                    array(
                        "holder" => "div",
                        'heading' => __('Open Type', 'cynic'),
                        'type' => 'dropdown',
                        'param_name' => 'open_type',
                        'dependency' => array(
                            'element' => 'button_link',
                            'value' => array('1', '2'),
                        ),
                        'value' => array(
                            'Same Window' => '0',
                            'New Window' => '1',
                        ),
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
                'image' => '',
                'button_text' => 'discover more',
                'button_link' => '1',
                'internal_link' => '#',
                'external_link' => '#',
                'open_type' => '0'
            ), $atts);
        extract($atts);
        ob_start();
        $image_url = wp_get_attachment_url($image); ?>
        <div class="row no-gutters align-items-center">
            <div class="col-lg-6 text-center text-lg-left">
                <h1><?php echo html_entity_decode(cynic_nl2br($title)); ?></h1>
                <p class="larger-txt"><?php echo html_entity_decode(cynic_nl2br($content)); ?></p>
                <?php
                $link = cynic_get_links($button_link, $internal_link, $external_link);
                $page_scroll = ($button_link == 3) ? "page-scroll" : "";
                if (!empty($link)) { ?>
                    <a href="<?php echo esc_url($link) ?>"
                       class="custom-btn secondary-btn <?php echo esc_attr($page_scroll); ?>"><?php echo esc_html($button_text) ?></a>
                <?php } ?>

            </div>
            <!-- End of .col-lg-5 -->

            <div class="col-lg-6">
                <div class="img-container text-center text-lg-right">
                    <img src="<?php echo esc_url($image_url); ?>" alt="Home Banner" class="img-fluid">
                </div>
                <!-- End of .img-container -->
            </div>
            <!-- End of .col-lg-6 -->
        </div>
        <!-- End of .row -->
        <?php
        return ob_get_clean();
    }

}
