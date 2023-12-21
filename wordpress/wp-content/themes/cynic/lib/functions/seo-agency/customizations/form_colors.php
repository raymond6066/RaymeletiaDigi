<?php

$wp_customize->add_section('cynic_theme_general_global_form_colors',
    array(
        'title' => __('Form Colors', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize Revolution Slider content color.', 'cynic'), //Descriptive tooltip
    )
);



// Input field
$wp_customize->add_setting('cynic_theme[global_form_control_input_field_border_color]',
    array(
        'default' => '#e6e6e6',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[global_form_control_input_field_border_color]',
    array(
        'label'=>'Form Colors <hr class="hr2">',
        'description' => esc_html__('Input Field Border Color', 'cynic'),
        'settings' => 'cynic_theme[global_form_control_input_field_border_color]',
        'section' => 'cynic_theme_general_global_form_colors',
    )
));

$wp_customize->add_setting('cynic_theme[global_form_control_input_field_focus_border_color]',
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
    'cynic_theme[global_form_control_input_field_focus_border_color]',
    array(
        'description' => esc_html__('Input Field Border Focus Color', 'cynic'),
        'settings' => 'cynic_theme[global_form_control_input_field_focus_border_color]',
        'section' => 'cynic_theme_general_global_form_colors',
    )
));


$wp_customize->add_setting('cynic_theme[global_form_control_check_box_color]',
    array(
        'default' => '#bebebe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[global_form_control_check_box_color]',
    array(
        'description' => esc_html__('Checkbox Color', 'cynic'),
        'settings' => 'cynic_theme[global_form_control_check_box_color]',
        'section' => 'cynic_theme_general_global_form_colors',
    )
));

$wp_customize->add_setting('cynic_theme[global_form_control_check_box_active_color]',
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
    'cynic_theme[global_form_control_check_box_active_color]',
    array(
        'description' => esc_html__('Checkbox Active Color', 'cynic'),
        'settings' => 'cynic_theme[global_form_control_check_box_active_color]',
        'section' => 'cynic_theme_general_global_form_colors',
    )
));



