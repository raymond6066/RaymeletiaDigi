<?php

$wp_customize->add_section('cynic_theme_general_pricing_color',
    array(
        'title' => __('Pricing Colors', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize WPBakkery Pricing Element color.', 'cynic'), //Descriptive tooltip
    )
);


// For pricing vc elements
$wp_customize->add_setting('cynic_theme[section_pricing_label_text_color]',
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
    'cynic_theme[section_pricing_label_text_color]',
    array(
        'label'=>'Pricing Table <hr class="hr2">',
        'description' => esc_html__('Pricing Title Text Color', 'cynic'),
        'settings' => 'cynic_theme[section_pricing_label_text_color]',
        'section' => 'cynic_theme_general_pricing_color',
    )
));


$wp_customize->add_setting('cynic_theme[section_pricing_label_bg_left]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_pricing_label_bg_left]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Pricing Title Background Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[section_pricing_label_bg_left]',
        'section' => 'cynic_theme_general_pricing_color',
    )
));

$wp_customize->add_setting('cynic_theme[section_pricing_label_bg_right]',
    array(
        'default' => '#39a8fe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_pricing_label_bg_right]',
    array(
        'description' => esc_html__('Pricing Title Background Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[section_pricing_label_bg_right]',
        'section' => 'cynic_theme_general_pricing_color',
    )
));