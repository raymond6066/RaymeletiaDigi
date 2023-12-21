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
        require_once CYNIC_THEME_CORE_INCLUDES . 'customizer-custom-controls/functions.php';

        /* To load all customizer section */

        if (!is_admin()) {
            $opt_prefix = CYNIC_PREFIX;
            $cynic_options = array(
                $opt_prefix . 'site_logo' => CYNIC_THEME_URI . '/images/trendy-agency-logo.png',
                $opt_prefix . 'is_header_button_open_with_modal' => true,

                $opt_prefix . 'pre_loader' => false,
                $opt_prefix . 'footer_logo' => array('url' => ''),

                $opt_prefix . '404_error' => array('url' => CYNIC_THEME_URI . '/images/404-error.png'),

                $opt_prefix . 'floating_ballon' => array('url' => CYNIC_THEME_URI . '/images/floating-ballon.png'),
                $opt_prefix . 'blog_sidebar' => TRUE,
                $opt_prefix . 'blog_single_sidebar' => TRUE,

                $opt_prefix . 'blog_comment_section' => TRUE,
                $opt_prefix . 'page_comment_section' => TRUE,
                $opt_prefix . 'display_blog_social_share' => false,
                /*Bredcrumb*/
                $opt_prefix . 'breadcrumb_home_title' => "Home",
                $opt_prefix . 'breadcrumb_blog_title' => "Blog",
                $opt_prefix . 'is_enabled_breadcrumb' => true,
                $opt_prefix . 'cynic_header_button_display' => true,
                $opt_prefix . 'breadcrumb_separator' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
            );
        }
        $customizer_dir = CYNIC_THEME_CORE_INCLUDES . '/customization-controls';
        if (is_dir($customizer_dir) && $cc_dirhandle = opendir($customizer_dir)) {
            while ($cc_file = readdir($cc_dirhandle)) {
                if (!in_array($cc_file, array('.', '..'))) {
                    $cfile = explode('.', $customizer_dir . '/' . $cc_file);
                    require_once wp_normalize_path($customizer_dir . '/' . $cc_file);
                }
            }
        }
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
    }

}

add_action('customize_preview_init', array('CynicThemeCustomize', 'cynic_customizer_live_preview'));
//
// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('CynicThemeCustomize', 'cynic_register'));

// Output custom CSS to live site
add_action('wp_head', array('CynicThemeCustomize', 'cynic_header_output'));

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
