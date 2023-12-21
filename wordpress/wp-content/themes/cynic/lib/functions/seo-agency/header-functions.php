<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if(!function_exists('cynic_seo_agency_header')) {
    function cynic_seo_agency_header()
    { ?>

        <?php
        /**For demo logo variation**/
        ob_start();
        if (!session_id()) {
            session_start();
        }
        ob_clean();
        ?>
        <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js no-svg">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <?php wp_head(); ?>
        </head>
        <?php $cynic_options = cynic_options(); ?>
        <!-- body starts
        ============================================ -->
    <body <?php body_class(); ?> id="top">
        <?php if (getCynicOptionsVal('pre_loader')) : ?>
        <!-- pre-loader -->
        <div class="loader_wrapper">
            <div class="loader text-center"></div>
        </div>
        <!-- End of loader-wrapper -->
    <?php endif; ?>
        <div class="body-overlay"></div>

    <div class="main">
        <!-- fullscreen-menu starts
        ============================================ -->
        <?php
        /** Header Top menu Hook**/
        if (cynic_top_menu_EnableDisable()) :
            ?>
            <div class="fullscreen-menu text-right">
                <div class="container">
                    <div class="navbar-wrapper">
                        <nav class="navbar">
                            <a href="javascript:void(0)" class="close-menu">
                                <i class="icon-Cross"></i>
                            </a>
                            <!-- End of .close-menu -->
                            <?php
                            if (has_nav_menu('top_menu')) :
                                $menu_arg = cynic_nav_menu('top_menu');
                                wp_nav_menu($menu_arg);
                            endif
                            ?>
                        </nav>
                        <!-- End of .navbar -->
                    </div>
                    <!-- End of .navbar-wrapper -->
                </div>
                <!-- End of .container -->
            </div>
            <?php
        endif;
        ?>
        <!-- End of .fullscreen-menu -->

        <!-- navbar starts
        ============================================ -->
        <div class="header-wrapper fixed-top">
            <div class="header-top d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-4 text-sm-left">
                            <?php

                            /** Header Logos**/
                            $siteLogoArr = getCynicOptionsVal('site_logo');
                            $siteLogoStatus = false;
                            if (count($siteLogoArr)) {
                                $siteLogoStatus = true;
                                $logo_url = $siteLogoArr['url'];
                            }

                            if ($siteLogoStatus) { ?>
                                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($logo_url) ?>"
                                         alt="<?php bloginfo('name'); ?>">
                                </a>
                            <?php } ?>
                        </div>
                        <div class="ht-right col-sm d-flex align-items-center justify-content-center justify-content-sm-end">
                            <?php
                            /** Header Telephone **/
                            if (getCynicOptionsVal('header_telephone_number_display')) {
                                if (getCynicOptionsVal('header_telno')) { ?>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', getCynicOptionsVal('header_telno'))); ?>"
                                       class="contact-numb">
                                        <?php
                                        $header_tel_iconClass = getCynicOptionsVal('header_tel_icon');
                                        $header_tel_icon_prefix = (substr($header_tel_iconClass, 0, 3) === "fa-") ? 'fa ' : '';
                                        $header_tel_iconClass = $header_tel_icon_prefix . $header_tel_iconClass;
                                        $htifontSizeOpt = getCynicOptionsVal('header_tel_icon_font_size');
                                        $htifontSize = (isset($htifontSizeOpt['width'])) ? $htifontSizeOpt['width'] : '';
                                        $header_tel_iconStyle = (!empty($htifontSize)) ? "data-font-size=" . $htifontSize : "";

                                        ?>
                                        <i <?php echo esc_attr($header_tel_iconStyle); ?>
                                            class="grad-icon <?php echo esc_attr($header_tel_iconClass); ?>"></i>
                                        <span><?php echo esc_html(getCynicOptionsVal('header_telno')); ?></span>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            /**header Free SEO Audit button **/
                            if (getCynicOptionsVal('header_button_display')) {
                                if (getCynicOptionsVal('header_button_text')) {
                                    $headerbtntext = (getCynicOptionsVal('header_button_text')) ? getCynicOptionsVal('header_button_text') : __('Free SEO Audit', 'cynic');
                                    $headerbtnOpentype = getCynicOptionsVal('header_button_open_type');

                                    $isopenwithModal = getCynicOptionsVal('is_header_button_open_with_modal');
                                    $headerbtntypeAtt = ($isopenwithModal) ? 'data-toggle=modal data-target=#contact-form-modal' : " target=" . $headerbtnOpentype;
                                    $headerhtnhref = 'javascript:void(0)';
                                    if (!$isopenwithModal) {
                                        $headButtonPageId = getCynicOptionsVal('header_button_page');
                                        $headerhtnhref = get_permalink($headButtonPageId);
                                    }
                                    ?>
                                    <a class="primary-btn"
                                       data-page="<?php echo esc_attr(getCynicOptionsVal('header_button_page')) ?>"
                                       href="<?php echo esc_url($headerhtnhref); ?>" <?php echo esc_attr($headerbtntypeAtt); ?> ><?php echo esc_html($headerbtntext); ?></a>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            /**Header Top Menu Icons**/
                            if (cynic_top_menu_EnableDisable()) {
                                ?>
                                <a class="mm-toggler navbar-toggler cynic_top_menu_enabled" href="javascript:void(0)">
                                    <?php
                                    $topMenuIcon = trim(getCynicOptionsVal('header_top_menu_icon'));
                                    if ($topMenuIcon) {
                                        $topMenuIcon = (substr($topMenuIcon, 0, 3) === "fa-") ? 'fa ' . $topMenuIcon : $topMenuIcon;
                                        $topmenufontSizeOpt=getCynicOptionsVal('header_top_menu_icon_font_size');
                                        $topmenufontSize = (isset($topmenufontSizeOpt['width'])) ? $topmenufontSizeOpt['width'] : '2.4em';
                                        $topMenu_iconStyle = (!empty($topmenufontSize)) ? "data-font-size=" . $topmenufontSize : "";
                                        ?>
                                        <i <?php echo esc_attr($topMenu_iconStyle); ?>
                                            class="grad-icon <?php echo esc_attr($topMenuIcon) ?>"></i>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="toggler-icon bar1"></span>
                                        <span class="toggler-icon bar2"></span>
                                        <span class="toggler-icon bar3"></span>
                                        <?php
                                    }
                                    ?>
                                </a>
                                <?php
                            }

                            ?>
                        </div>
                        <!-- End of .col-auto -->
                    </div>
                    <!-- End of row -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .header-top -->
            <!-- Nav starts -->
            <!-- Header Primary Menu -->
            <?php $mainMenuOpenTypeClass = "";
            $mainMenuOpenType = getCynicOptionsVal('header_menu_dropdown_type');
            $mainMenuOpenTypeClass = ($mainMenuOpenType == 1) ? " cynic-open-on-click" : "";
            ?>
            <nav class="<?php echo esc_attr((!cynic_top_menu_EnableDisable()) ? 'cynic-no-nav-top-menu ' : ' cynic-classic-menu '); ?>navbar navbar-toggleable-md navbar-expand-lg align-items-center service-nav header-main-menu <?php echo esc_attr($mainMenuOpenTypeClass); ?>">

                <div class="container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
                        <?php
                        $topMenuIcon = trim(getCynicOptionsVal('header_top_menu_icon'));
                        if ($topMenuIcon) {
                            $topMenuIcon = (substr($topMenuIcon, 0, 3) === "fa-") ? 'fa ' . $topMenuIcon : $topMenuIcon;
                            $topmenufontSizeOpt=getCynicOptionsVal('header_top_menu_icon_font_size');
                            $topmenufontSize = (isset($topmenufontSizeOpt['width'])) ? $topmenufontSizeOpt['width'] : '2.4em';
                            $topMenu_iconStyle = (!empty($topmenufontSize)) ? "data-font-size=" . $topmenufontSize : "";
                            ?>
                            <i <?php echo esc_attr($topMenu_iconStyle); ?>
                                class="grad-icon <?php echo esc_attr($topMenuIcon) ?>"></i>
                            <?php
                        } else {
                            ?>
                            <i class="grad-icon fa fa-bars"></i>
                            <?php
                        }
                        ?>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php
                        if (has_nav_menu('primary')) :
                            $menu_arg = cynic_nav_menu('primary');
                            wp_nav_menu($menu_arg);
                        endif
                        ?>
                    </div>
                </div>
                <!-- End of .container -->
            </nav>
            <!-- End of nav -->
        </div>
        <!-- End of .header-wrapper -->
        <?php
    }
}

if (!function_exists('cynic_add_class_to_the_selected_nav_menu')) {
    function cynic_add_class_to_the_selected_nav_menu($classes)
    {
        switch (get_post_type()) {
            case 'post':
                if (in_array('nav-menu-item-blog', $classes)) {
                    $classes[] = 'active';
                }
                break;
            case 'portfolio':
                if (in_array('nav-menu-item-our-work', $classes)) {
                    $classes[] = 'active';
                }
                break;
            case 'case_studies':
                if (in_array('nav-menu-item-case-studies', $classes)) {
                    $classes[] = 'active';
                }
                break;
            case 'reviews':
                if (in_array('nav-menu-item-client-reviews', $classes)) {
                    $classes[] = 'active';
                }
                break;
            case 'positions':
                if (in_array('nav-menu-item-career', $classes)) {
                    $classes[] = 'active';
                }
                break;
            case 'faq':
                if (in_array('nav-menu-item-faqs', $classes)) {
                    $classes[] = 'active';
                }
                break;
            default:
                $classes[] = '';
        }
        return $classes;
    }

    add_filter('nav_menu_css_class', 'cynic_add_class_to_the_selected_nav_menu');
}