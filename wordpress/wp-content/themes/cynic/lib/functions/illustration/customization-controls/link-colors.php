<?php

$wp_customize->add_section('link-colors',
    array(
        'title' => __('Link Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Link Colors.', 'cynic'), //Descriptive tooltip
        'priority' => 14,
    )
);

/* Link Colors */

$wp_customize->add_setting('cynic_link_colors', array(
    'default' => '#0a8aff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link_colors',
    array(
        'description' => esc_html__('Link Color', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link_colors',
    )
));

$wp_customize->add_setting('cynic_link_hover_colors', array(
    'default' => '#fc7c56',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link_hover_colors',
    array(
        'description' => esc_html__('Link Hover/Active Color', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link_hover_colors',
    )
));