<?php


$wp_customize->add_section('cynic_theme_header_variations',
    array(
        'title' => __('Header Colors', 'cynic'), //Visible title of section
        'priority' => 0, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize header section.', 'cynic'), //Descriptive tooltip
    )
);


$wp_customize->add_setting('cynic_theme[header_brand_logo_max_width]', array(
    'default' => '210',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'cynic_theme[header_brand_logo_max_width]', array(
    'type' => 'range-value',
    'section' => 'cynic_theme_header_variations',
    'settings' => 'cynic_theme[header_brand_logo_max_width]',
    'label' => esc_html__('Header Logo Max Width', 'cynic'),
    'input_attrs' => array(
        'min' => 100,
        'max' => 800,
        'step' => 10,
        'suffix' => 'px', //optional suffix
    ),
)));

// Header Background Color
$wp_customize->add_setting('cynic_theme[header_background_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[header_background_color]',
    array(
        'label' => esc_html__('Header Backgound Color', 'cynic'),
        'section' => 'cynic_theme_header_variations',
        'settings' => 'cynic_theme[header_background_color]',
    )
));

// Header Background Color
$wp_customize->add_setting('cynic_theme[header_phone_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#333333',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[header_phone_text_color]',
    array(
        'label' => esc_html__('Header Phone Number Color', 'cynic'),
        'section' => 'cynic_theme_header_variations',
        'settings' => 'cynic_theme[header_phone_text_color]',
    )
));

$wp_customize->add_setting('cynic_theme[header_phone_hover_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#333333',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[header_phone_hover_text_color]',
    array(
        'label' => esc_html__('Header Phone Number Hover Color', 'cynic'),
        'section' => 'cynic_theme_header_variations',
        'settings' => 'cynic_theme[header_phone_hover_text_color]',
    )
));

