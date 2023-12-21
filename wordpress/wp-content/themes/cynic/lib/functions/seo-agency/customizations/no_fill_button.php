<?php

// NO Fill Button Text Color
$wp_customize->add_setting('cynic_theme[no_fill_button_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[no_fill_button_text_color]',
    array(
        'label' => 'No Fill Button: <hr class="hr2">',
        'priority' => 30,
        'description' => esc_html__('No Fill Button Text Color', 'cynic'),
        'section' => 'cynic_theme_button_variations',
        'settings' => 'cynic_theme[no_fill_button_text_color]',
    )
));


//No Fill Button Hover Text Color
$wp_customize->add_setting('cynic_theme[no_fill_button_hover_text_color]',
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
    'cynic_theme[no_fill_button_hover_text_color]',
    array(
        'priority' => 30,
        'description' => esc_html__('No Fill Button Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_hover_text_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// No Fill Button Border Color
$wp_customize->add_setting('cynic_theme[no_fill_button_border_color]',
    array(
        'default' => '#4fbf53',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[no_fill_button_border_color]',
    array(
        'label' =>'<hr>',
        'priority' => 30,
        'description' => esc_html__('No Fill Button Border Color', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_border_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// No Fill Button Border Hover Color
$wp_customize->add_setting('cynic_theme[no_fill_button_border_hvr_color]',
    array(
        'default' => '#4fbf53',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[no_fill_button_border_hvr_color]',
    array(
        'priority' => 30,
        'description' => esc_html__('No Fill Button Border Hover Color', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_border_hvr_color]',
        'section' => 'cynic_theme_button_variations',
    )
));


//No Fill Button Box Shadow Color
$wp_customize->add_setting('cynic_theme[no_fill_button_box_shadow_hvr_color]',
    array(
        'default' => '#000000',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[no_fill_button_box_shadow_hvr_color]',
    array(
        'label' =>'<hr>',
        'priority' => 30,
        'description' => esc_html__('No Fill Button Shadow Hover Color', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_box_shadow_hvr_color]',
        'section' => 'cynic_theme_button_variations',
    )
));


//No Fill Button Hover Background Color
$wp_customize->add_setting('cynic_theme[no_fill_button_hvr_bg_color_left]',
    array(
        'default' => '#4fbf53',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[no_fill_button_hvr_bg_color_left]',
    array(
        'label' =>'<hr>',
        'priority' => 30,
        'description' => esc_html__('No Fill Button Background Hover Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_hvr_bg_color_left]',
        'section' => 'cynic_theme_button_variations',
    )
));
$wp_customize->add_setting('cynic_theme[no_fill_button_hvr_bg_color_right]',
    array(
        'default' => '#9dcf56',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[no_fill_button_hvr_bg_color_right]',
    array(
        'priority' => 30,
        'description' => esc_html__('No Fill Button Background Hover Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[no_fill_button_hvr_bg_color_right]',
        'section' => 'cynic_theme_button_variations',
    )
));