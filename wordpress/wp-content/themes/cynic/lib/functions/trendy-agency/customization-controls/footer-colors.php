<?php
$wp_customize->add_panel('footer', array(
    'title' => 'Footer',
    'description' => 'Footer Panel',
    'priority' => 17,
));

/* Footer Colors */
$wp_customize->add_section('footer-colors',
    array(
        'title' => __('Footer Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Footer Colors.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_headline-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline-color',
    array(
        'description' => esc_html__('Headline Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_headline-color',
    )
));

$wp_customize->add_setting('cynic_menu-text-color', array(
    'default' => '#9a9fff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu-text-color',
    array(
        'description' => esc_html__('Menu/Text Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_menu-text-color',
    )
));

$wp_customize->add_setting('cynic_menu-text-hover-color', array(
    'default' => '#ff7cb0',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu-text-hover-color',
    array(
        'description' => esc_html__('Menu/Text Hover Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_menu-text-hover-color',
    )
));

$wp_customize->add_setting('cynic_social-media-color', array(
    'default' => '#a6d1ed',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_social-media-color',
    array(
        'description' => esc_html__('Social Media Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_social-media-color',
    )
));

$wp_customize->add_setting('cynic_footer-main-bg-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_footer-main-bg-color',
    array(
        'description' => esc_html__('Main Background Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_footer-main-bg-color',
    )
));

$wp_customize->add_setting('cynic_footer-bottom-bg-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_footer-bottom-bg-color',
    array(
        'description' => esc_html__('Footer Bottom Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_footer-bottom-bg-color',
    )
));

/* Footer Logo */

$wp_customize->add_section('footer-logo',
    array(
        'title' => __('Logo', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Footer Colors.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_footer_logo', array(
    'default' => CYNIC_THEME_URI . '/images/trendy-agency-footer-logo.png',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));

$wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'cynic_footer_logo', array(
        'label' => __('Footer Logo', 'cynic'),
        'section' => 'footer-logo',
        'settings' => 'cynic_footer_logo',
    ))
);

/* Footer Menu */

$wp_customize->add_section('footer-bottom-menu',
    array(
        'title' => __('Bottom Menu', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Footer Colors.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

if (get_theme_mod('cynic_layouts') == 2) {
    $wp_customize->add_setting('cynic_onepage_privacy_link', array(
        'capability' => 'edit_theme_options',
        'default' => '',
    ));

    $wp_customize->add_control('cynic_onepage_privacy_link', array(
        'type' => 'dropdown-pages',
        'section' => 'footer-bottom-menu', // Add a default or your own section
        'label' => esc_html__('Set Privacy Policy Page Link', 'cynic'),
        'description' => esc_html__('Set Privacy Policy Modal Page', 'cynic'),
    ));

    $wp_customize->add_setting('cynic_onepage_terms_condition_link', array(
        'capability' => 'edit_theme_options',
        'default' => '',
    ));

    $wp_customize->add_control('cynic_onepage_terms_condition_link', array(
        'type' => 'dropdown-pages',
        'section' => 'footer-bottom-menu', // Add a default or your own section
        'label' => esc_html__('Set Terms & Condition Page Link', 'cynic'),
        'description' => esc_html__('Set Terms & Condition Modal Page', 'cynic'),
    ));
}


/* Mail CHimp Settings */

$wp_customize->add_section('footer-mainchimp-settings',
    array(
        'title' => __('Mailchimp Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Mailchimp Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_display_mailchimp',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_switch_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_display_mailchimp',
    array(
        'label' => esc_html__('Display Subscriber Section', 'cynic'),
        'section' => 'footer-mainchimp-settings'
    )
));

$wp_customize->add_setting('cynic_mailchimp_shortcode', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_mailchimp_shortcode', array(
    'type' => 'textarea',
    'section' => 'footer-mainchimp-settings', // // Add a default or your own section
    'label' => __('Subscriber Section HTML'),
    'description' => __('Subscriber section custom html markup. Shortcodes supported.'),
));

//Footer Copyright Text

$wp_customize->add_section('footer-copyright-settings',
    array(
        'title' => __('Footer Copyright Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Copyright Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_footer_copyright_text', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('cynic_footer_copyright_text', array(
    'type' => 'textarea',
    'section' => 'footer-copyright-settings', // // Add a default or your own section
    'label' => __('Copyright text'),
    'description' => __('Insert copyright text for the theme.'),
));

