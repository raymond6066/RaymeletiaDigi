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
/* 404 Page Settings */
$wp_customize->add_section('404-settings',
    array(
        'title' => __('404 Page Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set 404 Page Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

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
    'default' => CYNIC_THEME_URI . '/images/illustration/banner-404.png',
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

/* Mailchimp Form Settings */
$wp_customize->add_section('mailchimp-form-settings',
    array(
        'title' => __('Form Settings', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Set Bottom Footer FOrm Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_mc_form_title', array(
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_form_title', array(
    'type' => 'textarea',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Form Title', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_form_shortcode', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_form_shortcode', array(
    'type' => 'textarea',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Form Shortcode', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_follow_us_text', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_follow_us_text', array(
    'type' => 'textarea',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us Text', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_facebook', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_facebook', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Facebook', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_twitter', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_twitter', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Twitter', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_youtube', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_youtube', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Youtube', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_google', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_google', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Google Plus', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_instagram', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_instagram', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Instagram', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_pinterest', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_pinterest', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Pinterest', 'cynic'),
));

$wp_customize->add_setting('cynic_mc_linkedin', array(
    'default' => '#',
    'capability' => 'edit_theme_options',
    'default' => '',
));

$wp_customize->add_control('cynic_mc_linkedin', array(
    'type' => 'textfield',
    'section' => 'mailchimp-form-settings', // Add a default or your own section
    'label' => esc_html__('Follow Us On Linkedin', 'cynic'),
));





$wp_customize->add_section('cynic-allowed-extra-options-settings',
    array(
        'title' => __('Allowed Extra Options', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Settings.', 'cynic'), //Descriptive tooltip
        'panel' => 'general-settings',
    )
);

$wp_customize->add_setting('cynic_allowed_svg_types',
    array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_switch_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_allowed_svg_types',
    array(
        'label' => esc_html__('Aallowed svg types', 'cynic'),
        'section' => 'cynic-allowed-extra-options-settings'
    )
));