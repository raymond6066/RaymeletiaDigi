<?php

/**
 * Register Widgets
 */
add_action('widgets_init', 'cynic_widgets_init');

function cynic_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Blog Sidebar', 'cynic'),
        'id' => 'blog-sidebar',
        'description' => esc_html__('Blog sidebar', 'cynic'),
        'before_widget' => '<div id="%1$s" class="widget blog-sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title font-alt">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Social Media Widget', 'cynic'),
        'id' => 'social-media-widget',
        'description' => esc_html__('Footer sidebar 5', 'cynic'),
        'before_widget' => '<div id="%1$s" class="footer-widget footer-social-media-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-nav-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Services Widget', 'cynic'),
        'id' => 'services-widget',
        'description' => esc_html__('Footer Services Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-nav-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Support Widget', 'cynic'),
        'id' => 'support-widget',
        'description' => esc_html__('Footer Support Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-nav-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Resources Widget', 'cynic'),
        'id' => 'resources-widget',
        'description' => esc_html__('Footer Resources Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-nav-title">',
        'after_title' => '</h5>',
    ));
}