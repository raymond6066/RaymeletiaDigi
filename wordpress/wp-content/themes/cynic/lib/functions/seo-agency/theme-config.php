<?php
if (!defined('ABSPATH')) {
    die('No script hack please');
}
/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (class_exists('Redux')) {

    $__pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
    $__pagearr = array(
        'blog-single' => 'Blog Details',
        'case-study-details' => 'Case Study Details',
        'career-details' => 'Career Details'
    );
    if ($__pages && !is_wp_error($__pages)) {
        foreach ($__pages as $__page) {
            $__pagearr[$__page->post_name] = $__page->post_title;
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
            'desc' => esc_html__('Set Header Site logo (Header and Footer logo)', 'cynic'),
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
                    'default' => array('url' => CYNIC_THEME_URI . '/images/brand-logo.png'),
                ),
            ),)
    );

    /**
     * Menu
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Menu', 'cynic'),
            'id' => 'header-menu',
            'desc' => esc_html__('Menu', 'cynic'),
            'icon' => 'el el-th',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'title' => esc_html__('Menu Dropdown Type', 'cynic'),
                    'id' => $opt_prefix . 'header_menu_dropdown_type',
                    'type' => 'button_set',
                    'subtitle' => __('Select Menu Dropdown Open Type', 'cynic'),
                    'options' => array(
                        '1' => 'On Mouse Click',
                        '2' => 'On Mouse Hover',
                    ),
                    'default' => '1'
                ),
                array(
                    'id' => $opt_prefix . 'header_menu_layout',
                    'type' => 'select_image',
                    'title' => __('Select Menu Layout', 'cynic'),
                    'placeholder' => 'Select Menu Layout',
                    'options' => array(
                        array(
                            'alt' => 'Classic Menu',
                            'img' => CYNIC_THEME_URI . '/images/menu_layouts/menu_with_top_menu.png',
                        ),
                        array(
                            'alt' => 'Modern Menu',
                            'img' => CYNIC_THEME_URI . '/images/menu_layouts/menu_without_top_menu.png',
                        ),
                    ),
                    'default' => CYNIC_THEME_URI . '/images/menu_layouts/menu_without_top_menu.png',
                ),

                array(
                    'id' => $opt_prefix . 'header_top_menu_icon',
                    'type' => 'text',
                    'title' => esc_html__('Top / Mobile Menu Icon', 'cynic'),
                    'subtitle' => esc_html__('Leave empty if you want to theme default icon', 'cynic'),
                    'class' => 'cynicIconsPicker',
                ),

                array(
                    'id' => $opt_prefix . 'header_top_menu_icon_font_size',
                    'type' => 'dimensions',
                    'units' => array('em', 'px', '%'),    // You can specify a unit value. Possible: px, em, %
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title' => esc_html__('Top / Mobile Menu Icon Font Size', 'cynic'),
                    'subtitle' => esc_html__('Specify the Top Menu font size.', 'cynic'),
                    'height' => false,
                    'default' => array(
                        'width' => 24,
                    )
                ),

                array(
                    'id' => $opt_prefix . 'header_top_menu_social',
                    'type' => 'switch',
                    'title' => esc_html__('Display Top Menu Social Media', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable top menu Social Media', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                    'required' => array($opt_prefix . 'header_menu_layout', '=', CYNIC_THEME_URI . '/images/menu_layouts/menu_with_top_menu.png'),
                ),

            ),)
    );

    /**
     * Telephone
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Telephone', 'cynic'),
            'id' => 'header-telephone',
            'desc' => esc_html__('Set Header Telephone Settings', 'cynic'),
            'icon' => 'el el-phone',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'header_telephone_number_display',
                    'type' => 'switch',
                    'title' => esc_html__('Display Telephone Number', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable display telephone number', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'header_telno',
                    'type' => 'text',
                    'title' => esc_html__('Set Telephone Number', 'cynic'),
                    'subtitle' => esc_html__('Set telephone number', 'cynic'),
                    'default' => '(702) 145 5847',
                    'required' => array($opt_prefix . 'header_telephone_number_display', '=', '1'),
                ),

                array(
                    'id' => $opt_prefix . 'header_tel_icon',
                    'type' => 'text',
                    'class' => 'cynicIconsPicker',
                    'title' => esc_html__('Set Telephone Icon', 'cynic'),
                    'subtitle' => esc_html__('Set telephone no Icon on header', 'cynic'),
                    'default' => esc_html__('icon-Phone', 'cynic'),
                    'required' => array($opt_prefix . 'header_telephone_number_display', '=', '1'),

                ),

                array(
                    'id' => $opt_prefix . 'header_tel_icon_font_size',
                    'type' => 'dimensions',
                    'units' => array('em', 'px', '%'),    // You can specify a unit value. Possible: px, em, %
                    'units_extended' => 'true',  // Allow users to select any type of unit
                    'title' => esc_html__('Telephone Icon Font Size', 'cynic'),
                    'subtitle' => esc_html__('Specify the telephone font size.', 'cynic'),
                    'height' => false,
                    'default' => array(
                        'width' => 20,
                    ),
                    'required' => array($opt_prefix . 'header_telephone_number_display', '=', '1'),
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
                'default' => esc_html__('Free SEO Audit', 'cynic'),
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'header_button_page',
                'type' => 'select',
                'title' => esc_html__('Set Header Button Page', 'cynic'),
                'subtitle' => esc_html__('Set header button Page', 'cynic'),
                'data' => 'pages',
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
            ),


            array(
                'id' => $opt_prefix . 'is_header_button_open_with_modal',
                'type' => 'switch',
                'title' => esc_html__('Open With Modal?', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable open with modal', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
                'required' => array($opt_prefix . 'header_button_display', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'header_modal_title',
                'type' => 'switch',
                'type' => 'text',
                'title' => esc_html__('Modal Header Title', 'cynic'),
                'subtitle' => esc_html__('Set Modal Header Title', 'cynic'),
                'default' => esc_html__('Tell Us About Your Project', 'cynic'),
                'required' => array($opt_prefix . 'is_header_button_open_with_modal', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'header_modal_close_text',
                'type' => 'switch',
                'type' => 'text',
                'title' => esc_html__('Modal Close Text', 'cynic'),
                'subtitle' => esc_html__('Set Modal Close Text', 'cynic'),
                'default' => esc_html__('Close', 'cynic'),
                'required' => array($opt_prefix . 'is_header_button_open_with_modal', '=', '1'),
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
                'required' => array($opt_prefix . 'is_header_button_open_with_modal', '=', '0')
            ),

        )
    ));

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
     * Header Top Button
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
                    'default' => array('url' => CYNIC_THEME_URI . '/images/cynic-seo-logo_footer.png'),
                ),
            ),)
    );

    /**
     * Scroll Top Button
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Scroll Top', 'cynic'),
            'id' => 'footer-top-scroll',
            'desc' => esc_html__('Set Footer Scroll Setting', 'cynic'),
            'icon' => 'el el-chevron-up',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'scroll_to_top',
                    'type' => 'switch',
                    'title' => esc_html__('Display Scroll To Top', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable scroll to top', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
            ),)
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
                    'default' => '&copy; 2018 All rights reserved by Your Company',
                ),
            ),)
    );

    /**
     * Link Menu
     */
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Link Menu', 'cynic'),
            'id' => 'footer-link-menu',
            'desc' => esc_html__('Set Footer Privancy Policy and Terms & Condtion', 'cynic'),
            'icon' => 'el el-link',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(

                array(
                    'id' => $opt_prefix . 'footer_pp_n_tnc_bar_show',
                    'type' => 'switch',
                    'title' => esc_html__('Display Bottom Menu Bar', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable Privancy and T&C Menu', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'privacy_policy_link_text',
                    'type' => 'text',
                    'title' => esc_html__('Set Privacy Policy Page Link Text', 'cynic'),
                    'subtitle' => esc_html__('Set Privacy Policy Page Link text', 'cynic'),
                    'default' => esc_html__('Privacy Policy', 'cynic'),
                    'required' => array($opt_prefix . 'footer_pp_n_tnc_bar_show', '=', '1')
                ),

                array(
                    'id' => $opt_prefix . 'privacy_policy_link',
                    'type' => 'select',
                    'title' => esc_html__('Set Privacy Policy Page Link', 'cynic'),
                    'subtitle' => esc_html__('Set Privacy Policy Page Link', 'cynic'),
                    'data' => 'pages',
                    'required' => array($opt_prefix . 'footer_pp_n_tnc_bar_show', '=', '1')

                ),

                array(
                    'id' => $opt_prefix . 'terms_condition_link_text',
                    'type' => 'text',
                    'title' => esc_html__('Set Terms & Condition Page Link Text', 'cynic'),
                    'subtitle' => esc_html__('Set Terms & Condition Page Link Text', 'cynic'),
                    'default' => esc_html__('Terms & Condition', 'cynic'),
                    'required' => array($opt_prefix . 'footer_pp_n_tnc_bar_show', '=', '1')
                ),

                array(
                    'id' => $opt_prefix . 'terms_condition_link',
                    'type' => 'select',
                    'title' => esc_html__('Set Terms & Condition Page', 'cynic'),
                    'subtitle' => esc_html__('Set Terms & Condition Page', 'cynic'),
                    'data' => 'pages',
                    'required' => array($opt_prefix . 'footer_pp_n_tnc_bar_show', '=', '1')
                ),

            ),)
    );
    Redux::setSection($opt_name, array(
            'title' => esc_html__('Social link', 'cynic'),
            'id' => 'footer-social-link',
            'desc' => esc_html__('Set Footer Social Link Settings', 'cynic'),
            'icon' => 'el el-twitter',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'id' => $opt_prefix . 'footer_social_bar_show',
                    'type' => 'switch',
                    'title' => esc_html__('Display Footer Social Bar', 'cynic'),
                    'subtitle' => esc_html__('Enable/Disable social bar. You can setup social link from general setting.', 'cynic'),
                    'default' => true,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),

                array(
                    'id' => $opt_prefix . 'footer_media_title',
                    'type' => 'text',
                    'title' => esc_html__('Media Title', 'cynic'),
                    'subtitle' => esc_html__('Please Media Title', 'cynic'),
                    'default' => 'Follow Us',
                    'required' => array($opt_prefix . 'footer_social_bar_show', '=', '1')
                ),

            ),)
    );
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Start a Project', 'cynic'),
        'id' => 'footer-start-project',
        'desc' => esc_html__('Set Footer Start a Project Settings', 'cynic'),
        'icon' => 'el el-tasks',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(

            array(
                'id' => $opt_prefix . 'footer_modal_button_display',
                'type' => 'switch',
                'title' => esc_html__('Display Footer Modal Button', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable footer button', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
            ),

            array(
                'id' => $opt_prefix . 'footer_modal_button_left_text',
                'type' => 'text',
                'title' => esc_html__('Set Footer Button Left Text', 'cynic'),
                'subtitle' => esc_html__('Set footer modal button left side text', 'cynic'),
                'default' => esc_html__('Ready to Start Your Project?', 'cynic'),
                'required' => array($opt_prefix . 'footer_modal_button_display', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'footer_button_text',
                'type' => 'text',
                'title' => esc_html__('Set Footer Button Text', 'cynic'),
                'subtitle' => esc_html__('Set footer modal button text', 'cynic'),
                'default' => esc_html__('Get Started Today', 'cynic'),
                'required' => array($opt_prefix . 'footer_modal_button_display', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'footer_button_page',
                'type' => 'select',
                'title' => esc_html__('Set Footer Button Page', 'cynic'),
                'subtitle' => esc_html__('Set footer button Page', 'cynic'),
                'data' => 'pages',
                'required' => array($opt_prefix . 'footer_modal_button_display', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'is_footer_button_open_with_modal',
                'type' => 'switch',
                'title' => esc_html__('Open With Modal?', 'cynic'),
                'subtitle' => esc_html__('Enable/Disable open with modal', 'cynic'),
                'default' => true,
                'on' => 'Enabled',
                'off' => 'Disabled',
                'required' => array($opt_prefix . 'footer_modal_button_display', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'footer_modal_title',
                'type' => 'switch',
                'type' => 'text',
                'title' => esc_html__('Modal Footer Title', 'cynic'),
                'subtitle' => esc_html__('Set modal header Title', 'cynic'),
                'default' => esc_html__('Tell Us About Your Project', 'cynic'),
                'required' => array($opt_prefix . 'is_footer_button_open_with_modal', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'footer_modal_close_text',
                'type' => 'switch',
                'type' => 'text',
                'title' => esc_html__('Modal Close Text', 'cynic'),
                'subtitle' => esc_html__('Set modal close text', 'cynic'),
                'default' => esc_html__('Close', 'cynic'),
                'required' => array($opt_prefix . 'is_footer_button_open_with_modal', '=', '1')
            ),

            array(
                'id' => $opt_prefix . 'footer_button_open_type',
                'type' => 'radio',
                'title' => esc_html__('Button Open Type', 'cynic'),
                'subtitle' => esc_html__('Button link open type', 'cynic'),
                'options' => array(
                    '_blank' => 'New Window',
                    '_self' => 'Same Window',
                ),
                'default' => '_blank',
                'required' => array($opt_prefix . 'is_footer_button_open_with_modal', '=', '0')
            ),

            array(
                'id' => $opt_prefix . 'footer_modal_secton_showIn_pages',
                'type' => 'checkbox',
                'title' => __('Check to Display Start a Project Block in Pages', 'cynic'),
                'subtitle' => __('Check selected pages to display Start a Project Block in footer', 'cynic'),
                'desc' => __('This section allows to active Start a Project Block in selected pages.', 'cynic'),
                'options' => $__pagearr,
                'required' => array($opt_prefix . 'footer_modal_button_display', '=', '1')
            ),
        )
    ));


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
                'default' => '&lt; PREV',
                'required' => array($opt_prefix . 'blog_prev_next_botton', '=', '1'),
            ),

            array(
                'id' => $opt_prefix . 'blog_next_button_text',
                'type' => 'text',
                'title' => esc_html__('Next Button Text', 'cynic'),
                'subtitle' => esc_html__('Please enter Next button text', 'cynic'),
                'default' => 'NEXT  &gt;',
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
            'title' => esc_html__('Body Font', 'cynic'),
            'id' => 'typography-body-font',
            'desc' => esc_html__('Set Typography Body Font Settings', 'cynic'),
            'icon' => 'el el-align-center',
            'subsection' => true,
            'customizer_width' => '450px',
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
                    'font-weight' => true,
                    'line-height' => false,
                    'font-size' => false,
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Roboto',
                    ),
                ),

                array(
                    'id' => $opt_prefix . 'p_font',
                    'type' => 'typography',
                    'title' => esc_html__('Paragraph Font', 'cynic'),
                    'subtitle' => esc_html__('Specify the paragraph font properties.', 'cynic'),
                    'google' => true,
                    'color' => false,
                    'subsets' => false,
                    'text-align' => false,
                    'font-weight' => true,
                    'line-height' => false,
                    'default' => array(
                        'font-weight' => '300',
                        'font-family' => 'Roboto',
                        'font-size' => '17px',
                    ),
                ),

                array(
                    'id' => $opt_prefix . 'banner_p_font',
                    'type' => 'typography',
                    'title' => esc_html__('Banner Paragraph Font', 'cynic'),
                    'subtitle' => esc_html__('Specify the Banner paragraph font properties.', 'cynic'),
                    'google' => true,
                    'color' => false,
                    'subsets' => false,
                    'text-align' => false,
                    'font-weight' => true,
                    'line-height' => false,
                    'default' => array(
                        'font-weight' => '400',
                        'font-family' => 'Roboto',
                        'font-size' => '18px',
                    ),
                ),
            ))
    );

    /**
     * Header font
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Header Font', 'cynic'),
        'id' => 'typography-heading-font',
        'desc' => esc_html__('Set Typography Heading Font Settings', 'cynic'),
        'icon' => 'el el-website',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
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
                    'font-family' => 'Vesper Libre',
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
                    'font-family' => 'Roboto',
                    'font-size' => '16px',
                ),
            ),

            array(
                'id' => $opt_prefix . 'top_menu_font',
                'type' => 'typography',
                'title' => esc_html__('Top Menu Font', 'cynic'),
                'subtitle' => esc_html__('Specify the top menu font properties.', 'cynic'),
                'google' => true,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'font-size' => true,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'default' => array(
                    'font-family' => 'Vesper Libre',
                    'font-size' => '38px',
                ),
            ),

        )
    ));


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
            'title' => esc_html__('Theme Mode', 'cynic'),
            'id' => 'general_settings-theme-mode',
            'desc' => esc_html__('Set Theme Mode Settings', 'cynic'),
            'icon' => 'el el-ok-circle',
            'subsection' => true,
            'customizer_width' => '450px',
            'fields' => array(
                array(
                    'title' => esc_html__('Theme Mode', 'cynic'),
                    'id' => $opt_prefix . 'theme_mode',
                    'type' => 'radio',
                    'subtitle' => __('Select Layout Of Your Theme', 'cynic'),
                    'options' => array(
                        '1' => 'Unit Test Mode',
                        '2' => 'Website Mode',
                    ),
                    'default' => '1'
                ),
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

    add_action("redux/options/{$opt_name}/settings/change", 'redux_header_top_menu_value_change', 10, 2);

    function redux_header_top_menu_value_change($fields)
    {

        $asignedMenu = $fields['cynic_header_menu_layout'];
        if (strpos($asignedMenu, 'menu_with_top_menu') !== false) {

            $nav_menu_locationsArr = get_theme_mod('nav_menu_locations');
            $TopMenuObj = wp_get_nav_menu_object('top-menu');
            if ($TopMenuObj) {
                $topMenuID = $TopMenuObj->term_id;
                $nav_menu_locationsArr['top_menu'] = $topMenuID;
            }

            $ServiceMenuObj = wp_get_nav_menu_object('services-menu');
            if ($ServiceMenuObj) {
                $ServiceMenu = $ServiceMenuObj->term_id;
                $nav_menu_locationsArr['primary'] = $ServiceMenu;
            }
            set_theme_mod('nav_menu_locations', $nav_menu_locationsArr);
        } else {
            $MainMenuObj = wp_get_nav_menu_object('main-menu');
            if($MainMenuObj){
            $MainMenuID = $MainMenuObj->term_id;
            $nav_menu_locationsArr = get_theme_mod('nav_menu_locations');
            $nav_menu_locationsArr['primary'] = $MainMenuID;
            set_theme_mod('nav_menu_locations', $nav_menu_locationsArr);
            }
        }

    }

    return;
} else {
    if (!is_admin()) {
        $opt_prefix = CYNIC_PREFIX;
        $cynic_options = array(
            $opt_prefix . 'theme_mode' => '1', /* 1 means Unit Test Mode */
            $opt_prefix . 'header_banner_mode' => '1', /* 1 Background Image */
            $opt_prefix . 'site_logo' => array('url' => CYNIC_THEME_URI . '/images/brand-logo.png'),
            $opt_prefix . 'header_telno' => '(702) 145 5847',
            $opt_prefix . 'header_tel_icon' => 'icon-Phone',
            $opt_prefix . 'header_menu_dropdown_type' => 1,
            $opt_prefix . 'header_menu_layout' => CYNIC_THEME_URI . '/images/menu_layouts/menu_without_top_menu.png',
            $opt_prefix . 'header_top_menu_social' => false,
            $opt_prefix . 'is_header_button_open_with_modal' => true,

            $opt_prefix . 'pre_loader' => false,
            $opt_prefix . 'footer_logo' => array('url' => ''),

            $opt_prefix . '404_error' => array('url' => CYNIC_THEME_URI . '/images/404-error.png'),

            $opt_prefix . 'floating_ballon' => array('url' => CYNIC_THEME_URI . '/images/floating-ballon.png'),
            $opt_prefix . 'blog_sidebar' => TRUE,
            $opt_prefix . 'blog_single_sidebar' => TRUE,
            $opt_prefix . 'blog_read_more_text' => "Read More",

            $opt_prefix . 'blog_comment_section' => TRUE,
            $opt_prefix . 'page_comment_section' => TRUE,
            $opt_prefix . 'display_blog_social_share' => false,
            /*Bredcrumb*/
            $opt_prefix . 'breadcrumb_home_title' => "Home",
            $opt_prefix . 'breadcrumb_blog_title' => "Blog",
            $opt_prefix . 'is_enabled_breadcrumb' => true,
            $opt_prefix . 'breadcrumb_separator' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
        );
    }
}


/**
 * @param $option_index without prefiex
 * @return bool|string
 */

function getCynicOptionsVal($indexval)
{
    $index = 'cynic_' . trim($indexval);
    $option = false;
    $options = cynic_options();
    if ((isset($options[$index])) && (!empty($options[$index]) || $options[$index] == 1)) {
        $theme_mode = $options['cynic_theme_mode'];
        if ($theme_mode == 1) {
            if ($indexval == 'header_top_menu' || $indexval == 'footer_pp_n_tnc_bar_show' || $indexval == 'footer_social_bar_show'
                || $indexval == 'display_blog_social_share' || $indexval == 'pre_loader' || $indexval == 'scroll_to_top'
                || $indexval == 'header_button_page' || $indexval == 'header_telephone_number_display'
                || $indexval == 'header_button_display' || $indexval == 'related_posts' || $indexval == 'footer_modal_button_display'
                || $indexval == 'header_menu_dropdown_type'|| $indexval=='footer_logo') {

            } else {

                $option = $options[$index];
            }

        } else {
            $option = $options[$index];
        }
    }
    return $option;
}

