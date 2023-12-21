<?php

class CynicHostingFeatures {

    public function __construct() {
        add_shortcode('cynic_hosting_features', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }

    public function addMap() {
        if (function_exists('vc_map')) {
            $menuarr = array();
            $menu_name = 'primary';
            $locations = get_nav_menu_locations();
            $menu = (isset($locations) && !empty($locations)) ? wp_get_nav_menu_object($locations[$menu_name]) : "";
            $menuitems = (isset($menu) && !empty($menu)) ? wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC')) : "";
            if (!empty($menuitems)) {
                foreach ($menuitems as $item) {
                    $menuarr[$item->title] = $item->ID;
                }
            }

            $args = array(
                'base' => 'cynic_hosting_features',
                'name' => __('Hosting Features', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'param_name' => 'features_heading',
                        'type' => 'textfield',
                        'heading' => __('Features Heading', 'cynic'),
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => __('Icon library', 'cynic'),
                        'value' => array(
                            __('Linear Icons', 'cynic') => 'linearicons',
                            __('Font Awesome', 'cynic') => 'fontawesome',
                        ),
                        'admin_label' => true,
                        'param_name' => 'icon_type',
                        'description' => __('Select icon library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Features Icon', 'cynic'),
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
                        'description' => __('Select service icon from library.', 'cynic'),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => __('Service Icon', 'cynic'),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => false,
                            // default true, display an "EMPTY" icon?
                            'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        ),
                        'dependency' => array(
                            'element' => 'icon_type',
                            'value' => 'fontawesome',
                        ),
                        'description' => __('Select icon from library.', 'cynic'),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Features Bullet Points',
                        'type' => 'textarea',
                        'param_name' => 'bullet_points',
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
            'features_heading' => '',
            'icon_type' => 'linearicons',
            'icon_linearicons' => '',
            'icon_fontawesome' => '',
            'bullet_points' => ''
                ), $atts);
        extract($atts);
        if (function_exists('vc_icon_element_fonts_enqueue')) {
            vc_icon_element_fonts_enqueue($icon_type);
        }
        if ($icon_type == 'fontawesome') {
            $iconclass = 'fa ' . $icon_fontawesome;
        } else {
            $iconclass = $icon_linearicons;
        }
        $iconclass = (isset($iconclass) && !empty($iconclass)) ? $iconclass : "icon-linkedin";
        ob_start();
        $newBulletPoints = array();
        if (isset($bullet_points) && !empty($bullet_points)) {
            $bullet_points = nl2br($bullet_points);
            $bullet_points = preg_replace("<br>", "***", $bullet_points);
            $newBulletPoints = explode('<*** />', $bullet_points);
        } ?>
        
        <div class="content equalheight">
            <i class="<?php echo esc_attr($iconclass); ?> "></i>
            <div class="hosting-features-inner">
                <h3><?php echo esc_html($features_heading) ?></h3>
                <?php
                if (isset($newBulletPoints) && !empty($newBulletPoints)) {
                    foreach ($newBulletPoints as $bullet) {
                        ?>
                        <span><i class="icon-checkmark-circle"></i> <?php echo html_entity_decode(esc_html($bullet)); ?></span>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
