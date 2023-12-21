<?php
$wp_customize->add_section('cynic_theme_button_variations',
    array(
        'title' => __('Button Colors', 'cynic'), //Visible title of section
        'priority' => 3, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize theme all button style.', 'cynic'), //Descriptive tooltip
    )
);


// button border_radius
$wp_customize->add_setting('cynic_theme[button_border_radius]', array(
    'default' => '50',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'cynic_theme[button_border_radius]', array(
    'type' => 'range-value',
    'section' => 'cynic_theme_button_variations',
    'settings' => 'cynic_theme[button_border_radius]',
    'label' => esc_html__('Border Radius of All Button', 'cynic'),
    'input_attrs' => array(
        'min' => 1,
        'max' => 50,
        'step' => 1,
        'suffix' => 'px', //optional suffix
    ),
)));


// Fill Button Text Color
$wp_customize->add_setting('cynic_theme[fill_button_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
    'cynic_theme[fill_button_text_color]',
    array(
        'label' => 'Fill Button: <hr class="hr2">',
        'description' => esc_html__('Fill Button Text Color', 'cynic'),
        'section' => 'cynic_theme_button_variations',
        'settings' => 'cynic_theme[fill_button_text_color]',
    )
));


// Fill Button Hover Text Color
$wp_customize->add_setting('cynic_theme[fill_button_hover_text_color]',
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
    'cynic_theme[fill_button_hover_text_color]',
    array(
        'description' => esc_html__('Fill Button Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[fill_button_hover_text_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// Fill Button Border Color
$wp_customize->add_setting('cynic_theme[fill_button_border_color]',
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
    'cynic_theme[fill_button_border_color]',
    array(
        'label' =>'<hr>',
        'description' => esc_html__('Fill Button Border Color', 'cynic'),
        'settings' => 'cynic_theme[fill_button_border_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// Fill Button Border Hover Color
$wp_customize->add_setting('cynic_theme[fill_button_border_hvr_color]',
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
    'cynic_theme[fill_button_border_hvr_color]',
    array(
        'description' => esc_html__('Fill Button Border Hover Color', 'cynic'),
        'settings' => 'cynic_theme[fill_button_border_hvr_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// Fill Button Box Shadow Color
$wp_customize->add_setting('cynic_theme[fill_button_box_shadow_hvr_color]',
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
    'cynic_theme[fill_button_box_shadow_hvr_color]',
    array(
        'label' =>'<hr>',
        'description' => esc_html__('Fill Button Hover Shadow Color', 'cynic'),
        'settings' => 'cynic_theme[fill_button_box_shadow_hvr_color]',
        'section' => 'cynic_theme_button_variations',
    )
));

// Fill Button Background Color
$wp_customize->add_setting('cynic_theme[fill_button_bg_color_left]',
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
    'cynic_theme[fill_button_bg_color_left]',
    array(
        'label' =>'<hr>',
        'description' => esc_html__('Fill Button Background Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[fill_button_bg_color_left]',
        'section' => 'cynic_theme_button_variations',
    )
));
$wp_customize->add_setting('cynic_theme[fill_button_bg_color_right]',
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
    'cynic_theme[fill_button_bg_color_right]',
    array(
        'description' => esc_html__('Fill Button Background Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[fill_button_bg_color_right]',
        'section' => 'cynic_theme_button_variations',
    )
));


// Fill Button Hover Background Color
$wp_customize->add_setting('cynic_theme[fill_button_hvr_bg_color_left]',
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
    'cynic_theme[fill_button_hvr_bg_color_left]',
    array(
        'description' => esc_html__('Fill Button Background Hover Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[fill_button_hvr_bg_color_left]',
        'section' => 'cynic_theme_button_variations',
    )
));
$wp_customize->add_setting('cynic_theme[fill_button_hvr_bg_color_right]',
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
    'cynic_theme[fill_button_hvr_bg_color_right]',
    array(
        'description' => esc_html__('Fill Button Background Hover Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[fill_button_hvr_bg_color_right]',
        'section' => 'cynic_theme_button_variations',
    )
));




