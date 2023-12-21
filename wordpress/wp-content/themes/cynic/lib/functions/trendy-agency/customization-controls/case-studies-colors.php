<?php

$wp_customize->add_section('case-studies-colors',
    array(
        'title' => __('Case Studies Colors', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Colors for Case Study Block.', 'cynic'), //Descriptive tooltip
        'priority' => 15,
    )
);

/* Case Studies Colors */

$wp_customize->add_setting('cynic_cs-headline-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_cs-headline-color',
    array(
        'description' => esc_html__('Headline Color', 'cynic'),
        'section' => 'case-studies-colors',
        'settings' => 'cynic_cs-headline-color',
    )
));

$wp_customize->add_setting('cynic_cs-body-text-color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_cs-body-text-color',
    array(
        'description' => esc_html__('Set Case Study Body Text Color', 'cynic'),
        'section' => 'case-studies-colors',
        'settings' => 'cynic_cs-body-text-color',
    )
));
