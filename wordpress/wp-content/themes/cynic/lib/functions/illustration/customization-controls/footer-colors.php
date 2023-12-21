<?php
$wp_customize->add_panel('footer', array(
    'title' => 'Footer',
    'description' => 'Footer Panel',
    'priority' => 17,
));

/**Footer Logo**/
$wp_customize->add_section('footer-logo',
    array(
        'title' => __('Logo', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Footer Logo.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_footer_logo', array(
    'default' => CYNIC_THEME_URI . '/images/illustration/brand-logo.png',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));

$wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'cynic_footer_logo', array(
        'label' => __('Logo', 'cynic'),
        'section' => 'footer-logo',
        'settings' => 'cynic_footer_logo',
    ))
);


//Footer Sub Headline

$wp_customize->add_setting('footer_image_subheadline_text', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('footer_image_subheadline_text', array(
    'type' => 'textarea',
    'section' => 'footer-logo', // // Add a default or your own section
    'label' => __('Footer Sub headline Text'),
    'description' => __('Insert Footer Sub headline Text.'),
));

/* Footer Colors */

$wp_customize->add_section('footer-colors',
    array(
        'title' => __('Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Footer Colors.', 'cynic'), //Descriptive tooltip
        'panel' => 'footer',
    )
);

$wp_customize->add_setting('cynic_menu_text_color', array(
    'default' => '#546182',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu_text_color',
    array(
        'description' => esc_html__('Menu/Text Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_menu_text_color',
    )
));

$wp_customize->add_setting('cynic_menu_text_hover_color', array(
    'default' => '#fc7c56',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu_text_hover_color',
    array(
        'description' => esc_html__('Menu/Text Hover Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_menu_text_hover_color',
    )
));

$wp_customize->add_setting('cynic_menu_title_color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu_title_color',
    array(
        'description' => esc_html__('Title Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_menu_title_color',
    )
));

$wp_customize->add_setting('cynic_footer_bottom_bg_color', array(
    'default' => '#171741',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_footer_bottom_bg_color',
    array(
        'description' => esc_html__('Footer Background Color', 'cynic'),
        'section' => 'footer-colors',
        'settings' => 'cynic_footer_bottom_bg_color',
    )
));

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

