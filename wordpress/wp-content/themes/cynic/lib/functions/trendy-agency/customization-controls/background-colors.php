<?php

$wp_customize->add_section('background-colors',
    array(
        'title' => __('Background Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Background Colors.', 'cynic'), //Descriptive tooltip
        'priority' => 16,
    )
);

/* Background Colors */

$wp_customize->add_setting('cynic_bg-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_bg-color',
    array(
        'description' => esc_html__('Main Background Color', 'cynic'),
        'section' => 'background-colors',
        'settings' => 'cynic_bg-color',
    )
));

$wp_customize->add_setting('cynic_shape-color', array(
    'default' => '#edf7ff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_shape-color',
    array(
        'description' => esc_html__('Shape/Bubble Color', 'cynic'),
        'section' => 'background-colors',
        'settings' => 'cynic_shape-color',
    )
));

$wp_customize->add_setting('cynic_box-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_box-color',
    array(
        'description' => esc_html__('Box Color', 'cynic'),
        'section' => 'background-colors',
        'settings' => 'cynic_box-color',
    )
));

$wp_customize->add_setting('cynic_box-shadow-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_box-shadow-color',
    array(
        'description' => esc_html__('Box Shadow Color', 'cynic'),
        'section' => 'background-colors',
        'settings' => 'cynic_box-shadow-color',
    )
));
