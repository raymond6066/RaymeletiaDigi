<?php

$wp_customize->add_panel('nav-item', array(
    'title' => 'Navigation Items',
    'description' => 'Navigation Colors Panel',
    'priority' => 13,
));

/* Menu Color Settings */
$wp_customize->add_section('menu-colors', array(
    "title" => __('Menu Colors', 'cynic'), //Visible title of section
    "description" => __('Menu Colors.', 'cynic'),
    'panel' => 'nav-item',
));

$wp_customize->add_setting('cynic_menu-colors', array(
    'default' => '#69798d',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_menu-colors',
    array(
        'description' => esc_html__('Item Color', 'cynic'),
        'section' => 'menu-colors',
        'settings' => 'cynic_menu-colors',
    )
));

$wp_customize->add_setting('cynic_hover-colors', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_hover-colors',
    array(
        'description' => esc_html__('Item Hover Color', 'cynic'),
        'section' => 'menu-colors',
        'settings' => 'cynic_hover-colors',
    )
));

$wp_customize->add_setting('cynic_active-colors', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_active-colors',
    array(
        'description' => esc_html__('Item Active Color', 'cynic'),
        'section' => 'menu-colors',
        'settings' => 'cynic_active-colors',
    )
));

/* Menu Settings */

$wp_customize->add_section('menu-settings', array(
    "title" => __('Menu Settings', 'cynic'), //Visible title of section
    "description" => __('Menu Settings.', 'cynic'),
    'panel' => 'nav-item',
));

$wp_customize->add_setting( 'cynic_menu-spacing',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'cynic_menu-spacing',
    array(
        'label' => esc_html__('Menu Spacing in px'),
        'section' => 'menu-settings',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 6,
        ),
    )
));

/*Enable/Disable Sticky Menu*/
$wp_customize->add_setting('cynic_active_sticky',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control(
    $wp_customize,
    'cynic_active_sticky',
    array(
        'label' => __('Sticky Menu', 'cynic'),
        'description' => esc_html__('Enable/Disable Sticky Menu', 'cynic'),
        'section' => 'menu-settings',
    )
));

$wp_customize->add_setting('cynic_top-menu-bg-colors', array(
    'default' => '#ffffff',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_top-menu-bg-colors',
    array(
        'description' => esc_html__('Top Menu Color', 'cynic'),
        'section' => 'menu-settings',
        'settings' => 'cynic_top-menu-bg-colors',
    )
));


