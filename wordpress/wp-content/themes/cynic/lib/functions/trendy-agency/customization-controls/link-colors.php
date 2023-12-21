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

$wp_customize->add_setting('cynic_link-colors', array(
    'default' => '#69798d',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link-colors',
    array(
        'description' => esc_html__('Link Color', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link-colors',
    )
));

$wp_customize->add_setting('cynic_link-hover-colors-from', array(
    'default' => '#9a9fff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link-hover-colors-from',
    array(
        'description' => esc_html__('Link Hover Color From', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link-hover-colors-from',
    )
));

$wp_customize->add_setting('cynic_link-hover-colors-to', array(
    'default' => '#6245fe',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link-hover-colors',
    array(
        'description' => esc_html__('Link Hover Color To', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link-hover-colors-to',
    )
));

$wp_customize->add_setting('cynic_link-active-colors-from', array(
    'default' => '#9a9fff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link-active-colors-from',
    array(
        'description' => esc_html__('Link Active Color From', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link-active-colors-from',
    )
));

$wp_customize->add_setting('cynic_link-active-colors-to', array(
    'default' => '#6245fe',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_link-active-colors-to',
    array(
        'description' => esc_html__('Link Active Color To', 'cynic'),
        'section' => 'link-colors',
        'settings' => 'cynic_link-active-colors-to',
    )
));