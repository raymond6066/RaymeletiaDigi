<?php
/**
 * Plugin Name: Cynic Theme Features
 * Description: A standalone features plugin for Cynic WordPress Theme
 * Version: 1.1
 * Author: Axilweb
 * Requires at least: 4.5.3
 * Tested up to: 4.7.5
 *
 * Text Domain: cynic
 *
 * @package cynic-features
 * @category Core
 * @author Axilweb
 */
if (!defined('ABSPATH'))
    die('No script kiding please');

if (!defined('CYNIC_THEME_TYPE')) {
    $theme_setup = get_option('cynic_theme_type');
    if (empty($theme_setup)) {
        $theme_setup = 'classic-modern-agency';
    }
    define('CYNIC_THEME_TYPE', $theme_setup);
}

define('CYNIC_FEATURE_PLUGIN_VERSION', '1.6.1');
define('AXILWEB_JAVASCRIPTVOID', 'javascript:void(0)');
define('AXILWEB_CYNIC_FEATURE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AXILWEB_PLUGIN_PATH', dirname(__FILE__));
define('AXILWEB_SHORTCODE_PATH', AXILWEB_PLUGIN_PATH . '/shortcodes/' . CYNIC_THEME_TYPE);

require_once AXILWEB_PLUGIN_PATH . '/lib/cynic_feature_common_functions.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/' . CYNIC_THEME_TYPE . '/core.php';
require_once AXILWEB_PLUGIN_PATH . '/importer/one-click-demo-import.php';


########### Below code for changing cynic_theme_type and demo import form
add_action('admin_menu', 'cynic_feature_demo_layout_selector_menu');

/** Step 1. */
function cynic_feature_demo_layout_selector_menu()
{
    $settings = array(
        'parent_slug' => 'themes.php',
        'page_title' => esc_html__('Import Demo Data', 'cynic'),
        'menu_title' => esc_html__('Import Demo Data', 'cynic'),
        'capability' => 'import',
        'menu_slug' => 'cynic-themes-layout',
    );
    add_submenu_page(
        $settings['parent_slug'],
        $settings['page_title'],
        $settings['menu_title'],
        $settings['capability'],
        $settings['menu_slug'],
        'cynic_theme_type_selector_form'
    );
}

/** Step 2. */
function cynic_theme_type_selector_form()
{
    if (!current_user_can('import')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    $layoutAll = array(
        array('name' => 'Digital Agency', 'src' => AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/images/digital-agency.jpg', 'categories' => 'digitalagency', 'cynic_theme_type' => 'classic-modern-agency'),
        array('name' => 'SEO Agency', 'src' => AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/images/seo-agency.jpg', 'categories' => 'seoagency', 'cynic_theme_type' => 'seo-agency'),
        array('name' => 'Trendy Agency', 'src' => AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/images/trendy-agency.jpg', 'categories' => 'trendyagency', 'cynic_theme_type' => 'trendy-agency'),
        array('name' => 'Illustration', 'src' => AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/images/illustration-step1.png', 'categories' => 'illustration', 'cynic_theme_type' => 'illustration')
    );
    ?>
    <h3 class="hndle">Select Cynic Theme Layouts</h3>
    <div class="cynic_feaute_plugin postbox" id="boxid">
        <div title="Click to toggle" class="handlediv"><br></div>
        <div class="inside">
            <form id="cynic_feature_theme_layout_update_form">
                    <?php
                    foreach ($layoutAll as $key => $val) {
                        ?>
                        <div class="cynic_theme_type_item <?php echo esc_attr(($val['cynic_theme_type']==CYNIC_THEME_TYPE)?'active':'') ?>">
                            <a href="#"><img data-theme-type="<?php echo esc_attr($val['cynic_theme_type']) ?>" data-category="<?php echo esc_attr($val['categories']) ?>"  class="theme_type_selectorbtn" src="<?php echo esc_url($val['src']) ?>"></a>
                        </div>
                        <?php
                    }
                    ?>
            </form>
        </div>
    </div>
    <?php
}