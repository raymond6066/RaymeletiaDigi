<?php

$wp_customize->add_section('background-colors',
    array(
        'title' => __('Background Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Background Colors.', 'cynic'), //Descriptive tooltip
        'priority' => 16,
    )
);

$wp_customize->add_setting('cynic_box_color', array(
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
        'settings' => 'cynic_box_color',
    )
));

$wp_customize->add_setting('cynic_box_shadow_color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_box_shadow_color',
    array(
        'description' => esc_html__('Box Shadow Color', 'cynic'),
        'section' => 'background-colors',
        'settings' => 'cynic_box_shadow_color',
    )
));
