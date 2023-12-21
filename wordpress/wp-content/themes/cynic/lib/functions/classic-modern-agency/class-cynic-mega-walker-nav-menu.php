<?php

/**
 * Nav Menu API: Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class CynicMega_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function cynic_check_current($classes) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= ($depth == 0) ? "\n<div class=\"dropdown-menu dropdown-megamenu\">\n" . "\n<ul class=\"megamenu\">\n" : "\n<ul class=\"dropdown-submenu clearfix\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);
        if ($item->is_dropdown && ($depth === 0)) {
            $item_html = str_replace('<a', '<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"', $item_html);
            $item_html = str_replace('</a>', '</a>', $item_html);
        } elseif (stristr($item_html, 'li class="divider')) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        } elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }
        $item_html = apply_filters('roots_wp_nav_menu_item', $item_html);
        $output .= $item_html;
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= $this->cynic_after_last_menu_item(array($item, $depth, $args));
    }

    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= ($depth == 0) ? "\n</ul>\n" . "\n</div>\n" : "\n</ul>\n";
    }

    public function cynic_after_last_menu_item($args = array()) {
        global $wpdb;
        $item = $args[0];
        $depth = $args[1];
        $arguments = $args[2];
        if ($depth == 0 && $arguments->theme_location == 'primary' && isset($arguments->menu->term_id) && $arguments->menu->term_id) {
            $sql = $wpdb->prepare("SELECT p.ID FROM `{$wpdb->posts}` p INNER JOIN `{$wpdb->postmeta}` pm ON p.ID=pm.post_id INNER JOIN `{$wpdb->term_relationships}` tr ON p.ID = tr.object_id INNER JOIN `{$wpdb->term_taxonomy}` tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.term_id=%d AND p.post_type='nav_menu_item' AND pm.meta_key='_menu_item_menu_item_parent' AND pm.meta_value='0' ORDER BY p.menu_order+0 DESC LIMIT 1", $arguments->menu->term_id);
            $last_item = $wpdb->get_var($sql);
            if ($item->ID == (int) $last_item) {
                $cynic_options = cynic_options();
                if (isset($cynic_options['cynic_feature_modal_button']) && !empty($cynic_options['cynic_feature_modal_button'])) {
                    if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts']==1) {
                        if (isset($cynic_options['cynic_feature_modal_page']) && !empty($cynic_options['cynic_feature_modal_page'])) {
                            return '<li class="menu-btn"><a class="btn btn-fill header-feature-modal proDetModal getAQuoteModal" href="javascript:void(0)">' . esc_html($cynic_options['cynic_feature_modal_button_text']) . '<span class="icon-chevron-right"></span></a></li>';
                        }
                    } else {
                        $link = "#map";
                        if (isset($cynic_options['cynic_onepage_map_link']) && !empty($cynic_options['cynic_onepage_map_link'])) {
                            $link = $cynic_options['cynic_onepage_map_link'];
                        }
                        return '<li class="menu-btn"><a class="btn btn-fill header-feature-modal " href="' . esc_attr($link) . '">' . esc_html($cynic_options['cynic_feature_modal_button_text']) . '<span class="icon-chevron-right"></span></a></li>';
                    }
                }
            }
        }
    }

}

// Walker_Nav_Menu
function cynic_menu_menu_css_class($classes, $item) {
    $slug = sanitize_title($item->title);
    $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
    $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);
    $classes = array_unique($classes);
    return array_filter($classes);
}

add_filter('nav_menu_css_class', 'cynic_menu_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');