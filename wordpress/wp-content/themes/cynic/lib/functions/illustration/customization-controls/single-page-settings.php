<?php
/* Single Page Settings */
$wp_customize->add_panel('single-page-settings', array(
    'title' => 'Single Page Settings',
    'description' => 'Single Page Settings Panel',
    'priority' => 100,
));

/* Blog Settings */
$wp_customize->add_section('blog-settings',
    array(
        'title' => __('Blog', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Blog Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'single-page-settings',
    )
);

$wp_customize->add_setting('cynic_single_blog_page_banner',
    array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_switch_sanitization'
    )
);
$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_single_blog_page_banner',
    array(
        'label' => esc_html__('Display Banner Area', 'cynic'),
        'section' => 'blog-settings'
    )
));

$wp_customize->add_setting('cynic_single_blog_page_title', array(
    'capability' => 'edit_theme_options',
    'default' => 'News Details Page',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_single_blog_page_title', array(
    'type' => 'text',
    'section' => 'blog-settings', // Add a default or your own section
    'label' => esc_html__('Page Title', 'cynic'),
    'description' => esc_html__('Set Title For Single News Page', 'cynic'),
));


$wp_customize->add_setting('cynic_single_blog_page_description', array(
    'capability' => 'edit_theme_options',
    'default' => esc_html__('Learn how we helped our several clients grow in online business.It will give you an idea of our capabilities.', 'cynic'),
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('cynic_single_blog_page_description', array(
    'type' => 'textarea',
    'section' => 'blog-settings', // Add a default or your own section
    'label' => esc_html__('Page Description', 'cynic'),
    'description' => esc_html__('Set Description For Single News Page', 'cynic'),
));

$wp_customize->add_setting('cynic_single_blog_page_banner_image', array(
    'default' => CYNIC_THEME_URI . '/images/illustration/news-details-banner.png',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
));

$wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'cynic_single_blog_page_banner_image', array(
        'label' => __('Single News Banner Image', 'cynic'),
        'section' => 'blog-settings',
    ))
);







$wp_customize->add_setting('cynic_blog_block_title', array(
    'capability' => 'edit_theme_options',
    'default' => 'Related Blog',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_blog_block_title', array(
    'type' => 'text',
    'section' => 'blog-settings', // Add a default or your own section
    'label' => esc_html__('Block Text', 'cynic'),
    'description' => esc_html__('Set Title For Related Blog', 'cynic'),
));


$wp_customize->add_setting('cynic_blog_page_link', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_blog_page_link', array(
    'type' => 'dropdown-pages',
    'section' => 'blog-settings', // Add a default or your own section
    'label' => esc_html__('Page Link', 'cynic'),
    'description' => esc_html__('Set Page Link For Related Blog', 'cynic'),
));

$wp_customize->add_setting('cynic_blog_button_text', array(
    'capability' => 'edit_theme_options',
    'default' => 'Discover More',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_blog_button_text', array(
    'type' => 'text',
    'section' => 'blog-settings', // Add a default or your own section
    'label' => esc_html__('Button Text', 'cynic'),
    'description' => esc_html__('Set Button Text For Related Blog', 'cynic'),
));

/*Case Studies Settings*/
$wp_customize->add_section('case-studies-settings',
    array(
        'title' => __('Case Studies', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Case Studies Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'single-page-settings',
    )
);

$wp_customize->add_setting('cynic_case_studies_block_title', array(
    'capability' => 'edit_theme_options',
    'default' => 'Case Studies',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('cynic_case_studies_block_title', array(
    'type' => 'text',
    'section' => 'case-studies-settings', // Add a default or your own section
    'label' => esc_html__('Button Text', 'cynic'),
    'description' => esc_html__('Set Title For Related Case Studies Block', 'cynic'),
));


$wp_customize->add_setting('cynic_cs_page_link', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_cs_page_link', array(
    'type' => 'dropdown-pages',
    'section' => 'case-studies-settings', // Add a default or your own section
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
    'section' => 'case-studies-settings', // Add a default or your own section
    'label' => esc_html__('Button Text', 'cynic'),
    'description' => esc_html__('Set Button Text For Related Case Studies', 'cynic'),
));
