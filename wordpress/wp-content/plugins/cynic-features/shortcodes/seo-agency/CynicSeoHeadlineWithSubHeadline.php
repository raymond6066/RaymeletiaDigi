<?php

class CynicSeoHeadlineWithSubHeadline {

    public function __construct() {
        add_shortcode('cynic_seo_headline_with_sub_hadline', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_seo_headline_with_sub_hadline',
                'name' => __('Headline with Sub Headline', 'cynic'),
                "category" => __("SEO Agency", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => false,
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textfield',
                        'heading' => __('Heading', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Sub Heading',
                        'type' => 'textarea',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Short Description',
                        'type' => 'textarea_html',
                        'param_name' => 'short_description',
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
            'short_description' => ''
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
                    $alignclass = 'text-center';
                    break;
            } ?>
            <div class="container">
                <div class="section-heading <?php echo esc_attr($alignclass) ?>">
                    <h2><?php echo html_entity_decode(esc_html($title)) ?></h2>
                    <p><?php echo do_shortcode($content) ?></p>
                </div>
                <p class="<?php echo esc_attr(($alignclass=="text-align-center") ? "text-center" : $alignclass) ?>"><?php echo esc_html($short_description); ?></p>
            </div>
            <?php   
        }
        return ob_get_clean();
    }

}
