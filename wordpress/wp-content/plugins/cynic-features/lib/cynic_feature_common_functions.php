<?php

function cynic_features_wp_admin_scripts()
{
    wp_enqueue_script('cynic-feature-admin-scripts', AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/admin_common_scripts.js', array('jquery'), CYNIC_FEATURE_PLUGIN_VERSION, true);
    wp_enqueue_style('cynic-feature-admin-styles', AXILWEB_CYNIC_FEATURE_PLUGIN_URL . 'assets/admin_common_style.css', array(), CYNIC_FEATURE_PLUGIN_VERSION);
}

add_action('admin_enqueue_scripts', 'cynic_features_wp_admin_scripts');
add_action('wp_ajax_cynic_feature_theme_layout_type_update', 'cynic_feature_theme_layout_type_update');
function cynic_feature_theme_layout_type_update()
{
    if ($_POST) {
        $result = false;
        $href = "#";
        $DemoImport = get_option('cynic_theme_demo_import');
        if (empty($DemoImport) || $DemoImport != 'demo_imported') {
            update_option('cynic_theme_demo_import', 'general');
        }

        if (class_exists('Redux')) {
            $opt_name = "cynic_options";
            Redux::setOption($opt_name, 'cynic_theme_mode', '2');
            $result = false;
            if (isset($_POST['theme_layout_category']) && !empty($_POST['theme_layout_category'])) {
                $result = true;

                $layout_category = esc_html($_POST['theme_layout_category']);
                $href = get_dashboard_url() . "themes.php?page=pt-one-click-demo-import#" . $layout_category;
            }
        }

        echo wp_send_json(array('result' => $result, 'href' => $href));
        exit;
    }
}

function getCustomPostTypeAdminUrl($post_type, $text = '')
{
    if ($post_type) {
        if (empty($text)) {
            $text = 'To add/edit/delete, please click here';
        }
        $href = esc_url(get_dashboard_url() . 'edit.php?post_type=' . $post_type);
        $anchor = "<a href='" . $href . "' target='_self'>$text</a>";
        return $anchor;
    }
}

function cynic_nl2br($string)
{

    if (empty($string)) {
        return $string;
    }
    return str_replace(array("\r\n", "\r", "\n"), '<span class="newline"></span>', $string);
}

function get_contact_forms()
{
    $forms = array('Select' => '');
    $posts = get_posts(array(
        'post_type' => 'wpcf7_contact_form',
        'numberposts' => -1
    ));
    foreach ($posts as $post) {
        $forms[$post->post_title] = $post->post_name;
    }
    return $forms;
}

function get_contact_forms_shortcode($atts = NULL)
{
    if (isset($atts) && !empty($atts)) {
        $_shortcode = "";
        $posts = get_posts(array(
            'name' => (string)$atts,
            'post_type' => 'wpcf7_contact_form',
            'numberposts' => 1
        ));
        $_shortcode = "";
        $_form_shortcode = "";
        foreach ($posts as $post) {
            $_shortcode .= "[";
            $_shortcode .= "contact-form-7";
            if (isset($post->ID) && !empty($post->ID)) {
                $_shortcode .= ' id="' . $post->ID . '"';
            }
            if (isset($post->post_title) && !empty($post->post_title)) {
                $_shortcode .= ' title = "' . $post->post_title . '"';
            }
            $_shortcode .= "]";
            $_form_shortcode = do_shortcode($_shortcode);
        }
        return $_form_shortcode;
    }
}
