<?php

$wp_customize->add_section('cynic_theme_general_link_colors',
    array(
        'title' => __('Link Colors', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize Revolution Slider content color.', 'cynic'), //Descriptive tooltip
    )
);



// Link Text color
$wp_customize->add_setting('cynic_theme[link_text_color]',
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
    'cynic_theme[link_text_color]',
    array(
        'label'=>'Links <hr class="hr2">',
        'description' => esc_html__('Link Text Color', 'cynic'),
        'settings' => 'cynic_theme[link_text_color]',
        'section' => 'cynic_theme_general_link_colors',
    )
));

// Link Text Hover color
$wp_customize->add_setting('cynic_theme[link_hover_text_color]',
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
    'cynic_theme[link_hover_text_color]',
    array(
        'description' => esc_html__('Link Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[link_hover_text_color]',
        'section' => 'cynic_theme_general_link_colors',
    )
));

$wp_customize->add_setting('cynic_theme[read_more_link_text_color]',
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
    'cynic_theme[read_more_link_text_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Read More Link Text Color', 'cynic'),
        'settings' => 'cynic_theme[read_more_link_text_color]',
        'section' => 'cynic_theme_general_link_colors',
    )
));


$wp_customize->add_setting('cynic_theme[read_more_link_text_hover_color]',
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
    'cynic_theme[read_more_link_text_hover_color]',
    array(
        'description' => esc_html__('Read More Link Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[read_more_link_text_hover_color]',
        'section' => 'cynic_theme_general_link_colors',
    )
));



$wp_customize->add_setting('cynic_theme[featured_portfolio_box_links_color]',
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
    'cynic_theme[featured_portfolio_box_links_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Our Work Link Hover Color', 'cynic'),
        'settings' => 'cynic_theme[featured_portfolio_box_links_color]',
        'section' => 'cynic_theme_general_link_colors',
    )
));
