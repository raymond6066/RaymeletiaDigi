<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (class_exists('Redux')) {

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
    /*
     * ---> END ARGUMENTS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

      As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
    $opt_prefix = 'cynic_';
// -> START Basic Fields
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Header', 'cynic'),
        'id' => 'header',
        'desc' => esc_html__('Set Header Options', 'cynic'),
        'icon' => 'el el-cog',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'top_bar',
                'type' => 'switch',
                'url' => true,
                'title' => esc_html__('Hide Top Bar', 'cynic'),
                'default' => TRUE,
                'on' => 'Hide',
                'off' => 'Show',
            ),
            array(
                'id' => $opt_prefix . 'site_logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Site Logo', 'cynic'),
                'compiler' => 'true',
                'default' => array('url' => CYNIC_THEME_URI . '/images/classic-logo.png'),
            ),
            array(
                'id' => $opt_prefix . 'menu',
                'type' => 'switch',
                'title' => esc_html__('Cynic Menu', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable Menus', 'cynic'),
                'default' => TRUE,
                'on' => 'Normal Menu',
                'off' => 'Mega Menu',
            ),
            array(
                'id' => $opt_prefix . 'sticky_header',
                'type' => 'switch',
                'title' => esc_html__('Disable Sticky Header', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable sticky header', 'cynic'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => $opt_prefix . 'header_media_facebook',
                'type' => 'text',
                'title' => esc_html__('Facebook', 'cynic'),
                'subtitle' => esc_html__('Please facebook link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_twitter',
                'type' => 'text',
                'title' => esc_html__('Twitter', 'cynic'),
                'subtitle' => esc_html__('Please twitter link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_google_plus',
                'type' => 'text',
                'title' => esc_html__('Google Plus', 'cynic'),
                'subtitle' => esc_html__('Please add google plus link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_instagram',
                'type' => 'text',
                'title' => esc_html__('Instagram', 'cynic'),
                'subtitle' => esc_html__('Please add instagram link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_pinterest',
                'type' => 'text',
                'title' => esc_html__('Pinterest', 'cynic'),
                'subtitle' => esc_html__('Please add pinterest link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_linkedin',
                'type' => 'text',
                'title' => esc_html__('Linkedin', 'cynic'),
                'subtitle' => esc_html__('Please add linkedin link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_media_youtube',
                'type' => 'text',
                'title' => esc_html__('Youtube', 'cynic'),
                'subtitle' => esc_html__('Please add youtube link', 'cynic'),
                'default' => '#',
            ),
            array(
                'id' => $opt_prefix . 'header_telno',
                'type' => 'text',
                'title' => esc_html__('Set telephone no on header', 'cynic'),
                'subtitle' => esc_html__('Set telephone number on header', 'cynic'),
                'default' => esc_html__('012.345.1234', 'cynic')
            ),
            array(
                'id' => $opt_prefix . 'header_email',
                'type' => 'text',
                'title' => esc_html__('Set email address on header', 'cynic'),
                'subtitle' => esc_html__('Set email address on header', 'cynic'),
                'default' => esc_html__('info@company.com', 'cynic'),
                'validate' => 'email'
            ),
            array(
                'id' => $opt_prefix . 'feature_modal_button',
                'type' => 'switch',
                'title' => esc_html__('Feature Modal In Header', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable feature modal in header', 'cynic'),
                'default' => false,
                'on' => esc_html__('Enabled', 'cynic'),
                'off' => esc_html__('Disabled', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'feature_modal_button_text',
                'type' => 'text',
                'title' => esc_html__('Set Feature Modal Button Text', 'cynic'),
                'subtitle' => esc_html__('Set Feature Modal Button Text', 'cynic'),
                'default' => esc_html__('GET A QUOTE', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'feature_modal_page',
                'type' => 'select',
                'title' => esc_html__('Set Feature Modal Page', 'cynic'),
                'subtitle' => esc_html__('Set Feature Modal Page', 'cynic'),
                'data' => 'pages',
            ),
            array(
                'id' => $opt_prefix . 'onepage_map_link',
                'type' => 'text',
                'title' => esc_html__('Set Internal Link for Onepage', 'cynic'),
                'subtitle' => esc_html__('Internal link could be any link throught the site', 'cynic'),
                'default' => esc_html__('#map', 'cynic'),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Footer', 'cynic'),
        'id' => 'footer',
        'desc' => esc_html__('Set Footer Options', 'cynic'),
        'icon' => 'el el-cog',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'scroll_to_top',
                'type' => 'switch',
                'title' => esc_html__('Display Scroll To Top', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable scroll to top', 'cynic'),
                'default' => false,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'display_footer_subscribe',
                'type' => 'switch',
                'title' => esc_html__('Display Subscriber Section', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable subscriber section', 'cynic'),
                'default' => false,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'footer_subscribe_text',
                'type' => 'editor',
                'title' => esc_html__('Subscriber Section HTML', 'cynic'),
                'subtitle' => esc_html__('Subscriber section custom html markup. Shortcodes supported.', 'cynic'),
                'default' => '',
            ),
            array(
                'id' => $opt_prefix . 'footer_google_api',
                'type' => 'textarea',
                'title' => esc_html__('Google Map Api Key', 'cynic'),
                'subtitle' => esc_html__('Please add google map api key to load onepage map', 'cynic'),
                'default' => '',
            ),
            array(
                'id' => $opt_prefix . 'onepage_footer_copyright',
                'type' => 'textarea',
                'title' => esc_html__('Onepage Copyright Text', 'cynic'),
                'subtitle' => esc_html__('Please add compyright text for onepage footer', 'cynic'),
                'default' => '',
            ),
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
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Blog', 'cynic'),
        'id' => 'blog',
        'desc' => esc_html__('Set Blog Options', 'cynic'),
        'icon' => 'el el-cog',
        'fields' => array(
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
                'id' => $opt_prefix . 'related_posts',
                'type' => 'switch',
                'title' => esc_html__('Display Related Posts', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable related posts section', 'cynic'),
                'default' => false,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'sidebar',
                'type' => 'switch',
                'title' => esc_html__('Hide Sidebar', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable sidebar', 'cynic'),
                'default' => false,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'comment_section',
                'type' => 'switch',
                'title' => esc_html__('Comments section', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable comment section', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'comment_in_page',
                'type' => 'switch',
                'title' => esc_html__('Show Comments in page', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable comment in page', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Search', 'cynic'),
        'id' => 'search',
        'desc' => esc_html__('Set Search Options', 'cynic'),
        'icon' => 'el el-cog',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'header_search',
                'type' => 'switch',
                'title' => esc_html__('Search box in header', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable search box in header', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),
            array(
                'id' => $opt_prefix . 'search_result_banner',
                'type' => 'media',
                'title' => esc_html__('Banner image', 'cynic'),
                'subtitle' => esc_html__('Please add a banner image for result search page', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'search_banner_text',
                'type' => 'text',
                'title' => esc_html__('Banner text', 'cynic'),
                'subtitle' => esc_html__('Please enter banner text', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'no_result_text',
                'type' => 'editor',
                'title' => esc_html__('No results found text', 'cynic'),
                'subtitle' => esc_html__('Please enter text to display when no results found', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'search_burron_text',
                'type' => 'text',
                'title' => esc_html__('No results button text', 'cynic'),
                'subtitle' => esc_html__('Please enter banner text for no results found button', 'cynic'),
            ),
            array(
                'id' => $opt_prefix . 'search_burron_link',
                'type' => 'select',
                'title' => esc_html__('Select Pages', 'cynic'),
                'data' => 'pages',
            ),
        ),
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('Typography', 'cynic'),
        'id' => 'typography',
        'desc' => esc_html__('Set Typography Options', 'cynic'),
        'icon' => 'el el-fontsize',
        'fields' => array(
            array(
                'id' => $opt_prefix . 'body_font',
                'type' => 'typography',
                'title' => esc_html__('Body Font', 'cynic'),
                'subtitle' => esc_html__('Specify the body font properties.', 'cynic'),
                'google' => true,
                'color' => false,
                'subsets' => false,
                'text-align' => false,
                'font-weight' => false,
                'line-height' => false,
                'default' => array(
                    'font-size' => '16px',
                    'font-family' => 'Open Sans',
                ),
            ),
            array(
                'id' => $opt_prefix . 'headings_font',
                'type' => 'typography',
                'title' => esc_html__('Headings Font', 'cynic'),
                'subtitle' => esc_html__('Specify the headings font properties.', 'cynic'),
                'google' => true,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'default' => array(
                    'font-family' => 'Raleway',
                ),
            ),
            array(
                'id' => $opt_prefix . 'menu_font',
                'type' => 'typography',
                'title' => esc_html__('Main Menu Font', 'cynic'),
                'subtitle' => esc_html__('Specify the main menu font properties.', 'cynic'),
                'google' => true,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'font-size' => true,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'default' => array(
                    'font-family' => 'Open Sans',
                    'font-size' => '16px',
                ),
            ),
        )
    ));

    Redux::setSection($opt_name, array(
        'title' => esc_html__('General Settings', 'cynic'),
        'id' => 'general_settings',
        'desc' => esc_html__('General Setting Options', 'cynic'),
        'icon' => 'el el-cog',
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
            ),
            array(
                'title' => esc_html__('Theme Mode', 'cynic'),
                'id' => $opt_prefix . 'theme_mode',
                'type' => 'radio',
                'subtitle' => __('Select Layout Of your theme', 'cynic'),
                'options' => array(
                    '1' => 'Unit Test Mode',
                    '2' => 'Website Mode',
                ),
                'default' => '1'
            ),
        )
    ));
} else {
    $opt_prefix = 'cynic_';
    $cynic_options = array(
        $opt_prefix . 'site_logo' => array('url' => CYNIC_THEME_URI . '/images/classic-logo.png'),
        $opt_prefix . 'sticky_header' => TRUE,
        $opt_prefix . 'menu' => TRUE,
        $opt_prefix . 'top_bar' => TRUE,
        $opt_prefix . 'theme_mode' => '1',
        $opt_prefix . 'header_search' => true,
        $opt_prefix . 'feature_modal_button' => false,
        $opt_prefix . 'feature_modal_page' => '',
        $opt_prefix . 'feature_modal_button_text' => esc_html__('GET A QUOTE', 'cynic'),
        $opt_prefix . 'scroll_to_top' => false,
        $opt_prefix . 'author_info' => false,
        $opt_prefix . 'related_posts' => false,
        $opt_prefix . 'header_telno' => esc_html__('012.345.1234', 'cynic'),
        $opt_prefix . 'header_email' => esc_html__('info@company.com', 'cynic'),
        $opt_prefix . 'display_footer_subscribe' => false,
        $opt_prefix . 'display_default_footer' => TRUE,
        $opt_prefix . 'footer_subscribe_text' => '',
        $opt_prefix . 'body_font' => array(
            'font-size' => '16px',
            'font-family' => 'Open Sans',
        ),
        $opt_prefix . 'headings_font' => array(
            'font-family' => 'Raleway',
        ),
        $opt_prefix . 'menu_font' => array(
            'font-family' => 'Open Sans',
            'font-size' => '14px',
        ),

    );
}