<?php
if (!defined('ABSPATH')) {
    die('No script hack please');
}
/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (class_exists('Redux')) {

    $googleFonts = array();
    $_dir = get_template_directory_uri() . '/js/trendy-agency/webfonts.json';
    $fontRequest = wp_remote_get($_dir);

    if (is_wp_error($fontRequest)) {
        return false;
    }
    $fonts = wp_remote_retrieve_body($fontRequest);
    $fonts = json_decode($fonts);

    if (isset($fonts->items) && !empty($fonts->items)) {
        foreach ($fonts->items as $item) {
            $fontFamily = $item->family . ", " . $item->category;
            $googleFonts[$fontFamily] = $item->family;
        }
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "cynic_options";
    $opt_name = apply_filters('redux_demo/opt_name', $opt_name);

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name' => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $theme->get('Name'),
        // Name that appears at the top of your panel
        'display_version' => $theme->get('Version'),
        // Version that appears at the top of your panel
        'menu_type' => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => true,
        // Show the sections below the admin menu item or not
        'menu_title' => esc_html__('Theme Options', 'cynic'),
        'page_title' => esc_html__('Theme Options', 'cynic'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => false,
        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
        'admin_bar' => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon' => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
        // OPTIONAL -> Give you extra features
        'page_priority' => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => '',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => '',
        // Page slug used to denote the panel
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => true,
        // Shows the Import/Export panel when not used as a field.
        // CAREFUL -> These options are for advanced use only
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn' => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        //'compiler'             => true,
        // HINTS
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
                'shadow' => true,
                'rounded' => false,
                'style' => '',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'click mouseleave',
                ),
            ),
        )
    );
    Redux::setArgs($opt_name, $args);


    $opt_prefix = 'cynic_';


    /**
     * Header ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Header', 'cynic'),
        'id' => 'header',
        'desc' => __('These are really basic fields!', 'cynic'),
        'customizer_width' => '400px',
        'icon' => 'el el-th'
    ));

    /**
     * Logo
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Logo', 'cynic'),
            'id' => 'header-logo',
            'desc' => esc_html__('Set Header Site logo', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'site_logo',
                    'type' => 'media',
                    'url' => true,
                    'title' => esc_html__('Site Logo', 'cynic'),
                    'compiler' => 'true',
                    'default' => array('url' => CYNIC_THEME_URI . '/images/trendy-agency-logo.png'),
                ),
            ),)
    );

    /**
     * Header Top Button
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Top Button', 'cynic'),
        'id' => 'header-top-button',
        'desc' => esc_html__('Set Header Top Button Settings', 'cynic'),
        'icon' => 'el el-star-alt',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(

            array(
                'id' => $opt_prefix . 'header_button_display',
                'type' => 'switch',
                'title' => esc_html__('Display Header Button', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable header button', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),

            array(
                'id' => $opt_prefix . 'header_button_text',
                'type' => 'text',
                'title' => esc_html__('Set Header Button Text', 'cynic'),
                'subtitle' => esc_html__('Set Header Modal Button Text', 'cynic'),
                'default' => esc_html__('Contact Us', 'cynic'),
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
            ),
            array(
                'id' => $opt_prefix . 'is_header_button_open_with_modal',
                'type' => 'select',
                'title' => esc_html__('Link Open', 'cynic'),
                'subtitle' => esc_html__('Open Link with Page/Modal', 'cynic'),
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
                'options' => array(
                    'modal' => 'Modal',
                    'page' => 'Page',
                    'bookmark' => 'Bookmark',
                ),
                'default' => 'modal'
            ),

            array(
                'id' => $opt_prefix . 'header_button_page',
                'type' => 'select',
                'title' => esc_html__('Set Header Button Page', 'cynic'),
                'subtitle' => esc_html__('Set header button Page', 'cynic'),
                'data' => 'pages',
                'required' => array($opt_prefix . 'is_header_button_open_with_modal', '!=', 'bookmark'),
            ),


            array(
                'id' => $opt_prefix . 'header_button_open_type',
                'type' => 'radio',
                'title' => esc_html__('Button Open Type', 'cynic'),
                'subtitle' => esc_html__('Button Link open type', 'cynic'),
                'options' => array(
                    '_blank' => 'New Window',
                    '_self' => 'Same Window',
                ),
                'default' => '_blank',
                'required' => array($opt_prefix . 'is_header_button_open_with_modal', '=', 'page')
            ),

            array(
                'id' => $opt_prefix . 'header_button_bookmark',
                'type' => 'text',
                'title' => esc_html__('Set Bookmark Link', 'cynic'),
                'subtitle' => esc_html__('Set Header Modal Bookmark Link', 'cynic'),
                'default' => esc_html__('#contact', 'cynic'),
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
            ),

        )
    ));


    /**
     * Global Colors
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Global Colors', 'cynic'),
            'id' => 'global-colors',
            'desc' => esc_html__('Set Global Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => false,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'primary-colors-from',
                    'type' => 'color',
                    'default' => '#e9a17b',
                    'validate' => 'color',
                    'title' => 'Primary Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'primary-colors-to',
                    'type' => 'color',
                    'default' => '#ff7cb0',
                    'validate' => 'color',
                    'title' => 'Primary Colors To',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'secondary-colors-from',
                    'type' => 'color',
                    'default' => '#f18cff',
                    'validate' => 'color',
                    'title' => 'Secondary Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'secondary-colors-to',
                    'type' => 'color',
                    'default' => '#af46fc',
                    'validate' => 'color',
                    'title' => 'Secondary Colors To',
                    'transparent' => false
                ),

                array(
                    'id' => $opt_prefix . 'tertiary-colors-from',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Tertiary Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'tertiary-colors-to',
                    'type' => 'color',
                    'default' => '#6245fe',
                    'validate' => 'color',
                    'title' => 'Tertiary Colors To',
                    'transparent' => false
                ),
            ),
        )
    );


    /**
     * Button Colors
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Button Colors', 'cynic'),
            'id' => 'button-colors',
            'desc' => esc_html__('Set Button Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => false,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'primary-btn-colors-from',
                    'type' => 'color',
                    'default' => '#e9a17b',
                    'validate' => 'color',
                    'title' => 'Primary Button Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'primary-btn-colors-to',
                    'type' => 'color',
                    'default' => '#ff7cb0',
                    'validate' => 'color',
                    'title' => 'Primary Button Colors To',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'primary-btn-colors-from-hover',
                    'type' => 'color',
                    'default' => '#e9a17b',
                    'validate' => 'color',
                    'title' => 'Primary Button Hover Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'primary-btn-colors-to-hover',
                    'type' => 'color',
                    'default' => '#ff7cb0',
                    'validate' => 'color',
                    'title' => 'Primary Button Hover Colors To',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'secondary-btn-colors-from',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Secondary Button Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'secondary-btn-colors-to',
                    'type' => 'color',
                    'default' => '#6245fe',
                    'validate' => 'color',
                    'title' => 'Secondary Button Colors To',
                    'transparent' => false
                ),

                array(
                    'id' => $opt_prefix . 'secondary-btn-colors-from-hover',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Secondary Button Hover Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'secondary-btn-colors-to-hover',
                    'type' => 'color',
                    'default' => '#6245fe',
                    'validate' => 'color',
                    'title' => 'Secondary Button Hover Colors To',
                    'transparent' => false
                ),

                array(
                    'id' => $opt_prefix . 'tertiary-btn-colors-from',
                    'type' => 'color',
                    'default' => '#f18cff',
                    'validate' => 'color',
                    'title' => 'Tertiary Button Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'tertiary-btn-colors-to',
                    'type' => 'color',
                    'default' => '#af46fc',
                    'validate' => 'color',
                    'title' => 'Tertiary Button Colors To',
                    'transparent' => false
                ),

                array(
                    'id' => $opt_prefix . 'tertiary-btn-colors-from-hover',
                    'type' => 'color',
                    'default' => '#f18cff',
                    'validate' => 'color',
                    'title' => 'Tertiary Button Hover Colors From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'tertiary-btn-colors-to-hover',
                    'type' => 'color',
                    'default' => '#af46fc',
                    'validate' => 'color',
                    'title' => 'Tertiary Button Hover Colors To',
                    'transparent' => false
                ),
            ),
        )
    );

    /**
     * Menu Settings ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Navigation Items', 'cynic'),
        'id' => 'menus',
        'desc' => __('These are really basic fields!', 'cynic'),
        'customizer_width' => '400px',
        'icon' => 'el el-th'
    ));

    /**
     * Logo
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Menu Colors', 'cynic'),
            'id' => 'menu-colors',
            'desc' => esc_html__('Menu Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'menu-colors',
                    'type' => 'color',
                    'default' => '#69798d',
                    'validate' => 'color',
                    'title' => 'Item Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'hover-colors',
                    'type' => 'color',
                    'default' => '#172b43',
                    'validate' => 'color',
                    'title' => 'Item Hover Colors',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'active-colors',
                    'type' => 'color',
                    'default' => '#172b43',
                    'validate' => 'color',
                    'title' => 'Item Active Color',
                    'transparent' => false
                ),
            ),)
    );

    /**
     * Header Top Button
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Menu Settings', 'cynic'),
        'id' => 'menu-spacing',
        'desc' => esc_html__('Menu Settings', 'cynic'),
        'icon' => 'el el-star-alt',
        'subsection' => true,
        'customizer_width' => '550px',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'menu-spacing',
                'type' => 'slider',
                'title' => __('Navigation Spacing', 'cynic'),
                'desc' => __('Set spacing between each menu item.', 'cynic'),
                "default" => 3,
                "min" => 1,
                "step" => 1,
                "max" => 6,
                'display_value' => 'label'
            )
        )
    ));


    /**
     * Link Colors
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Link Colors', 'cynic'),
            'id' => 'global-link-colors',
            'desc' => esc_html__('Set Link Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => false,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'link-colors',
                    'type' => 'color',
                    'default' => '#69798d',
                    'validate' => 'color',
                    'title' => 'Link Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'link-hover-colors-from',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Link Hover Color From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'link-hover-colors-to',
                    'type' => 'color',
                    'default' => '#6245fe',
                    'validate' => 'color',
                    'title' => 'Link Hover Color To',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'link-active-colors-from',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Link Active Color From',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'link-active-colors-to',
                    'type' => 'color',
                    'default' => '#6245fe',
                    'validate' => 'color',
                    'title' => 'Link Active Color To',
                    'transparent' => false
                )
            ),
        )
    );

    /**
     * Case Studies Block Colors
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Case Studies Colors', 'cynic'),
            'id' => 'case-studies-colors',
            'desc' => esc_html__('Set Colors for Case Study Block', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => false,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'cs-headline-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Headline Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'cs-body-text-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Set Case Study Body Text Color',
                    'transparent' => false
                )
            ),
        )
    );

    /**
     * Background Colors
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Background Colors', 'cynic'),
            'id' => 'background-colors',
            'desc' => esc_html__('Set Background Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => false,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'bg-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Main Background Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'shape-color',
                    'type' => 'color',
                    'default' => '#edf7ff',
                    'validate' => 'color',
                    'title' => 'Shape/Bubble Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'box-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Box Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'box-shadow-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Box Shadow Color',
                    'transparent' => false
                )
            ),
        )
    );

    /**
     * Footer ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Footer', 'cynic'),
        'id' => 'footer',
        'customizer_width' => '400px',
        'icon' => 'el el-twitter'
    ));

    /**
     * Footer Color Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Footer Colors', 'cynic'),
            'id' => 'footer-colors',
            'desc' => esc_html__('Set Footer Colors', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Headline Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'menu-text-color',
                    'type' => 'color',
                    'default' => '#9a9fff',
                    'validate' => 'color',
                    'title' => 'Menu/Text Color',
                    'transparent' => false
                ),

                array(
                    'id' => $opt_prefix . 'menu-text-hover-color',
                    'type' => 'color',
                    'default' => '#ff7cb0',
                    'validate' => 'color',
                    'title' => 'Menu/Text Hover Color',
                    'transparent' => false
                ),
//                array(
//                    'id' => $opt_prefix . 'menu-text-active-color',
//                    'type' => 'color',
//                    'default' => '#ff7cb0',
//                    'validate' => 'color',
//                    'title' => 'Menu/Text Active Color',
//                    'transparent' => false
//                ),
                array(
                    'id' => $opt_prefix . 'social-media-color',
                    'type' => 'color',
                    'default' => '#a6d1ed',
                    'validate' => 'color',
                    'title' => 'Social Media Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'footer-main-bg-color',
                    'type' => 'color',
                    'default' => '#172b43',
                    'validate' => 'color',
                    'title' => 'Main Background Color',
                    'transparent' => false
                ),
                array(
                    'id' => $opt_prefix . 'footer-bottom-bg-color',
                    'type' => 'color',
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'title' => 'Footer Bottom Background Color',
                    'transparent' => false
                )
            )
        )
    );

    /**
     * Footer Logo Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Logo', 'cynic'),
            'id' => 'footer-logo',
            'desc' => esc_html__('Set Footer Logo', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'footer_logo',
                    'type' => 'media',
                    'url' => true,
                    'title' => esc_html__('Footer Logo', 'cynic'),
                    'compiler' => 'true',
                    'default' => array('url' => CYNIC_THEME_URI . '/images/trendy-agency-footer-logo.png'),
                )
            )
        )
    );

    /**
     * Footer Menu Settings
     */

    Redux::setSection($opt_name, array(
            'title' => esc_html__('Footer Menu', 'cynic'),
            'id' => 'footer-menu',
            'desc' => esc_html__('Set One Page Footer Menu', 'cynic'),
            'icon' => 'el el-picture',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'onepage_privacy_link',
                    'type' => 'select',
                    'title' => esc_html__('Set Privacy Policy Page Link', 'cynic'),
                    'subtitle' => esc_html__('Set Privacy Policy Modal Page', 'cynic'),
                    'data' => 'pages',
                ),
                array(
                    'id' => $opt_prefix . 'onepage_terms_condition_link',
                    'type' => 'select',
                    'title' => esc_html__('Set Terms & Condition Page Link', 'cynic'),
                    'subtitle' => esc_html__('Set Terms & Condition Modal Page', 'cynic'),
                    'data' => 'pages',
                )
            )
        )
    );

    /**
     * Copyright
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Copyright', 'cynic'),
            'id' => 'footer-copyright',
            'desc' => esc_html__('Set Footer Copyright Setting', 'cynic'),
            'icon' => 'el el-pencil',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'footer_copyright_text',
                    'type' => 'textarea',
                    'title' => esc_html__('Copyright Text', 'cynic'),
                    'subtitle' => esc_html__('Please add copyright text for footer', 'cynic'),
                    'default' => '&copy; 2018. All rights reserved by Your Company LLC.',
                ),
            ),)
    );


    /**
     * Blog ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Blog', 'cynic'),
        'id' => 'blog',
        'customizer_width' => '400px',
        'icon' => 'el el-group'
    ));

    /**
     * General
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('General', 'cynic'),
            'id' => 'blog-general',
            'desc' => esc_html__('Set Blog General Settings', 'cynic'),
            'icon' => 'el el-globe-alt',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'blog_page_background_image',
                    'type' => 'media',
                    'title' => esc_html__('Banner Background Image', 'cynic'),
                    'subtitle' => esc_html__('Upload Blog Banner Image', 'cynic'),
                ),

                array(
                    'id' => $opt_prefix . 'blog_read_more_text',
                    'type' => 'text',
                    'title' => esc_html__('Read More Button Text', 'cynic'),
                    'subtitle' => esc_html__('Set Blog Read MOre Text', 'cynic'),
                    'default' => esc_html__('Read More', 'cynic'),
                ),

                array(
                    'id' => $opt_prefix . 'author_info',
                    'type' => 'switch',
                    'title' => esc_html__('Display Author Info', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable author info section', 'cynic'),
                    'default' => false,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'blog_sidebar',
                    'type' => 'switch',
                    'title' => esc_html__('Blog Sidebar', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable sidebar', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'blog_single_sidebar',
                    'type' => 'switch',
                    'title' => esc_html__('Blog Single Page Sidebar', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable sidebar', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
            ),)
    );

    /**
     * Comments
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Comments', 'cynic'),
            'id' => 'blog-Comments',
            'desc' => esc_html__('Set Blog Comment Settings', 'cynic'),
            'icon' => 'el el-group',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'blog_comment_section',
                    'type' => 'switch',
                    'title' => esc_html__('Show Comment Section in Blog', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable comment section in blog', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

            ),)
    );

    /**
     * Social
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Social', 'cynic'),
            'id' => 'blog-social-shared',
            'desc' => esc_html__('Set Blog Social Settings', 'cynic'),
            'icon' => 'el el-twitter',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'display_blog_social_share',
                    'type' => 'switch',
                    'title' => esc_html__('Display Social Share Section in Blog', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable social share section in blog', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'blog_social_share_titletext',
                    'type' => 'text',
                    'title' => esc_html__('Social Share Section Title Text', 'cynic'),
                    'subtitle' => esc_html__('Social share section Title text', 'cynic'),
                    'default' => 'Share:',
                    'required' => array($opt_prefix . 'display_blog_social_share', '=', '1')
                ),
            ),)
    );

    /**
     * Previous & Next
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Previous & Next', 'cynic'),
        'id' => 'blog-next-previous',
        'desc' => esc_html__('Set Blog Previous & Next Settings', 'cynic'),
        'icon' => 'el el-forward',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(


            array(
                'id' => $opt_prefix . 'blog_prev_next_botton',
                'type' => 'switch',
                'title' => esc_html__('Display Prev & Next Button', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable Prev & Next button', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),

            array(
                'id' => $opt_prefix . 'blog_prev_button_text',
                'type' => 'text',
                'title' => esc_html__('Previous Button Text', 'cynic'),
                'subtitle' => esc_html__('Please enter previous button text', 'cynic'),
                'default' => '<i class="ml-symone-67-arrow-left-right-up-down-increase-decrease"></i>Prev',
                'required' => array($opt_prefix . 'blog_prev_next_botton', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'blog_next_button_text',
                'type' => 'text',
                'title' => esc_html__('Next Button Text', 'cynic'),
                'subtitle' => esc_html__('Please enter Next button text', 'cynic'),
                'default' => 'Next<i class="ml-symone-68-arrow-left-right-up-down-increase-decrease"></i>',
                'required' => array($opt_prefix . 'blog_prev_next_botton', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'blog_prev_next_button_separator_sign',
                'type' => 'text',
                'title' => esc_html__('Button Separator Sign', 'cynic'),
                'subtitle' => esc_html__('Button separator sign', 'cynic'),
                'default' => '|',
                'required' => array($opt_prefix . 'blog_prev_next_botton', '=', '1'),
            ),
        )
    ));

    /**
     * Page ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Page', 'cynic'),
        'id' => 'page',
        'customizer_width' => '400px',
        'icon' => 'el el-cog'
    ));

    /**
     * Comments
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Comments', 'cynic'),
            'id' => 'page-comments',
            'desc' => esc_html__('Set Page Comment Settings', 'cynic'),
            'icon' => 'el el-group',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'page_comment_section',
                    'type' => 'switch',
                    'title' => esc_html__('Show Comment in Page', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable Comment section in page', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

            ),)
    );

    /**
     * 404 page
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('404 page', 'cynic'),
        'id' => 'page-404-page',
        'desc' => esc_html__('Set 404 Page Settings', 'cynic'),
        'icon' => 'el el-warning-sign',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(

            array(
                'id' => $opt_prefix . '404_page_error_code_text',
                'type' => 'text',
                'title' => esc_html__('404 Page Error Code', 'cynic'),
                'subtitle' => esc_html__('Please enter 404 page error code text', 'cynic'),
                'default' => esc_html__('404', 'cynic'),
            ),

            array(
                'id' => $opt_prefix . '404_page_title_text',
                'type' => 'text',
                'title' => esc_html__('404 Page Title', 'cynic'),
                'subtitle' => esc_html__('Please enter 404 page title text', 'cynic'),
                'default' => esc_html__('oops! Page not Found', 'cynic'),
            ),

            array(
                'id' => $opt_prefix . '404_page_sub_title_text',
                'type' => 'text',
                'title' => esc_html__('404 Page Sub Title', 'cynic'),
                'subtitle' => esc_html__('Please enter 404 page sub title text', 'cynic'),
                'default' => esc_html__('It\'s gone but it\'s not the end of the world!', 'cynic'),
            ),

            array(
                'id' => $opt_prefix . '404_page_button_text',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'cynic'),
                'default' => esc_html__('Go Back Home', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . '404_button_link',
                'type' => 'select',
                'title' => esc_html__('Select Pages', 'cynic'),
                'data' => 'pages',
            ),
            array(
                'id' => $opt_prefix . '404_page_background_image',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'cynic'),
                'subtitle' => esc_html__('Please add a image for 404 page background', 'cynic'),
            ),

            array(
                'id' => $opt_prefix . '404_page_image1',
                'type' => 'media',
                'title' => esc_html__('Image 1', 'cynic'),
                'subtitle' => esc_html__('Please add a image for 404 page', 'cynic'),
            ),

            array(
                'id' => $opt_prefix . '404_page_image2',
                'type' => 'media',
                'title' => esc_html__('Image 2', 'cynic'),
                'subtitle' => esc_html__('Please add a image for 404 page', 'cynic'),
            ),
        ),
    ));


    /**
     * Search ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Search', 'cynic'),
        'id' => 'search',
        'customizer_width' => '400px',
        'icon' => 'el el-search'
    ));

    /**
     * Search banner
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Banner', 'cynic'),
            'id' => 'search-banner',
            'desc' => esc_html__('Set Search Page banner Settings', 'cynic'),
            'icon' => 'el el-photo',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'header_search_banner',
                    'type' => 'switch',
                    'title' => esc_html__('Display Header Banner', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable search box banner in header', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
                array(
                    'id' => $opt_prefix . 'search_result_banner',
                    'type' => 'media',
                    'title' => esc_html__('Banner Image', 'cynic'),
                    'subtitle' => esc_html__('Please add a banner image for result search page', 'cynic'),
                    'default' => array('url' => CYNIC_THEME_URI . '/images/search-result-banner-image.jpg'),
                    'required' => array($opt_prefix . 'header_search_banner', '=', '1'),
                ),
                array(
                    'id' => $opt_prefix . 'search_banner_text',
                    'type' => 'text',
                    'title' => esc_html__('Banner Text', 'cynic'),
                    'subtitle' => esc_html__('Please enter banner text', 'cynic'),
                    'default' => 'search results for:'
                ),
            ),)
    );
    /**
     * Search Results
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Results', 'cynic'),
        'id' => 'search-results',
        'desc' => esc_html__('Set Search Page Results Settings', 'cynic'),
        'icon' => 'el el-list-alt',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__('Show Result Per Row', 'cynic'),
                'id' => $opt_prefix . 'search_result_show_per_row',
                'type' => 'select',
                'subtitle' => esc_html__('Please define search result per row', 'cynic'),
                'options' => array(
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                ),
                'default' => '4'
            ),
            array(
                'id' => $opt_prefix . 'search_button_text',
                'type' => 'text',
                'title' => esc_html__('No Results Button Text', 'cynic'),
                'subtitle' => esc_html__('Please enter banner text for no results found button', 'cynic'),
                'default' => 'Contact Us'
            ),


            array(
                'id' => $opt_prefix . 'no_result_text',
                'type' => 'editor',
                'title' => esc_html__('No Results Found Text', 'cynic'),
                'subtitle' => esc_html__('Please enter text to display when no results found', 'cynic'),
                'default' => 'No results found! Maybe we can help.'
            ),
            array(
                'id' => $opt_prefix . 'search_button_link',
                'type' => 'select',
                'title' => esc_html__('Select Pages', 'cynic'),
                'data' => 'pages',
            ),

        ),
    ));


    /**
     * Typography ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('Typography', 'cynic'),
        'id' => 'typography',
        'customizer_width' => '400px',
        'icon' => 'el el-text-height'
    ));

    /**
     * Body font
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Fonts', 'cynic'),
            'id' => 'typography-fonts',
            'desc' => esc_html__('Set Typography Body Font Settings', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'title' => esc_html__('Headline Font', 'cynic'),
                    'id' => $opt_prefix . 'headline-font',
                    'type' => 'select',
                    'subtitle' => esc_html__('Specify the headline font.', 'cynic'),
                    'options' => $googleFonts,
                    'default' => 'Fira Sans, sans-serif'
                ),

                array(
                    'title' => esc_html__('Body Font', 'cynic'),
                    'id' => $opt_prefix . 'body-font',
                    'type' => 'select',
                    'subtitle' => esc_html__('Specify the body font.', 'cynic'),
                    'options' => $googleFonts,
                    'default' => 'Hind Vadodara, sans-serif'
                ),
            ))
    );

    /**
     * Headline 1 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 1', 'cynic'),
            'id' => 'typography-headline1',
            'desc' => esc_html__('Headiline 1', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline1-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 6,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline1-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline1-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading1-font-color',
                    'class' => 'section_heading',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline1 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Headline 2 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 2', 'cynic'),
            'id' => 'typography-headline2',
            'desc' => esc_html__('Headiline 2', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline2-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 4.8,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline2-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline2-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading2-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline2 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Headline 3 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 3', 'cynic'),
            'id' => 'typography-headline3',
            'desc' => esc_html__('Headiline 3', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline3-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 3.6,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline3-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline3-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading3-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline3 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Headline 4 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 4', 'cynic'),
            'id' => 'typography-font-headline4',
            'desc' => esc_html__('Headiline 4', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline4-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 3,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline4-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline4-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading4-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline4 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Headline 5 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 5', 'cynic'),
            'id' => 'typography-font-headline5',
            'desc' => esc_html__('Headiline 5', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline5-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 2.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline5-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline5-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading5-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline5 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Headline 6 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Headline 6', 'cynic'),
            'id' => 'typography-font-headline6',
            'desc' => esc_html__('Headiline 6', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'headline6-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 1.8,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'headline6-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'headline6-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 1.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'heading6-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the headline6 color.', 'cynic'),
                    'default' => '#172b43',
                    'transparent' => false
                ),
            ))
    );


    /**
     * Body 1 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Body 1', 'cynic'),
            'id' => 'typography-body1',
            'desc' => esc_html__('Body 1', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'body1-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 2.4,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'body1-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'body1-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 3,
                    "min" => 4,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'body1-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the body1 color.', 'cynic'),
                    'default' => '#485768',
                    'transparent' => false
                ),
            ))
    );


    /**
     * Body 2 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Body 2', 'cynic'),
            'id' => 'typography-body2',
            'desc' => esc_html__('Body 2', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'body2-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 1.8,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'body2-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'body2-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 3,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'body2-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the body2 color.', 'cynic'),
                    'default' => '#69798d',
                    'transparent' => false
                ),
            ))
    );

    /**
     * Body 3 Settings
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Body 3', 'cynic'),
            'id' => 'typography-body3',
            'desc' => esc_html__('Body 3', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'body3-font-size',
                    'type' => 'slider',
                    'title' => esc_html__('Font Size', 'cynic'),
                    'desc' => __('Set font size.', 'cynic'),
                    "default" => 1.6,
                    "min" => 1,
                    "step" => .1,
                    "max" => 100,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Size In', 'cynic'),
                    'id' => $opt_prefix . 'body3-font-size-in',
                    'class' => 'section_heading',
                    'type' => 'button_set',
                    'options' => array(
                        'rem' => 'rem',
                        'px' => 'px',
                        'em' => 'em',
                        '%' => '%',
                    ),
                    'default' => 'rem'
                ),
                array(
                    'id' => $opt_prefix . 'body3-line-height',
                    'type' => 'slider',
                    'title' => esc_html__('Line Height', 'cynic'),
                    'desc' => __('Set line height.', 'cynic'),
                    "default" => 2.8,
                    "min" => 1,
                    "step" => .1,
                    "max" => 6,
                    'resolution' => 0.1,
                    'display_value' => 'text'
                ),
                array(
                    'title' => esc_html__('Font Color', 'cynic'),
                    'id' => $opt_prefix . 'body3-font-color',
                    'type' => 'color',
                    'subtitle' => esc_html__('Specify the body3 color.', 'cynic'),
                    'default' => '#69798d',
                    'transparent' => false
                ),
            ))
    );

    /**
     * General Settings ###############################################################
     */
    Redux::setSection($opt_name, array(
        'title' => __('General Settings', 'cynic'),
        'id' => 'general_settings',
        'customizer_width' => '400px',
        'icon' => 'el el-ok-circle'
    ));

    /**
     * Theme Mode
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Theme Layout', 'cynic'),
            'id' => 'general_settings-theme-layout',
            'desc' => esc_html__('Set Layout Settings', 'cynic'),
            'icon' => 'el el-ok-circle',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'title' => esc_html__('Layout Settings', 'cynic'),
                    'id' => $opt_prefix . 'layouts',
                    'type' => 'radio',
                    'subtitle' => __('Select Layout Of your theme', 'cynic'),
                    'options' => array(
                        '1' => 'Multipage Layout',
                        '2' => 'Onepage Layout',
                    ),
                    'default' => '1'
                )
            ))
    );

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Global Settings', 'cynic'),
        'id' => 'general_settings-global-settings',
        'desc' => esc_html__('Set Theme Global Settings', 'cynic'),
        'icon' => 'el el-network',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__('Header Banner Mode', 'cynic'),
                'id' => $opt_prefix . 'header_banner_mode',
                'type' => 'button_set',
                'subtitle' => __('Select Layout Of Header Banner', 'cynic'),
                'options' => array(
                    '1' => 'Background Image',
                    '2' => 'Banner with Image',
                ),
                'default' => '1'
            ),

            array(
                'id' => $opt_prefix . 'related_posts',
                'type' => 'switch',
                'title' => esc_html__('Display Related Posts', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable related posts section', 'cynic'),
                'default' => false,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),

            array(
                'id' => $opt_prefix . 'pre_loader',
                'type' => 'switch',
                'title' => esc_html__('Display Loader', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable Loader', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),

            array(
                'id' => $opt_prefix . 'default_img',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Default Image', 'cynic'),
                'subtitle' => esc_html__('A default image for missing image', 'cynic'),
                'default' => array('url' => CYNIC_THEME_URI . '/images/default-image.png'),
            ),
        )));

    Redux::setSection($opt_name, array(
            'title' => esc_html__('Breadcrumb', 'cynic'),
            'id' => 'general_settings-breadcrumb',
            'desc' => esc_html__('Set Breadcrumb Settings', 'cynic'),
            'icon' => 'el el-link',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'is_enabled_breadcrumb',
                    'type' => 'switch',
                    'title' => esc_html__('Is Enabled Breadcrumb', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable Breadcrumb', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'breadcrumb_home_title',
                    'type' => 'text',
                    'title' => esc_html__('Breadcrumb Home Title', 'cynic'),
                    'subtitle' => esc_html__('Please enter breadcrumb Home title', 'cynic'),
                    'default' => 'Home',
                    'required' => array($opt_prefix . 'is_enabled_breadcrumb', '=', '1')
                ),

                array(
                    'id' => $opt_prefix . 'breadcrumb_blog_title',
                    'type' => 'text',
                    'title' => esc_html__('Breadcrumb Blog Title', 'cynic'),
                    'subtitle' => esc_html__('Please enter breadcrumb Blog title', 'cynic'),
                    'default' => 'Blog',
                    'required' => array($opt_prefix . 'is_enabled_breadcrumb', '=', '1')
                ),

                array(
                    'id' => $opt_prefix . 'breadcrumb_separator',
                    'type' => 'text',
                    'title' => esc_html__('Breadcrumb Separator', 'cynic'),
                    'subtitle' => esc_html__('Please enter breadcrumb Separator', 'cynic'),
                    'default' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'required' => array($opt_prefix . 'is_enabled_breadcrumb', '=', '1')
                ),
            ))
    );
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Social Media', 'cynic'),
        'id' => 'general_settings-social',
        'desc' => esc_html__('Set Site Social Media Settings', 'cynic'),
        'icon' => 'el el-twitter',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'footer_media_facebook',
                'type' => 'text',
                'title' => esc_html__('Facebook', 'cynic'),
                'subtitle' => esc_html__('Please facebook link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_twitter',
                'type' => 'text',
                'title' => esc_html__('Twitter', 'cynic'),
                'subtitle' => esc_html__('Please twitter link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_google_plus',
                'type' => 'text',
                'title' => esc_html__('Google Plus', 'cynic'),
                'subtitle' => esc_html__('Please add google plus link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_instagram',
                'type' => 'text',
                'title' => esc_html__('Instagram', 'cynic'),
                'subtitle' => esc_html__('Please add instagram link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_pinterest',
                'type' => 'text',
                'title' => esc_html__('Pinterest', 'cynic'),
                'subtitle' => esc_html__('Please add pinterest link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_linkedin',
                'type' => 'text',
                'title' => esc_html__('Linkedin', 'cynic'),
                'subtitle' => esc_html__('Please add linkedin link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'footer_media_youtube',
                'type' => 'text',
                'title' => esc_html__('Youtube', 'cynic'),
                'subtitle' => esc_html__('Please add youtube link.', 'cynic'),
                'default' => '#',
            ),
        )
    ));

    return;
} else {
    if (!is_admin()) {
        $opt_prefix = CYNIC_PREFIX;
        $cynic_options = array(
            $opt_prefix . 'site_logo' => CYNIC_THEME_URI . '/images/trendy-agency-logo.png',
            $opt_prefix . 'is_header_button_open_with_modal' => true,

            $opt_prefix . '404_error' => array('url' => CYNIC_THEME_URI . '/images/404-error.png'),

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
}


