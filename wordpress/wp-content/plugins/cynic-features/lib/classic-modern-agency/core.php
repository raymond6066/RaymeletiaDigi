<?php

require_once AXILWEB_PLUGIN_PATH . '/lib/classic-modern-agency/CynicPostTypes.php';
require_once AXILWEB_PLUGIN_PATH . '/lib/classic-modern-agency/linearicons.php';


class CynicFeatures
{

    public static $instance, $url;
    public $_post_types, $codeMap;

    public function __construct()
    {

        $this->_post_types = new CynicPostTypes();

        self::$url = AXILWEB_CYNIC_FEATURE_PLUGIN_URL;
        /** @internal */
        add_action('wp_ajax_cynic_get_custom_content', array($this, 'cynic_get_custom_content'));

        add_action('wp_ajax_nopriv_cynic_get_custom_content', array($this, 'cynic_get_custom_content'));

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
        //wp_enqueue_style('century_coding_front', self::$url . 'assets/css/century-shortcodes.css');
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

    public static function hex2rgb($color)
    {
        $color = trim($color, '#');

        if (strlen($color) === 3) {
            $r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
            $g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
            $b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
        } else if (strlen($color) === 6) {
            $r = hexdec(substr($color, 0, 2));
            $g = hexdec(substr($color, 2, 2));
            $b = hexdec(substr($color, 4, 2));
        } else {
            return array();
        }

        return array('red' => $r, 'green' => $g, 'blue' => $b);
    }

    public function cynic_get_custom_content()
    {
        if (isset($_POST['posttype']) && isset($_POST['postid']) && $_POST['postid'] && $_POST['posttype']) {
            $post_type = $_POST['posttype'];

            if (in_array($post_type, array('portfolio', 'page', 'post', 'positions'))) {
                global $wp_query;
                $args = array(
                    'post_type' => $post_type,
                    'post__in' => array((int)$_POST['postid']),
                    'showposts' => 1,
                );
                if ($post_type == 'page') {
                    $args['page_id'] = (int)$_POST['postid'];
                } else {
                    $args['static'] = '1';
                }
                if (class_exists('WPBMap')) { // load visual composer shortcodes
                    WPBMap::addAllMappedShortcodes();
                }
                query_posts($args);

                switch ($post_type) {
                    case 'portfolio':
                        $template = locate_template('single-portfolio.php', false);
                        break;
                    case 'positions':
                        $template = locate_template('single-positions.php', false);
                        break;
                    case 'post':
                        $template = locate_template('single.php', false);
                        break;
                    default:
                        $template = get_page_template();
                        break;
                }
                load_template($template, true);
            }
        }
        die();
    }

}

$CynicFeatures = CynicFeatures::loadPlugin();