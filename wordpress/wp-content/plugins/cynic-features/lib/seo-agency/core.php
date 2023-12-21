<?php

require_once AXILWEB_PLUGIN_PATH . '/lib/seo-agency/CynicSEOPostTypes.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/seo-agency/cynic-caviar-icons.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/seo-agency/cynicSEO-global-functions.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/seo-agency/ajax_requests.php';


class CynicFeaturesSEO
{

    public static $instance, $url;
    public $_post_types, $codeMap;

    public function __construct()
    {

        $this->_post_types = new CynicSEOPostTypes();

        self::$url = AXILWEB_CYNIC_FEATURE_PLUGIN_URL;
        /** @internal */

        add_action('wp_enqueue_scripts', array($this, '_enqueue_front_scripts'));

        add_action('plugins_loaded', array($this, 'loadVcElements'), 1000);

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


    public function loadVcElements()
    {
        if (class_exists('Vc_Manager')) {
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
    }

    public function _enqueue_front_scripts()
    {
        wp_enqueue_script('cynic-feature-plugin', self::$url . 'assets/seo-agency/js/scripts.js', array('jquery', 'slick', 'typed'), CYNIC_FEATURE_PLUGIN_VERSION, true);
        wp_enqueue_style('century_coding_front', self::$url . 'assets/seo-agency/css/century-shortcodes.css', array(), CYNIC_FEATURE_PLUGIN_VERSION);
    }

    /**
     * @abstract create and return instance of the class
     * @return object
     */
    public static function loadPlugin()
    {
        if (!self::$instance instanceof CynicFeaturesSEO) {
            self::$instance = new CynicFeaturesSEO;
        }
        return self::$instance;
    }

}

$CynicFeatures = CynicFeaturesSEO::loadPlugin();