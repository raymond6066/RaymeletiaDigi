<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Cynic 1.4
 */
class CynicThemeCustomize {

    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     * 
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *  
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since Cynic 1.4
     */
    public static function cynic_register($wp_customize) {
        ob_start();
        $cynic_options = cynic_options();
        
        // Inlcude the Alpha Color Picker.
        require_once CYNIC_THEME_CORE_DIR. 'alpha-color-picker/alpha-color-picker.php';
        
        if(isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts']==2) {
            require_once CYNIC_THEME_CORE_INCLUDES . 'onepage-option-settings.php';
        } else{
            require_once CYNIC_THEME_CORE_INCLUDES . 'multipage-option-settings.php';
        }
        ob_clean();
        
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     * @since MyTheme 1.0
     */
    public static function cynic_header_output() {
        ?>
        <!--Customizer CSS--> 
        <style type="text/css">
        <?php self::cynic_generate_css('a', 'color', 'cynic_theme[link_textcolor]'); ?>
        <?php self::cynic_generate_css('a:hover', 'color', 'cynic_theme[link_hover_textcolor]'); ?>
        </style> 
        <!--/Customizer CSS-->
        <?php
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function cynic_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if (!empty($mod)) {
            $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
            );
            if ($echo) {
                echo esc_attr($return);
            }
        }
        return $return;
    }

}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('CynicThemeCustomize', 'cynic_register'));

// Output custom CSS to live site
add_action('wp_head', array('CynicThemeCustomize', 'cynic_header_output'));

/* Remove some default customization options */

function cynic_customize_register($wp_customize) {
    $wp_customize->remove_control("custom_logo");
    $wp_customize->remove_section("colors");
    $wp_customize->remove_section("background_image");
    $wp_customize->remove_section("header_image");
}

add_action("customize_register", "cynic_customize_register");
