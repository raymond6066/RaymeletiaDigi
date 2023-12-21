<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if (!function_exists('cynic_trendy_agency_header')) {
    function cynic_trendy_agency_header()
    { ?>
        <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js no-svg">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <?php wp_head(); ?>
        </head>
        <?php
        $_pageTitle = cynic_get_meta("cynic_page_title");
        $trendyBodyClass = "";
        if ($_pageTitle == 2 || is_single()) {
            $trendyBodyClass = 'trendy-agency-banner-with-title';
        } elseif ($_pageTitle == 0) {
            $is_display_page_header = cynic_get_meta("cynic_page_display_header");
            if(!is_front_page() && is_singular('post')){
                $is_display_page_header = 1;
            }
            if($is_display_page_header==1){
                $trendyBodyClass = 'trendy-agency-banner-empty-title';
            }
        } else {
            $trendyBodyClass = 'trendy-agency-banner-only-title';
        }

        ?>
    <body <?php body_class($trendyBodyClass); ?>>
    <?php
    $is_display_page_header = cynic_get_meta("cynic_page_display_header");
    if(!is_front_page() && is_singular(array( 'post', 'case_studies', 'portfolio'))){
        $is_display_page_header = 1;
    } elseif(is_404() || is_search()){
        $is_display_page_header = 1;
    }
    if (isset($is_display_page_header) && $is_display_page_header == 1):
        $bubble_colors = get_theme_mod('cynic_shape-color');
        $get_colors = cynic_get_bubble_color($bubble_colors); ?>
    <div class="page-wrapper">
        <?php
        if(is_404()) { ?>
            <svg class="bg-shape inner-page-shape-banner-right reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_01" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_01)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z" />
            </svg>

            <svg class="bg-shape inner-page-shape-banner-left reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_02" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1" />
                        <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_02)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z" />
            </svg>
            <?php
        }
        $_pageTitle = cynic_get_meta("cynic_page_title");
        if ((isset($_pageTitle) && ($_pageTitle == 2 || is_single())) || get_post_type() !=='page') :
            if (is_single()) {
                $_pageTitle = 2;
            }
            if (get_page_inner_header($_pageTitle, 'svg', '')) {
                ?>
                <svg class="bg-shape inner-page-shape-banner-right reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_01" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_01)"
                          d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>

                <svg class="bg-shape inner-page-shape-banner-left reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_02" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                            <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_02)"
                          d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>
                <?php
            }
        endif;
    endif;
        ?>
        <!-- navbar starts
        ======================================= -->
        <?php
        $navClass = "";
        if (get_theme_mod('cynic_layouts') == 2) {
            $navClass = 'onepage-navbar';
        }
        $isStickyMenu = "navbar sticky-menu";
        if (get_theme_mod('cynic_active_sticky')) {
            $isStickyMenu = "navbar sticky-menu";
        } else {
            $isStickyMenu = "navbar";
        }?>
        <nav class="<?php echo esc_attr($isStickyMenu) ?> navbar-expand-lg<?php echo (!empty($navClass)) ? " ".$navClass : ""; echo esc_attr(($is_display_page_header == 1) ? ' solid-bg' : '') ?>">
            <div class="container">
                <?php
                /** Header Logos**/
                $siteLogo = get_theme_mod('cynic_site_logo');
                $siteLogoStatus = false;
                if ($siteLogo && isset($siteLogo) && !empty($siteLogo)) {
                    $siteLogoStatus = true;
                    $logo_url = $siteLogo;
                } else {
                    $siteLogoStatus = true;
                    $logo_url = CYNIC_THEME_URI . '/images/trendy-agency-logo.png';
                }
                if ($siteLogoStatus) {
                    if (get_theme_mod('cynic_layouts') == 2) { ?>
                        <a class="navbar-brand page-scroll" href="#top">
                            <img src="<?php echo esc_url($logo_url) ?>"
                                 alt="<?php bloginfo('name'); ?>">
                        </a>
                        <?php
                    } else { ?>
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($logo_url) ?>"
                                 alt="<?php bloginfo('name'); ?>">
                        </a>
                        <?php
                    }
                } ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="custom-toggler-icon bar1"></span>
                    <span class="custom-toggler-icon bar2"></span>
                    <span class="custom-toggler-icon bar3"></span>
                </button>
                <!-- End of .navbar-toggler -->

                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php
                    if (has_nav_menu('primary')) :
                        $menu_arg = cynic_nav_menu('primary');
                        wp_nav_menu($menu_arg);
                    endif
                    ?>
                </div>
                <!-- End of .navbar-collapse -->
            </div>
            <!-- End of .container -->
        </nav>
        <!-- End of .navbar -->
        <?php
    }
}