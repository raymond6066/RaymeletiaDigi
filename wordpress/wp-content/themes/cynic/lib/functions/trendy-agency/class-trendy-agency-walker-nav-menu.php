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
class trendy_Agency_Walker_Nav_Menu extends Walker_Nav_Menu
{


    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of menu item. Used for padding.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        // Default class.
        $classes = array('sub-menu custom-dropdown-menu');

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param array $classes The CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args An object of `wp_nav_menu()` arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul $class_names>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param WP_Post $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @param int $id Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (!is_object($args)) {
            $args = (object)$args;
        }

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }

        $indent = ($depth) ? str_repeat($t, $depth) : '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'nav-item';
        $classes[] = 'nav-menu-item-' . sanitize_title($item->title);
        $classes = array_values(array_filter($classes));

        if (in_array('current-menu-item', $classes)) {
            $classes[] = "active";
        }

        $atts_classs = '';
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = "dropdown";
            $atts_classs = 'dropdown-opener';
        }
        if (in_array('cynic-nav-menu-button', $classes)) {
            $atts_classs .= 'nav-link custom-btn btn-mid grad-style-cd';
        }

        if ($item->menu_item_parent > 0) {
            $classes[] = 'dropdown-item';
        }

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param WP_Post $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';


        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['class'] = 'nav-link ' . $atts_classs;
        $cynic_options = cynic_options();
        if (get_theme_mod('cynic_layouts') == 2) {
            $atts['class'] = 'nav-link page-scroll' . $atts_classs;
        }

        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';


        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                if ($value == '#') {
                    $value = ('href' === $attr) ? 'javascript:void(0)' : '#';
                } else {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                }
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }


        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string $title The menu item's title.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;


        // if($args->walker->has_children) {
        //     $item_output .="<span class='dropdown-toggle'></span>";
        // }

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param WP_Post $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         */

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 3.0.0
     *
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param WP_Post $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
        $output .= $this->cynic_trendy_after_last_menu_item(array($item, $depth, $args));
    }

    public function cynic_trendy_after_last_menu_item($args = array())
    {
        global $wpdb;
        $item = $args[0];
        $depth = $args[1];
        $arguments = $args[2];
        if ($depth == 0 && $arguments->theme_location == 'primary' && isset($arguments->menu->term_id) && $arguments->menu->term_id) {
            $sql = $wpdb->prepare("SELECT p.ID FROM `{$wpdb->posts}` p INNER JOIN `{$wpdb->postmeta}` pm ON p.ID=pm.post_id INNER JOIN `{$wpdb->term_relationships}` tr ON p.ID = tr.object_id INNER JOIN `{$wpdb->term_taxonomy}` tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.term_id=%d AND p.post_type='nav_menu_item' AND pm.meta_key='_menu_item_menu_item_parent' AND pm.meta_value='0' ORDER BY p.menu_order+0 DESC LIMIT 1", $arguments->menu->term_id);
            $last_item = $wpdb->get_var($sql);
            if ($item->ID == (int)$last_item) {
                if (get_theme_mod('cynic_header_button_display')) {
                    $get_button_text = get_theme_mod('cynic_header_button_text');
                    $button_text = (!empty($get_button_text)) ? $get_button_text : "Contact Us";
                    if (get_theme_mod('cynic_is_header_button_open_with_modal') == "bookmark") {
                        $bookmark_link = get_theme_mod('cynic_header_button_bookmark');
                        $bookmark = (!empty($bookmark_link)) ? $bookmark_link : "#contact";
                        return '<li class="nav-item"><a class="nav-link custom-btn btn-mid grad-style-cd page-scroll" href="' . esc_url($bookmark) . '" >' . esc_html($button_text) . '</a></li>';
                    } else if (get_theme_mod('cynic_is_header_button_open_with_modal') == "page") {
                        $pageID = get_theme_mod('cynic_header_button_page');
                        if ($pageID) {
                            $pageLink = get_page_link($pageID);
                            return '<li class="nav-item"><a class="nav-link custom-btn btn-mid grad-style-cd" href="' . esc_url($pageLink) . '" >' . esc_html($button_text) . '</a></li>';
                        }
                    } else if (get_theme_mod('cynic_is_header_button_open_with_modal') == "modal") {
                        $pageID = get_theme_mod('cynic_header_button_page');
                        if ($pageID) {
                            return '<li class="nav-item"><a class="nav-link custom-btn btn-mid grad-style-cd" href="javascript:void(0)" data-toggle="modal" data-target="#get-a-quote-modal">' . esc_html($button_text) . '</a></li>';
                        }
                    } else {
                        return '<li class="nav-item"><a class="nav-link custom-btn btn-mid grad-style-cd" href="javascript:void(0)">' . $button_text . '</a></li>';
                    }
                }
            }
        }
    }

}

// Walker_Nav_Menu
