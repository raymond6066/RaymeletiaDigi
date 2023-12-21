<?php

$wp_customize->add_panel('header', array(
    'title' => 'Header',
    'description' => 'Header Panel',
    'priority' => 10,
));

/* Site Logo */
$wp_customize->add_section('cynic_logo', array(
    "title" => __('Logo', 'cynic'), //Visible title of section
    "description" => __('Upload images to display on the logo.', 'cynic'),
    'panel' => 'header',
));

$wp_customize->add_setting('cynic_site_logo', array(
    'default' => CYNIC_THEME_URI . '/images/illustration/brand-logo.png',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));

$wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'cynic_site_logo', array(
        'label' => __('Site Logo', 'cynic'),
        'section' => 'cynic_logo',
        'settings' => 'cynic_site_logo',
    ))
);

/* Button Sections */
$wp_customize->add_section('cynic_top_button',
    array(
        'title' => __('Top Button', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize header section.', 'cynic'), //Descriptive tooltip
        'panel' => 'header',
    )
);


$wp_customize->add_setting('cynic_header_button_display',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_switch_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_header_button_display',
    array(
        'label' => esc_html__('Display Header Button', 'cynic'),
        'section' => 'cynic_top_button'
    )
));

$wp_customize->add_setting('cynic_header_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => 'Contact Us',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_header_button_text', array(
    'type' => 'text',
    'section' => 'cynic_top_button', // Add a default or your own section
    'label' => __('Set Header Button Text', 'cynic'),
    'description' => esc_html__('Set Header Modal Button Text', 'cynic'),
));

$wp_customize->add_setting('cynic_header_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => 'Contact Us',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_header_button_text', array(
    'type' => 'text',
    'section' => 'cynic_top_button', // Add a default or your own section
    'label' => __('Set Header Button Text', 'cynic'),
    'description' => esc_html__('Set Header Modal Button Text', 'cynic'),
));


$wp_customize->add_setting('cynic_is_header_button_open_with_modal',
    array(
        'default' => 'right',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_is_header_button_open_with_modal',
    array(
        'label' => __('Link Open', 'cynic'),
        'description' => esc_html__('Open Link with Page/Modal', 'cynic'),
        'section' => 'cynic_top_button',
        'choices' => array(
            'modal' => __('Modal'), // Required. Setting for this particular radio button choice and the text to display
            'page' => __('Page'), // Required. Setting for this particular radio button choice and the text to display
            'bookmark' => __('Bookmark') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_header_button_page', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_header_button_page', array(
    'type' => 'dropdown-pages',
    'section' => 'cynic_top_button', // Add a default or your own section
    'label' => esc_html__('Set Header Button Page', 'cynic'),
    'description' => esc_html__('Set header button Page', 'cynic'),
));


$wp_customize->add_setting('cynic_header_button_bookmark', array(
    'capability' => 'edit_theme_options',
    'default' => '#contact',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_header_button_bookmark', array(
    'type' => 'text',
    'section' => 'cynic_top_button', // Add a default or your own section
    'label' => esc_html__('Set Bookmark Link', 'cynic'),
    'description' => esc_html__('Set Header Modal Bookmark Link', 'cynic'),
));



