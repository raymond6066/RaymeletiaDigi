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

$wp_customize->add_setting('cynic_primary_btn_colors', array(
    'default' => '#0a8aff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary_btn_colors',
    array(
        'description' => esc_html__('Primary Button Colors', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_primary_btn_colors',
    )
));


/* Secondary Button Colors */

$wp_customize->add_setting('cynic_secondary_btn_colors', array(
    'default' => '#fc7c56',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary_btn_colors',
    array(
        'description' => esc_html__('Secondary Button Color', 'cynic'),
        'section' => 'cynic_button_colors',
        'settings' => 'cynic_secondary_btn_colors',
    )
));