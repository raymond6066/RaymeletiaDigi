<?php
/**
 * Author: Axilweb
 * Website: http://www.axilweb.com
 */
require_once CYNIC_THEME_CORE_INCLUDES . 'class-illustration-agency-walker-nav-menu.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/cynic-illustration-social-widgets.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/cynic-illustration-widget-recent-posts.php';


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




/**
 * Aallowed svg types
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 */
function cynic_illustration_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cynic_illustration_mime_types');
