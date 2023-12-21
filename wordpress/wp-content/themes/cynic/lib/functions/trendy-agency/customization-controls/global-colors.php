<?php

$wp_customize->add_section('cynic_global_colors',
    array(
        'title' => __('Global Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize themes primary, secodary, tertiary colors.', 'cynic'), //Descriptive tooltip
        'priority' => 11,
    )
);

/* Primary Colors */

$wp_customize->add_setting('cynic_primary-colors-from', array(
    'default' => '#e9a17b',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-colors-from',
    array(
        'description' => esc_html__('Primary Color From', 'cynic'),
        'section' => 'cynic_global_colors',
        'settings' => 'cynic_primary-colors-from',
    )
));


$wp_customize->add_setting('cynic_primary-colors-to', array(
    'default' => '#ff7cb0',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary-colors-to',
    array(
        'description' => esc_html__('Primary Color To', 'cynic'),
        'settings' => 'cynic_primary-colors-to',
        'section' => 'cynic_global_colors',
    )
));

/*Secondary Colors*/

$wp_customize->add_setting('cynic_secondary-colors-from', array(
    'default' => '#f18cff',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary-colors-from',
    array(
        'description' => esc_html__('Secondary Color From', 'cynic'),
        'settings' => 'cynic_secondary-colors-from',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_secondary-colors-to', array(
    'default' => '#af46fc',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary-colors-to',
    array(
        'description' => esc_html__('Secondary Color To', 'cynic'),
        'settings' => 'cynic_secondary-colors-to',
        'section' => 'cynic_global_colors',
    )
));

/*Tertiary Colors*/

$wp_customize->add_setting('cynic_tertiary-colors-from', array(
    'default' => '#9a9fff',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-colors-from',
    array(
        'description' => esc_html__('Tertiary Color From', 'cynic'),
        'settings' => 'cynic_tertiary-colors-from',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_tertiary-colors-to', array(
    'default' => '#6245fe',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_tertiary-colors-to',
    array(
        'description' => esc_html__('Tertiary Color To', 'cynic'),
        'settings' => 'cynic_tertiary-colors-to',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_global-line-colors', array(
    'default' => '#edf7ff',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_global-line-colors',
    array(
        'description' => esc_html__('Global Line Color', 'cynic'),
        'settings' => 'cynic_global-line-colors',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_global-modal-colors', array(
    'default' => '#fef4f5',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_global-modal-colors',
    array(
        'description' => esc_html__('Global Modal Color', 'cynic'),
        'settings' => 'cynic_global-modal-colors',
        'section' => 'cynic_global_colors',
    )
));
