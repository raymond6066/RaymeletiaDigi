<?php
/**
 * Author: Axilweb
 * Website: http://www.axilweb.com
 */
//echo CYNIC_THEME_CORE_INCLUDES;exit();
require_once CYNIC_THEME_CORE_INCLUDES . 'class-seo-agency-walker-nav-menu.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'class-seo-agency-top-menu-walker.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'theme-config.php';

require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/class-seo-agency-wp-widget-recent-posts.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/class-seo-agency-customer-reviews.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/class-seo-agency-wp-widget-career.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/class-seo-agency-wp-widget-newsletter.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/class-seo-agency-wp-widget-gallery.php';

require_once CYNIC_THEME_CORE_INCLUDES . 'customization.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'style.php';

/**
 * Theme Setup
 */

require_once CYNIC_THEME_CORE_INCLUDES.'functions/theme-setup.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/enqueue-scripts.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/nav-menu.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/widgets-register.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/comment-functions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/page-header-functions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'functions/cynic-custom-category-features.php';