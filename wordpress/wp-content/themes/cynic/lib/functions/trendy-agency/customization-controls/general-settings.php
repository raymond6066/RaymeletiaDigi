<?php
/* General Settings */
$wp_customize->add_panel('general-settings', array(
    'title' => 'General Settings',
    'description' => 'General Settings Panel',
    'priority' => 100,
));

$wp_customize->add_section('theme-layout',
    array(
        'title' => __('Theme Layout', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Layout Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_layouts',
    array(
        'default' => '1',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control($wp_customize, 'cynic_layouts',
    array(
        'label' => __('Select Layout of the theme', 'cynic'),
        'section' => 'theme-layout',
        'settings' => 'cynic_layouts',
        'choices' => array(
            '1' => __('Multipage'),
            '2' => __('Onepage'),
        )
    )
));


$wp_customize->add_section('related-cs-settings',
    array(
        'title' => __('Single Page Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Page Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_cs_page_link', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_cs_page_link', array(
    'type' => 'dropdown-pages',
    'section' => 'related-cs-settings', // Add a default or your own section
    'label' => esc_html__('Page Link', 'cynic'),
    'description' => esc_html__('Set Page Link For Related Case Studies', 'cynic'),
));

$wp_customize->add_setting('cynic_case_studies_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => 'Discover More',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_case_studies_button_text', array(
    'type' => 'text',
    'section' => 'related-cs-settings', // Add a default or your own section
    'label' => esc_html__('Button Text', 'cynic'),
    'description' => esc_html__('Set Button Text For Related Case Studies', 'cynic'),
));

/* 404 Page Settings */
$wp_customize->add_section('404-settings',
    array(
        'title' => __('404 Page Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set 404 Page Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_404_header_color',
    array(
        'default' => 'right',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_404_header_color',
    array(
        'label' => __('Page Header Color', 'cynic'),
        'section' => '404-settings',
        'choices' => array(
            '1' => __('Primary'), // Required. Setting for this particular radio button choice and the text to display
            '2' => __('Secondary'), // Required. Setting for this particular radio button choice and the text to display
            '3' => __('Tertiary') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_404_title', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_404_title', array(
    'type' => 'textarea',
    'section' => '404-settings', // Add a default or your own section
    'label' => esc_html__('404 Page Title', 'cynic'),
));

$wp_customize->add_setting('cynic_404_subtitle', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_404_subtitle', array(
    'type' => 'textarea',
    'section' => '404-settings', // Add a default or your own section
    'label' => esc_html__('404 Page Subtitle', 'cynic'),
));

$wp_customize->add_setting('cynic_404_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_404_button_text', array(
    'type' => 'textarea',
    'section' => '404-settings', // Add a default or your own section
    'label' => esc_html__('404 Page Button Text', 'cynic'),
));

$wp_customize->add_setting('cynic_404_button_link', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_404_button_link', array(
    'type' => 'dropdown-pages',
    'section' => '404-settings', // Add a default or your own section
    'label' => esc_html__('404 Page Button Link', 'cynic'),
));

$wp_customize->add_setting('cynic_404_banner_image', array(
    'default' => CYNIC_THEME_URI . '/images/trendy-agency/banner-404.png',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));

$wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'cynic_404_banner_image', array(
        'label' => __('404 Banner Image', 'cynic'),
        'section' => '404-settings',
        'settings' => 'cynic_404_banner_image',
    ))
);

/* Search Result Page Settings */
$wp_customize->add_section('search-settings',
    array(
        'title' => __('Search Page Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Search Page Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_search_header_color',
    array(
        'default' => 'right',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_search_header_color',
    array(
        'label' => __('Page Header Color', 'cynic'),
        'section' => 'search-settings',
        'choices' => array(
            '1' => __('Primary'), // Required. Setting for this particular radio button choice and the text to display
            '2' => __('Secondary'), // Required. Setting for this particular radio button choice and the text to display
            '3' => __('Tertiary') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_search_title', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_search_title', array(
    'type' => 'textarea',
    'section' => 'search-settings', // Add a default or your own section
    'label' => esc_html__('Search Page Title', 'cynic'),
));

$wp_customize->add_setting('cynic_search_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_search_button_text', array(
    'type' => 'textarea',
    'section' => 'search-settings', // Add a default or your own section
    'label' => esc_html__('Search Page Button Text', 'cynic'),
));

$wp_customize->add_setting('cynic_subtitle', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_subtitle', array(
    'type' => 'textarea',
    'section' => 'search-settings', // Add a default or your own section
    'label' => esc_html__('Search Page Subtitle', 'cynic'),
));