<?php

/**
 * Enqueuing css and js
 */
function cynic_enqueue_scripts()
{

    //css
    wp_enqueue_style('miniline', CYNIC_THEME_URI . '/css/trendy-agency/miniline.css', array());
    wp_enqueue_style('bootstrap', CYNIC_THEME_URI . '/css/trendy-agency/vendor/bootstrap.min.css', array());
    wp_enqueue_style('slick', CYNIC_THEME_URI . '/css/trendy-agency/vendor/slick.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('slick-theme', CYNIC_THEME_URI . '/css/trendy-agency/vendor/slick-theme.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('magnific-popup', CYNIC_THEME_URI . '/css/trendy-agency/vendor/magnific-popup.css', array());
    wp_enqueue_style('cynic-main', CYNIC_THEME_URI . '/css/trendy-agency/main.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-responsive', CYNIC_THEME_URI . '/css/trendy-agency/responsive.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic', get_stylesheet_uri(), array(), CYNIC_THEME_VERSION);

    $custom_styles = cynic_get_custom_styles();

    //google fonts enqueue
    $cynic_options = array();
    $headlineFontString = get_theme_mod('cynic_headline-font');
    $headlineExp = json_decode($headlineFontString, true);
    $hFont = (isset($headlineExp['font']) && isset($headlineExp['category'])) ?
        $headlineExp['font'] : "Fira Sans";
    $bodyFontString = get_theme_mod('cynic_body-font');
    $bodyExp = json_decode($bodyFontString, true);
    $bFont = (isset($bodyExp['font']) && isset($bodyExp['category'])) ?
        $bodyExp['font'] : "Hind Vadodara";
    if (!empty($hFont) && !empty($bFont)) {
        $cynic_options = array($hFont, $bFont);
    }

    $fontareas = array('body-font', 'headline-font');
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

    wp_enqueue_script('bootstrap-bundle', CYNIC_THEME_URI . '/js/trendy-agency/vendor/bootstrap.bundle.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('fontawesome-all', CYNIC_THEME_URI . '/js/trendy-agency/vendor/fontawesome-all.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('easing', CYNIC_THEME_URI . '/js/trendy-agency/vendor/easing-1.3.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('waypoints', CYNIC_THEME_URI . '/js/trendy-agency/vendor/jquery.waypoints.min.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('counterup', CYNIC_THEME_URI . '/js/trendy-agency/vendor/jquery.counterup.min.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('bootstrap-progressbar', CYNIC_THEME_URI . '/js/trendy-agency/vendor/bootstrap-progressbar.min.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('imageloaded', CYNIC_THEME_URI . '/js/trendy-agency/vendor/imagesloaded.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('slick', CYNIC_THEME_URI . '/js/trendy-agency/vendor/slick.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('magnific-popup', CYNIC_THEME_URI . '/js/trendy-agency/vendor/jquery.magnific-popup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('isotope', CYNIC_THEME_URI . '/js/trendy-agency/vendor/isotope.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('jquery.ScrollMagic', CYNIC_THEME_URI . '/js/trendy-agency/vendor/jquery.ScrollMagic.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('debug.addIndicators', CYNIC_THEME_URI . '/js/trendy-agency/vendor/debug.addIndicators.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('jquery.TweenMax', CYNIC_THEME_URI . '/js/trendy-agency/vendor/jquery.TweenMax.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('animation.gsap', CYNIC_THEME_URI . '/js/trendy-agency/vendor/animation.gsap.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('scrollReveal', CYNIC_THEME_URI . '/js/trendy-agency/vendor/scrollReveal.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('main', CYNIC_THEME_URI . '/js/trendy-agency/main.js', array('jquery'), CYNIC_THEME_VERSION, true);
}

add_action('wp_enqueue_scripts', 'cynic_enqueue_scripts', 1000);
add_action('admin_enqueue_scripts', 'cynic_admin_scripts', 1000);

function cynic_admin_scripts()
{
    wp_enqueue_style('cynic-iconpicker', CYNIC_THEME_URI . '/js/trendy-agency/vendor/iconspicker/dist/css/fontawesome-iconpicker.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-admin', CYNIC_THEME_URI . '/css/trendy-agency/admin.css', array());

    wp_enqueue_script('cynic-iconpicker', CYNIC_THEME_URI . '/js/trendy-agency/vendor/iconspicker/dist/js/fontawesome-iconpicker.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('cynic-custom-icons', CYNIC_THEME_URI . '/js/trendy-agency/custom-icons.js"', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('cynic-admin', CYNIC_THEME_URI . '/js/trendy-agency/admin.js', array('jquery'), CYNIC_THEME_VERSION, true);

}

