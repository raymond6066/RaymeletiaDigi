<?php

require_once AXILWEB_PLUGIN_PATH . '/lib/trendy-agency/CynicTrendyPostTypes.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/trendy-agency/cynic-trendy-global-functions.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/trendy-agency/minilineicons.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/trendy-agency/ajax_requests.php';

class CynicFeatures
{

    public static $instance, $url;
    public $_post_types, $codeMap;

    public function __construct()
    {

        $this->_post_types = new CynicTrendyPostTypes();

        self::$url = AXILWEB_CYNIC_FEATURE_PLUGIN_URL;
        /** @internal */


        add_action('wp_enqueue_scripts', array($this, '_enqueue_front_scripts'));

        add_action('plugins_loaded', array($this, 'loadVcElements'), 1000);

        add_action('wp', array($this, 'cynic_wp_init'), 20);

        add_action('wp_enqueue_scripts', array($this, '_enqueue_vc_scripts'));

        add_filter('wp_kses_allowed_html', array($this, '_kses_allow_htmls'), 2000, 2);
    }

    public function _kses_allow_htmls($tags, $context)
    {
        if (isset($tags['span'])) {
            $tags['span']['class'] = 1;
        }
        if (!isset($tags['iframe'])) {
            $tags['iframe'] = array();
            $tags['iframe']['src'] = 1;
            $tags['iframe']['frameborder'] = 1;
            $tags['iframe']['style'] = 1;
            $tags['iframe']['allowfullscreen'] = 1;
            $tags['iframe']['width'] = 1;
            $tags['iframe']['height'] = 1;
        }
        return $tags;
    }

    public function _enqueue_vc_scripts()
    {

        if (function_exists('visual_composer')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    public function cynic_wp_init()
    {
        if (!is_single()) {
            remove_filter('the_content', 'wpautop');
        }

    }

    public function loadVcElements()
    {
        if (is_dir(AXILWEB_SHORTCODE_PATH) && $cc_dirhandle = opendir(AXILWEB_SHORTCODE_PATH)) {
            while ($cc_file = readdir($cc_dirhandle)) {
                if (!in_array($cc_file, array('.', '..'))) {
                    $cc_file_contents = file_get_contents(AXILWEB_SHORTCODE_PATH . '/' . $cc_file);
                    $cc_php_file_tokens = token_get_all($cc_file_contents);
                    require_once(AXILWEB_SHORTCODE_PATH . '/' . $cc_file);
                    foreach ($cc_php_file_tokens as $cc_current_index => $cc_file_single_token) {
                        if ($cc_file_single_token[0] == T_CLASS) {
                            if (strpos($cc_php_file_tokens[$cc_current_index + 2][1], 'WPBakeryShortCode') === FALSE) {
                                if (class_exists($cc_php_file_tokens[$cc_current_index + 2][1])) {
                                    new $cc_php_file_tokens[$cc_current_index + 2][1];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function _enqueue_front_scripts()
    {
        $theme_type = CYNIC_THEME_TYPE;
        if( $theme_type != "trendy-agency"){
            wp_enqueue_script('cynic-plugin-main', self::$url . 'assets/trendy-agency/js/plugin-scripts.js', array('jquery', 'magnific-popup'), CYNIC_FEATURE_PLUGIN_VERSION, true);
        }

        wp_enqueue_style('century_coding_front', self::$url . '/assets/trendy-agency/css/cynic-shortcodes.css', "", CYNIC_FEATURE_PLUGIN_VERSION);
    }

    /**
     * @abstract create and return instance of the class
     * @return object
     */
    public static function loadPlugin()
    {
        if (!self::$instance instanceof CynicFeatures) {
            self::$instance = new CynicFeatures;
        }
        return self::$instance;
    }

}

$CynicFeatures = CynicFeatures::loadPlugin();