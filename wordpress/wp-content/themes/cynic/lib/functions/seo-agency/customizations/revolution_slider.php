<?php

$wp_customize->add_section('cynic_theme_general_revolution_slider_color',
    array(
        'title' => __('Revolution Slider Colors (Home Page)', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize Revolution Slider content color.', 'cynic'), //Descriptive tooltip
    )
);




/**
 * ########### Revolution Slider ##############
 */

//  Revolution Slider Heading Color
$wp_customize->add_setting('cynic_theme[revolution_slider_heading_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[revolution_slider_heading_color]',
    array(
        'label'=>'Revolution Slider (Home Page) <hr class="hr2">',
        'description' => esc_html__('Slider Headline Color', 'cynic'),
        'settings' => 'cynic_theme[revolution_slider_heading_color]',
        'section' => 'cynic_theme_general_revolution_slider_color',
    )
));


//  Revolution Slider Sub Heading Color
$wp_customize->add_setting('cynic_theme[revolution_slider_sub_heading_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[revolution_slider_sub_heading_color]',
    array(
        'description' => esc_html__('Slider Sub Headline Color', 'cynic'),
        'settings' => 'cynic_theme[revolution_slider_sub_heading_color]',
        'section' => 'cynic_theme_general_revolution_slider_color',
    )
));

$wp_customize->add_setting('cynic_theme[revolution_slider_arrows_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[revolution_slider_arrows_color]',
    array(
        'description' => esc_html__('Slider Navigation Arrows Color', 'cynic'),
        'settings' => 'cynic_theme[revolution_slider_arrows_color]',
        'section' => 'cynic_theme_general_revolution_slider_color',
    )
));