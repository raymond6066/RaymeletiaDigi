<?php
$wp_customize->add_section('cynic_theme_footer_variations',
    array(
        'title' => __('Footer Colors', 'cynic'), //Visible title of section
        'priority' => 5, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize footer section.', 'cynic'), //Descriptive tooltip
    )
);


$wp_customize->add_setting('cynic_theme[footer_brand_logo_max_width]', array(
    'default' => '210',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'cynic_theme[footer_brand_logo_max_width]', array(
    'type' => 'range-value',
    'section' => 'cynic_theme_footer_variations',
    'settings' => 'cynic_theme[footer_brand_logo_max_width]',
    'label' => esc_html__('Logo Max Width', 'cynic'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 10,
        'suffix' => '%', //optional suffix
    ),
)));

// Footer Title Color
$wp_customize->add_setting('cynic_theme[footer_widget_title_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[footer_widget_title_color]',
    array(
        'description' => esc_html__('Footer Title Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_widget_title_color]',
    )
));

$wp_customize->add_setting('cynic_theme[footer_link_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#8c8c8c',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[footer_link_text_color]',
    array(
        'label' => '<hr>',
        'description' => esc_html__('Link Text Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_link_text_color]',
    )
));


$wp_customize->add_setting('cynic_theme[footer_link_text_hover_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[footer_link_text_hover_color]',
    array(
        'label' => esc_html__('Link Text Hover Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_link_text_hover_color]',
    )
));



$wp_customize->add_setting('cynic_theme[footer_email_field_line_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#413f48',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[footer_email_field_line_color]',
    array(
        'label' => '<hr>',
        'description' => esc_html__('Email Field Line Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_email_field_line_color]',
    )
));

$wp_customize->add_setting('cynic_theme[footer_email_field_active_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[footer_email_field_active_color]',
    array(
        'description' => esc_html__('Email Field Line Active Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_email_field_active_color]',
    )
));



// Footer Go to Top Scroll Icon Color
$wp_customize->add_setting('cynic_theme[footer_go_to_top_scroll_icon_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[footer_go_to_top_scroll_icon_color]',
    array(
        'label' => '<hr>',
        'description' => esc_html__('Go To Top Arrow Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_go_to_top_scroll_icon_color]',
    )
));


// Footer Go to Top Scroll Background Color
$wp_customize->add_setting('cynic_theme[footer_go_to_top_scroll_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[footer_go_to_top_scroll_bg_color]',
    array(
        'description' => esc_html__('Go To Top Background Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_go_to_top_scroll_bg_color]',
    )
));











$wp_customize->add_setting('cynic_theme[footer_horizonal_line_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#413f48',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[footer_horizonal_line_color]',
    array(
        'label' =>'<hr>',
        'description' => esc_html__('Horizontal Line Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_horizonal_line_color]',
    )
));

// Footer Background Color
$wp_customize->add_setting('cynic_theme[footer_background_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
    array(
        'default' => '#2b2a2e',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[footer_background_color]',
    array(
        'description' => esc_html__('Backgound Color', 'cynic'),
        'section' => 'cynic_theme_footer_variations',
        'settings' => 'cynic_theme[footer_background_color]',
    )
));



