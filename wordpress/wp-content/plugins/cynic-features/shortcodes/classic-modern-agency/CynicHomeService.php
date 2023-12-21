<?php

class CynicHomeService {

    public function __construct() {
        add_shortcode('cynic_home_service', array($this, 'shortcodecb'));
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
                'base' => 'cynic_home_service',
                'name' => __('Home Service Box', 'cynic'),
                "category" => __("Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon' => 'cynic-icon',
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
                        'heading' => __('Service Icon', 'cynic'),
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
                        'heading' => 'Content',
                        'type' => 'textarea_html',
                        'param_name' => 'content',
                        'value' => '',
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => __("Select Menus"),
                        "param_name" => "menulists",
                        "admin_label" => true,
                        'value' => $menuarr,
                        "description" => __("Please choose the menu to display in service.")
                    )
                ),
            );

            vc_map($args);
        }
    }

    public function shortcodecb($atts = array(), $content = null) {
        $atts = shortcode_atts(
                array(
            'title' => '',
            'icon_type' => 'linearicons',
            'icon_linearicons' => '',
            'icon_fontawesome' => '',
            'menulists' => ''
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
        ob_start();
        $linkprefix = '<div class="service-title-section">';
        $linksuffix = '</div>';
        global $wpdb;
        $menuarr = array();
        $newArr = array();
        $menu_name = 'primary';
        $locations = get_nav_menu_locations();
        $menu = (isset($locations) && !empty($locations)) ? wp_get_nav_menu_object($locations[$menu_name]) : "";
        $menuitems = (isset($menu) && !empty($menu)) ? wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC')) : "";
        $selected_ids = explode(',', $menulists);
        if (isset($selected_ids[0]) && !empty($selected_ids[0])) {
            if (!empty($menuitems)) {
                foreach ($menuitems as $item) {
                    $menuarr[$item->ID] = $item->title;
                    if(in_array($item->ID, $selected_ids)){
                        $newArr[$item->ID] = $item->title;
                    } 
                }
            }
        }
        if (!empty($menulists)) {
            $menu_icons = $wpdb->get_results("SELECT p.menu_order, pm.post_id,pm.meta_value FROM `{$wpdb->posts}` p , `{$wpdb->postmeta}` pm WHERE p.ID=pm.post_id AND pm.meta_key='_menu_item_icon' AND pm.post_id IN ($menulists) ORDER BY p.menu_order ASC");
        }
        ?>
        <div class="service-box service-height">
            <div class="box-green-border"> <?php echo $linkprefix ?><span class="<?php echo esc_attr($iconclass) ?>"></span>
                <div class="service-title"><?php echo esc_html($title) ?></div><?php echo $linksuffix ?>
                <?php echo apply_filters('the_content', $content); ?>
                <?php if (isset($newArr) && !empty($newArr)) { ?>
                    <div class="service-overlay">
                        <ul class="clearfix">
                            <?php
                            $counter = 0;
                            foreach ($newArr as $key => $item) {
                                $id = get_post_meta($key, '_menu_item_object_id', true);
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_page_link($id)) ?>">
                                        <?php if (isset($menu_icons[$counter]->meta_value) && !empty($menu_icons[$counter]->meta_value)) { ?>
                                            <i class="<?php echo esc_attr($menu_icons[$counter]->meta_value) ?>"></i>
                                        <?php } ?>
                                        <?php echo esc_html($item) ?>
                                    </a>
                                </li>
                                <?php
                                $counter++;
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
