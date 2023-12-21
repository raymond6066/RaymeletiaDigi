<?php
/**
 * Header Functions
 * User: amit
 * Date: 10/1/18
 * Time: 7:43 PM
 */

if (!function_exists('cynic_illustration_header')) {
    function cynic_illustration_header()
    {
        ?>
        <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js no-svg">

        <head>

            <meta charset="<?php bloginfo('charset'); ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <?php wp_head(); ?>

        </head>

    <body <?php body_class(); ?>>
        <?php
        $isStickyMenu = "page-header";
        if (get_theme_mod('cynic_active_sticky')) {
            $isStickyMenu = "page-header-sticky";
        } else {
            $isStickyMenu = "";
        }
        $layoutClass = "";
        if (get_theme_mod('cynic_layouts') == 2) {
            $layoutClass = "one-page-menu";
        } ?>
        <header class="page-header <?php echo esc_attr($isStickyMenu) ?>">
            <div class="container">
                <nav class="navbar navbar-expand-lg align-items-center <?php echo esc_attr($layoutClass) ?>">
                    <?php
                    $siteLogo = get_theme_mod('cynic_site_logo');
                    $siteLogoStatus = false;
                    if ($siteLogo && isset($siteLogo) && !empty($siteLogo)) {
                        $siteLogoStatus = true;
                        $logo_url = $siteLogo;
                    } else {
                        $siteLogoStatus = true;
                        $logo_url = CYNIC_THEME_URI . '/images/illustration/brand-logo.png';
                    }
                    if ($siteLogoStatus) {
                        if (get_theme_mod('cynic_layouts') == 2 && is_front_page()) { ?>
                            <a class="navbar-brand page-scroll" href="#banner">
                                <img src="<?php echo esc_url($logo_url); ?>"
                                     alt="Cynic brand logo">
                            </a>
                            <?php
                        } else { ?>
                            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($logo_url); ?>"
                                     alt="Cynic brand logo">
                            </a>
                            <?php
                        }
                    } ?>
                    <!-- End of .navbar-brand -->

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#custom-navbar"
                            aria-controls="custom-navbar"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="custom-toggler-icon"></span>
                        <span class="custom-toggler-icon"></span>
                        <span class="custom-toggler-icon"></span>
                    </button>
                    <!-- End of .navbar-toggler -->

                    <div class="collapse navbar-collapse" id="custom-navbar">
                        <?php
                        if (has_nav_menu('primary')) :
                            $menu_arg = cynic_illustrated_multi_nav_menu('primary');
                            wp_nav_menu($menu_arg);
                        endif
                        ?>
                    </div>
                    <!-- End of .navbar-nav -->
                </nav>
            </div>
            <!-- End of .container -->
        </header>
        <!-- End of .header -->
        <?php
    }
}