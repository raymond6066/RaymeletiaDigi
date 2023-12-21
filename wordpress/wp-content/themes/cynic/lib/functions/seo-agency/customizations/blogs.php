<?php

$wp_customize->add_section('cynic_theme_general_blog_color',
    array(
        'title' => __('Blog Colors', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize blog colors.', 'cynic'), //Descriptive tooltip
    )
);


/** ########### Blog ##############**/

$wp_customize->add_setting('cynic_theme[blog_banner_post_info_link_color]',
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
    'cynic_theme[blog_banner_post_info_link_color]',
    array(
        'description' => esc_html__('Blog Attribute Text Color', 'cynic'),
        'settings' => 'cynic_theme[blog_banner_post_info_link_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));


$wp_customize->add_setting('cynic_theme[blog_banner_post_info_link_hover_color]',
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
    'cynic_theme[blog_banner_post_info_link_hover_color]',
    array(
        'description' => esc_html__('Blog Attribute Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[blog_banner_post_info_link_hover_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));

$wp_customize->add_setting('cynic_theme[blog_sticky_post_left_border_color]',
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
    'cynic_theme[blog_sticky_post_left_border_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Sticky Post Left Border Color', 'cynic'),
        'settings' => 'cynic_theme[blog_sticky_post_left_border_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));

$wp_customize->add_setting('cynic_theme[blog_sticky_post_background_color]',
    array(
        'default' => '#f6f6f6',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[blog_sticky_post_background_color]',
    array(
        'description' => esc_html__('Sticky Post Background Color', 'cynic'),
        'settings' => 'cynic_theme[blog_sticky_post_background_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));



$wp_customize->add_setting('cynic_theme[widget_search_field_bottom_border_color]',
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
    'cynic_theme[widget_search_field_bottom_border_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Search Box Border Line Color', 'cynic'),
        'settings' => 'cynic_theme[widget_search_field_bottom_border_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));


$wp_customize->add_setting('cynic_theme[widget_search_field_focus_bottom_border_color]',
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
    'cynic_theme[widget_search_field_focus_bottom_border_color]',
    array(
        'description' => esc_html__('Search Box Border Focus Line Color', 'cynic'),
        'settings' => 'cynic_theme[widget_search_field_focus_bottom_border_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));


$wp_customize->add_setting('cynic_theme[widget_bottom_border_color]',
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
    'cynic_theme[widget_bottom_border_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Right Widget Border Line Color', 'cynic'),
        'settings' => 'cynic_theme[widget_bottom_border_color]',
        'section' => 'cynic_theme_general_blog_color',
    )
));











