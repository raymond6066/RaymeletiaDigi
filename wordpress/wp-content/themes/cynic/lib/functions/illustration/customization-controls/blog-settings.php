<?php
/* General Settings */
if (get_theme_mod('cynic_layouts') == 1) {
    $wp_customize->add_panel('blog', array(
        'title' => 'Blog',
        'description' => 'General Settings Panel',
        'priority' => 18,
    ));

    $wp_customize->add_section('blog-general-settings',
        array(
            'title' => __('General Settings', 'cynic'), //Visible title of section
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'panel' => 'blog',
        )
    );

    $wp_customize->add_setting('cynic_breadcrumb_blog_title', array(
        'capability' => 'edit_theme_options',
        'default' => 'News',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('cynic_breadcrumb_blog_title', array(
        'type' => 'text',
        'section' => 'blog-general-settings', // Add a default or your own section
        'settings' => 'cynic_breadcrumb_blog_title',
        'label' => __('Blog Page Title', 'cynic'),
    ));

//    $wp_customize->add_setting('cynic_author_info',
//        array(
//            'default' => false,
//            'transport' => 'refresh',
//            'sanitize_callback' => 'skyrocket_switch_sanitization'
//        )
//    );
//
//    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control(
//        $wp_customize,
//        'cynic_author_info',
//        array(
//            'label' => __('Display Author Info', 'cynic'),
//            'section' => 'blog-general-settings',
//            'settings' => 'cynic_author_info',
//        )
//    ));

    $wp_customize->add_setting('cynic_blog_sidebar',
        array(
            'default' => 1,
            'transport' => 'refresh',
            'sanitize_callback' => 'skyrocket_text_sanitization'
        )
    );
    $wp_customize->add_control(new Skyrocket_Image_Radio_Button_Custom_Control(
        $wp_customize,
        'cynic_blog_sidebar',
        array(
            'label' => __('Blog Sidebar', 'cynic'),
            'description' => esc_html__('Enable/Disable sidebar', 'cynic'),
            'section' => 'blog-general-settings',
            'settings' => 'cynic_blog_sidebar',
            'choices' => array(
                0 => array(
                    'image' => trailingslashit(get_template_directory_uri()) . 'lib/functions/trendy-agency/customizer-custom-controls/images/sidebar-none.png',
                    'name' => __('No Sidebar')
                ),
                1 => array(
                    'image' => trailingslashit(get_template_directory_uri()) . 'lib/functions/trendy-agency/customizer-custom-controls/images/sidebar-right.png',
                    'name' => __('Right Sidebar')
                )
            )
        )
    ));

    $wp_customize->add_setting('cynic_blog_single_sidebar',
        array(
            'default' => 1,
            'transport' => 'refresh',
            'sanitize_callback' => 'skyrocket_text_sanitization'
        )
    );

    $wp_customize->add_control(new Skyrocket_Image_Radio_Button_Custom_Control(
        $wp_customize,
        'cynic_blog_single_sidebar',
        array(
            'label' => __('Blog Single Page Sidebar', 'cynic'),
            'description' => esc_html__('Enable/Disable sidebar', 'cynic'),
            'section' => 'blog-general-settings',
            'settings' => 'cynic_blog_single_sidebar',
            'choices' => array(
                0 => array(
                    'image' => trailingslashit(get_template_directory_uri()) . 'lib/functions/trendy-agency/customizer-custom-controls/images/sidebar-none.png',
                    'name' => __('No Sidebar')
                ),
                1 => array(
                    'image' => trailingslashit(get_template_directory_uri()) . 'lib/functions/trendy-agency/customizer-custom-controls/images/sidebar-right.png',
                    'name' => __('Right Sidebar')
                )
            )
        )
    ));

    /*Comments Settings*/

    $wp_customize->add_section('blog-comments-settings',
        array(
            'title' => __('Comments', 'cynic'), //Visible title of section
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'panel' => 'blog',
        )
    );

    $wp_customize->add_setting('cynic_blog_comment_section',
        array(
            'default' => 1,
            'transport' => 'refresh',
            'sanitize_callback' => 'skyrocket_switch_sanitization'
        )
    );

    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_blog_comment_section',
        array(
            'label' => __('Show Comment Section in Blog', 'cynic'),
            'section' => 'blog-comments-settings',
            'settings' => 'cynic_blog_comment_section',
        )
    ));

//    /* Previous & Next Settings */
//    $wp_customize->add_section('prev-next-settings',
//        array(
//            'title' => __('Previous & Next', 'cynic'), //Visible title of section
//            'capability' => 'edit_theme_options', //Capability needed to tweak
//            'panel' => 'blog',
//        )
//    );
//
//    $wp_customize->add_setting('cynic_blog_prev_next_botton',
//        array(
//            'default' => 1,
//            'transport' => 'refresh',
//            'sanitize_callback' => 'skyrocket_switch_sanitization'
//        )
//    );
//
//    $wp_customize->add_control(new Skyrocket_Toggle_Switch_Custom_control($wp_customize, 'cynic_blog_prev_next_botton',
//        array(
//            'label' => __('Display Prev & Next Button', 'cynic'),
//            'section' => 'prev-next-settings',
//            'settings' => 'cynic_blog_prev_next_botton',
//        )
//    ));
//
//    $wp_customize->add_setting('cynic_blog_prev_button_text', array(
//        'capability' => 'edit_theme_options',
//        'default' => 'Prev',
//        'sanitize_callback' => 'sanitize_text_field',
//    ));
//
//    $wp_customize->add_control('cynic_blog_prev_button_text', array(
//        'type' => 'text',
//        'section' => 'prev-next-settings', // Add a default or your own section
//        'settings' => 'cynic_blog_prev_button_text',
//        'label' => __('Previous Button Text', 'cynic'),
//    ));
//
//    $wp_customize->add_setting('cynic_blog_next_button_text', array(
//        'capability' => 'edit_theme_options',
//        'default' => 'Next',
//        'sanitize_callback' => 'sanitize_text_field',
//    ));
//
//    $wp_customize->add_control('cynic_blog_next_button_text', array(
//        'type' => 'text',
//        'section' => 'prev-next-settings', // Add a default or your own section
//        'settings' => 'cynic_blog_next_button_text',
//        'label' => __('Next Button Text', 'cynic'),
//    ));
}