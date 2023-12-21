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
        'before_title' => '<h3 class="widget-heading font-alt">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Services Widget', 'cynic'),
        'id' => 'services-widget',
        'description' => esc_html__('Footer Services Widget', 'cynic'),
        'before_widget' => '<div class="footer-mid-nav">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="nav-item">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer About Widget', 'cynic'),
        'id' => 'about-widget',
        'description' => esc_html__('Footer About Widget', 'cynic'),
        'before_widget' => '<div class="footer-mid-nav">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="nav-item">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Partners Widget', 'cynic'),
        'id' => 'partners-widget',
        'description' => esc_html__('Footer Partners Widget', 'cynic'),
        'before_widget' => '<div class="footer-mid-nav partners-list">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="nav-item">',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Newsletter Widget', 'cynic'),
        'id' => 'newsletter-widget',
        'description' => esc_html__('Footer Newsletter Widget', 'cynic'),
        'before_widget' => '<div class="footer-mid-nav">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="nav-item">',
        'after_title' => '</h6>',
    ));

    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_theme_mode']) && $cynic_options['cynic_theme_mode'] != 1) {
        register_sidebar(array(
            'name' => esc_html__('Online Submit Form Widget', 'cynic'),
            'id' => 'cynic-online-submit-form',
            'description' => esc_html__('Online Submit Form Widget', 'cynic'),
            'before_widget' => '<ul class="footer-mid-nav">',
            'after_widget' => '</ul>',
            'before_title' => '<li class="nav-item">',
            'after_title' => '</li>',
        ));
    }
}