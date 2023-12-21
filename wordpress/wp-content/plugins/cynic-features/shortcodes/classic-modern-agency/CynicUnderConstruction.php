<?php

class CynicUnderConstruction {

    public function __construct() {
        add_shortcode('cynic_under_construction', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $args = array(
                'base' => 'cynic_under_construction',
                'name' => __('Under Construction', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                            __('Flat Icons', 'cynic') => 'flaticon',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 400,
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Tab Icon', 'cynic'),
                        'param_name' => 'icon_linearicons',
                        'settings' => array(
                            'emptyIcon' => false, // default true, display an "EMPTY" icon?
                            'type' => 'linearicons',
                            'iconsPerPage' => 200, // default 100, how many icons per/page to display
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'linearicons',
                        ),
                        'value' => 'icon-users2',
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Select a Icon.', 'cynic'),
                        'param_name' => 'icon_flaticon',
                        'value' => 'flaticon-building-4',
                        'settings' => array(
                            'emptyIcon' => false,
                            'iconsPerPage' => 200,
                            'type' => 'flaticon',
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'flaticon',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'title',
                        'type' => 'textarea',
                        'heading' => __('Title', 'cynic'),
                        'value' => '',
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'sub_title',
                        'type' => 'textfield',
                        'heading' => __('Sub Title', 'cynic'),
                        'value' => '',
                    )
                ),
            );
            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
        array(
            'icon_title' => '',
            'icon_type' => '',
            'icon_linearicons' => 'icon-users2',
            'icon_fontawesome' => 'fa-adjust',
            'icon_flaticon' => 'flaticon-building-4',
            'title' => '',
            'sub_title' => '',
            
        ), $atts);
        extract($atts);
        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = 'fa ' . $icon_fontawesome;
        } else if ($icon_type == 'flaticon') {
            $iconclass = "flaticon-building-4";
            if (!empty($icon_flaticon)) {
                $iconclass = $icon_flaticon;
            }
        } else {
            $iconclass = $icon_linearicons;
        }
        ob_start();
        ?>
        <div class="under-construction">
            <div class="text-center">
                <div class="under-construction-message">
                    <i class="<?php echo esc_attr($iconclass); ?>"></i> <?php echo html_entity_decode(esc_html(nl2br($title))); ?>
                    <span><?php echo esc_html($sub_title); ?></span>
                </div>
                <!-- End of .under-construction-message -->
            </div>
            <!-- End of .container -->
        </div>
        <?php
        return ob_get_clean();
    }

}
