<?php

/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Cynic 1.4.4
 */
class CynicThemeCustomize
{
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
     * @since cynic 1.4.4
     */
    public static function cynic_register($wp_customize)
    {
        require_once CYNIC_THEME_CORE_INCLUDES . 'customization-settings-controls.php';
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since MyTheme 1.0
     */
    public static function cynic_header_output()
    {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
            @media screen and (max-width: 767px) {
                #wpadminbar {
                    position: fixed;
                }
            }
        </style>
        <!--/Customizer CSS-->
        <?php
    }

    public static function cynic_customizer_live_preview()
    {
        wp_enqueue_style( 'cynic-theme-customizer-preview', get_stylesheet_directory_uri() . '/css/seo-agency/cynic-customizer-preview.css', array());
    }

}
add_action( 'customize_preview_init', array('CynicThemeCustomize', 'cynic_customizer_live_preview' ));

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('CynicThemeCustomize', 'cynic_register'));

// Output custom CSS to live site
add_action('wp_head', array('CynicThemeCustomize', 'cynic_header_output'));

/* Remove some default customization options */
function cynic_customize_register($wp_customize)
{
    $wp_customize->remove_control("custom_logo");
    $wp_customize->remove_control("blogdescription");
    $wp_customize->remove_control("display_header_text");
    $wp_customize->remove_section("colors");
    $wp_customize->remove_section("background_image");
    $wp_customize->remove_section("header_image");
}

add_action("customize_register", "cynic_customize_register");
