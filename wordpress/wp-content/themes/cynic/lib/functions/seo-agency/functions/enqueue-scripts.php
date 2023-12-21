<?php

/**
 * Enqueuing css and js
 */
function cynic_enqueue_scripts() {
    
    //css
    wp_enqueue_style('bootstrap', CYNIC_THEME_URI . '/css/seo-agency/vendor/bootstrap.min.css', array());
    wp_enqueue_style('slick', CYNIC_THEME_URI . '/css/seo-agency/vendor/slick.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('slick-theme', CYNIC_THEME_URI . '/css/seo-agency/vendor/slick-theme.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('magnific-popup', CYNIC_THEME_URI . '/css/seo-agency/vendor/magnific-popup.css', array());
    wp_enqueue_style('jquery-gridder', CYNIC_THEME_URI . '/css/seo-agency/vendor/jquery.gridder.min.css', array(), CYNIC_THEME_VERSION);

    $cynic_options = cynic_options();
    $fontareas = array('body_font', 'p_font', 'banner_p_font', 'headings_font', 'menu_font', 'top_menu_font');
    $fontrootsrc = 'https://fonts.googleapis.com/css';
    $variants = ':300,300i,400,400i,600,600i,700,700i,800,800i';
    $oppref = 'cynic_';
    $fontsrc = array();
    foreach ($fontareas as $fontop) {
        if (isset($cynic_options[$oppref . $fontop])) {
            $fontdata = $cynic_options[$oppref . $fontop];
            if (isset($fontdata['font-family']) && !in_array($fontdata['font-family'], $fontsrc)) {
                $fontsrc[$oppref . $fontop] = $fontdata['font-family'];
            }
        }
    }
    if (!empty($fontsrc)) {
        foreach ($fontsrc as $fkey => $fontfamily) {
            $fsrc = add_query_arg(array('family' => $fontfamily . $variants), $fontrootsrc);
            wp_enqueue_style($fkey, $fsrc);
        }
    }
    wp_enqueue_style('cynic-main', CYNIC_THEME_URI . '/css/seo-agency/main.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-responsive', CYNIC_THEME_URI . '/css/seo-agency/responsive.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-core', CYNIC_THEME_URI . '/css/seo-agency/base.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic', get_stylesheet_uri(), array(), CYNIC_THEME_VERSION);

    if (getCynicOptionsVal('theme_mode')==2) {
        $custom_styles = cynic_get_custom_styles();
        wp_add_inline_style('cynic', $custom_styles);
    }

    // scripts
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }

    wp_enqueue_script('cookie', CYNIC_THEME_URI . '/js/seo-agency/vendor/js.cookie.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('popper', CYNIC_THEME_URI . '/js/seo-agency/vendor/popper.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('bootstrap', CYNIC_THEME_URI . '/js/seo-agency/vendor/bootstrap.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('easing', CYNIC_THEME_URI . '/js/seo-agency/vendor/easing-1.3.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('bootstrap-dynamic', CYNIC_THEME_URI . '/js/seo-agency/vendor/bootstrap-dynamic-tabs.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('imageloaded', CYNIC_THEME_URI . '/js/seo-agency/vendor/imagesloaded.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('slick', CYNIC_THEME_URI . '/js/seo-agency/vendor/slick.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('waypoints', CYNIC_THEME_URI . '/js/seo-agency/vendor/jquery.waypoints.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('counterup', CYNIC_THEME_URI . '/js/seo-agency/vendor/jquery.counterup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('nicescroll', CYNIC_THEME_URI . '/js/seo-agency/vendor/jquery.nicescroll.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('isotope', CYNIC_THEME_URI . '/js/seo-agency/vendor/isotope.pkgd.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('magnific-popup', CYNIC_THEME_URI . '/js/seo-agency/vendor/jquery.magnific-popup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('typed', CYNIC_THEME_URI . '/js/seo-agency/vendor/typed.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('social-shared', CYNIC_THEME_URI . '/js/seo-agency/social-shared.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('jquery-gridder-js', CYNIC_THEME_URI . '/js/seo-agency/vendor/jquery.gridder.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('main', CYNIC_THEME_URI . '/js/seo-agency/main.js', array('jquery'), CYNIC_THEME_VERSION, true);
}

add_action('wp_enqueue_scripts', 'cynic_enqueue_scripts', 1000);
add_action('admin_enqueue_scripts', 'cynic_admin_scripts', 1000);

function cynic_admin_scripts() {
    
    //Css for jQuery UI
    wp_enqueue_style('cynic-iconpicker', CYNIC_THEME_URI . '/js/seo-agency/vendor/iconspicker/dist/css/fontawesome-iconpicker.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-admin', CYNIC_THEME_URI . '/css/seo-agency/admin.css', array());
    
    //Admin js
    wp_enqueue_script('cynic-iconpicker', CYNIC_THEME_URI . '/js/seo-agency/vendor/iconspicker/dist/js/fontawesome-iconpicker.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('cynic-custom-icons', CYNIC_THEME_URI . '/js/seo-agency/custom-icons.js', array('jquery','cynic-iconpicker'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('cynic-admin', CYNIC_THEME_URI . '/js/seo-agency/admin.js', array('jquery'), CYNIC_THEME_VERSION, true);

}

add_action( 'wp_loaded', 'cynic_common_scripts' );

function cynic_common_scripts() {
    wp_enqueue_style('font-awesome', CYNIC_THEME_URI . '/css/seo-agency/font-awesome.min.css', array());
    wp_enqueue_style('caviar', CYNIC_THEME_URI . '/css/seo-agency/cynic-caviar-icons.css', array());
}
