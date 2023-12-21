<?php
/**
 * Enqueuing css and js
 */
function cynic_enqueue_scripts()
{

    //css
    wp_enqueue_style('miniline', CYNIC_THEME_URI . '/css/illustration/miniline.css', array());
    wp_enqueue_style('fontawesome-all', CYNIC_THEME_URI . '/css/illustration/fontawesome-all.min.css', array());
    wp_enqueue_style('bootstrap-min', CYNIC_THEME_URI . '/css/illustration/vendor/bootstrap.min.css', array());
    wp_enqueue_style('owl-min', CYNIC_THEME_URI . '/css/illustration/vendor/owl.carousel.min.css', array());
    wp_enqueue_style('owl-theme-default', CYNIC_THEME_URI . '/css/illustration/vendor/owl.theme.default.min.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('magnitic-popup', CYNIC_THEME_URI . '/css/illustration/vendor/magnific-popup.css', array(), CYNIC_THEME_VERSION);

    wp_enqueue_style('cynic-main', CYNIC_THEME_URI . '/css/illustration/main.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-responsive', CYNIC_THEME_URI . '/css/illustration/responsive.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic', get_stylesheet_uri(), array(), CYNIC_THEME_VERSION);

    $custom_styles = cynic_get_custom_styles();

    //google fonts enqueue
    $cynic_options = array();
    $headlineFontString = get_theme_mod('cynic_headline_font');
    $headlineExp = json_decode($headlineFontString, true);
    $hFont = (isset($headlineExp['font']) && isset($headlineExp['category'])) ?
        $headlineExp['font'] : "Catamaran";
    $bodyFontString = get_theme_mod('cynic_body_font');
    $bodyExp = json_decode($bodyFontString, true);
    $bFont = (isset($bodyExp['font']) && isset($bodyExp['category'])) ?
        $bodyExp['font'] : "Roboto";
    if (!empty($hFont) && !empty($bFont)) {
        $cynic_options = array($hFont, $bFont);
    }

    $fontareas = array('body_font', 'headline_font');
    $fontrootsrc = 'https://fonts.googleapis.com/css';
    $variants = ':200,300,300i,400,400i,500,500i,600,700,800,900';
    $oppref = 'cynic_';
    $fontsrc = array();
    foreach ($fontareas as $key => $fontop) {
        if (isset($cynic_options) && !empty($cynic_options)) {
            $fontdata[$key]['font-family'] = $cynic_options[$key];
            if (isset($fontdata[$key]['font-family']) && !in_array($fontdata[$key]['font-family'], $fontsrc)) {
                $fontsrc[] = $fontdata[$key];
            }
        }
    }

    if (!empty($fontsrc)) {
        foreach ($fontsrc as $fkey => $fontfamily) {
            $fsrc = add_query_arg(array('family' => $fontfamily['font-family'] . $variants), $fontrootsrc);
            wp_enqueue_style('cynic-font' . $fkey, $fsrc);
        }
    }

    wp_add_inline_style('cynic', $custom_styles);

    // scripts
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }

    wp_enqueue_script('bootstrap-bundle', CYNIC_THEME_URI . '/js/illustration/vendor/bootstrap.bundle.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('isotope-pkd', CYNIC_THEME_URI . '/js/illustration/vendor/isotope.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('easing', CYNIC_THEME_URI . '/js/illustration/vendor/easing-1.3.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('waypoints', CYNIC_THEME_URI . '/js/illustration/vendor/jquery.waypoints.min.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('counterup', CYNIC_THEME_URI . '/js/illustration/vendor/jquery.counterup.min.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('imageloaded', CYNIC_THEME_URI . '/js/illustration/vendor/imagesloaded.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('owl-carousel', CYNIC_THEME_URI . '/js/illustration/vendor/owl.carousel.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('magnific-popup', CYNIC_THEME_URI . '/js/illustration/vendor/jquery.magnific-popup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('main', CYNIC_THEME_URI . '/js/illustration/main.js', array('jquery'), CYNIC_THEME_VERSION, true);
}

add_action('wp_enqueue_scripts', 'cynic_enqueue_scripts', 1000);
add_action('admin_enqueue_scripts', 'cynic_admin_scripts', 1000);

function cynic_admin_scripts()
{
    wp_enqueue_script('cynic-admin', CYNIC_THEME_URI . '/js/illustration/admin.js', array('jquery'), CYNIC_THEME_VERSION, true);
}