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

$wp_customize->add_setting('cynic_primary_colors', array(
    'default' => '#0a8aff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_primary_colors',
    array(
        'description' => esc_html__('Primary Color', 'cynic'),
        'section' => 'cynic_global_colors',
        'settings' => 'cynic_primary_colors',
    )
));

/*Secondary Colors*/

$wp_customize->add_setting('cynic_secondary_colors', array(
    'default' => '#fc7c56',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_secondary_colors',
    array(
        'description' => esc_html__('Secondary Color From', 'cynic'),
        'settings' => 'cynic_secondary_colors',
        'section' => 'cynic_global_colors',
    )
));

/*Social Media Colors*/

$wp_customize->add_setting('cynic_social_media_colors', array(
    'default' => '#9cb9e2',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_social_media_colors',
    array(
        'description' => esc_html__('Social Media Colors', 'cynic'),
        'settings' => 'cynic_social_media_colors',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_social_media_hover_colors', array(
    'default' => '#0a8aff',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_social_media_hover_colors',
    array(
        'description' => esc_html__('Social Media Hover Colors', 'cynic'),
        'settings' => 'cynic_social_media_hover_colors',
        'section' => 'cynic_global_colors',
    )
));

$wp_customize->add_setting('cynic_line_colors', array(
    'default' => '#e6f2ff',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_line_colors',
    array(
        'description' => esc_html__('Global Line Colors', 'cynic'),
        'settings' => 'cynic_line_colors',
        'section' => 'cynic_global_colors',
    )
));
