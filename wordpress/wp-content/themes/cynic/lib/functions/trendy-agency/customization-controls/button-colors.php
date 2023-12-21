<?php

$wp_customize->add_section('cynic_button_colors',
    array(
        'title' => __('Button Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize theme all button colors.', 'cynic'), //Descriptive tooltip
        'priority' => 12,
    )
);

/* Primary Button Colors */

$wp_customize->add_setting('cynic_primary-btn-colors-from', array(
    'default' => '#e9a17b',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-btn-colors-from',
    array(
        'description' => esc_html__('Primary Button Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_primary-btn-colors-from',
    )
));


$wp_customize->add_setting('cynic_primary-btn-colors-to', array(
    'default' => '#ff7cb0',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-btn-colors-to',
    array(
        'description' => esc_html__('Primary Button Color To', 'cynic'),
        'settings' => 'cynic_primary-btn-colors-to',
        'section' => 'cynic_button_colors',
    )
));

$wp_customize->add_setting('cynic_primary-btn-colors-from-hover', array(
    'default' => '#e9a17b',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-colors-from-hover',
    array(
        'description' => esc_html__('Primary Button Hover Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_primary-btn-colors-from-hover',
    )
));


$wp_customize->add_setting('cynic_primary-btn-colors-to-hover', array(
    'default' => '#ff7cb0',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-btn-colors-to-hover',
    array(
        'description' => esc_html__('Primary Button Hover Color To', 'cynic'),
        'settings' => 'cynic_primary-btn-colors-to-hover',
        'section' => 'cynic_button_colors',
    )
));

/* Secondary Button Colors */

$wp_customize->add_setting('cynic_secondary-btn-colors-from', array(
    'default' => '#9a9fff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary-btn-colors-from',
    array(
        'description' => esc_html__('Secondary Button Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_secondary-btn-colors-from',
    )
));


$wp_customize->add_setting('cynic_secondary-btn-colors-to', array(
    'default' => '#6245fe',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-brn-colors-to',
    array(
        'description' => esc_html__('Secondary Button Color To', 'cynic'),
        'settings' => 'cynic_secondary-btn-colors-to',
        'section' => 'cynic_button_colors',
    )
));

$wp_customize->add_setting('cynic_secondary-btn-colors-from-hover', array(
    'default' => '#9a9fff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary-colors-from-hover',
    array(
        'description' => esc_html__('Secondary Button Hover Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_secondary-btn-colors-from-hover',
    )
));


$wp_customize->add_setting('cynic_secondary-btn-colors-to-hover', array(
    'default' => '#6245fe',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary-btn-colors-to-hover',
    array(
        'description' => esc_html__('Secondary Button Hover Color To', 'cynic'),
        'settings' => 'cynic_secondary-btn-colors-to-hover',
        'section' => 'cynic_button_colors',
    )
));

/* Tertiary Button Colors */

$wp_customize->add_setting('cynic_tertiary-btn-colors-from', array(
    'default' => '#f18cff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-btn-colors-from',
    array(
        'description' => esc_html__('Tertiary Button Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_tertiary-btn-colors-from',
    )
));


$wp_customize->add_setting('cynic_tertiary-btn-colors-to', array(
    'default' => '#af46fc',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-brn-colors-to',
    array(
        'description' => esc_html__('Tertiary Button Color To', 'cynic'),
        'settings' => 'cynic_tertiary-btn-colors-to',
        'section' => 'cynic_button_colors',
    )
));

$wp_customize->add_setting('cynic_tertiary-btn-colors-from-hover', array(
    'default' => '#f18cff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-colors-from-hover',
    array(
        'description' => esc_html__('Tertiary Button Hover Color From', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_tertiary-btn-colors-from-hover',
    )
));


$wp_customize->add_setting('cynic_tertiary-btn-colors-to-hover', array(
    'default' => '#af46fc',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-btn-colors-to-hover',
    array(
        'description' => esc_html__('Tertiary Button Hover Color To', 'cynic'),
        'settings' => 'cynic_tertiary-btn-colors-to-hover',
        'section' => 'cynic_button_colors',
    )
));



