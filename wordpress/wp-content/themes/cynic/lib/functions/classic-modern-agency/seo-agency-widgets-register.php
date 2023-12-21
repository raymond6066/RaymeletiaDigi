<?php
/**
 * Register Widgets
 */


$widgetCynicOptions = get_option('cynic_options');

if (cynic_demoImportModeIsEnabled()) {

    add_action('widgets_init', 'cynic_seo_widgets_init');

    function cynic_seo_widgets_init()
    {

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

    require_once CYNIC_THEME_CORE_FUNCTIONS . 'seo-agency/widgets/class-seo-agency-wp-widget-recent-posts.php';
    require_once CYNIC_THEME_CORE_FUNCTIONS . 'seo-agency/widgets/class-seo-agency-wp-widget-career.php';
    require_once CYNIC_THEME_CORE_FUNCTIONS . 'seo-agency/widgets/class-seo-agency-wp-widget-newsletter.php';
    require_once CYNIC_THEME_CORE_FUNCTIONS . 'seo-agency/widgets/class-seo-agency-wp-widget-gallery.php';

}
