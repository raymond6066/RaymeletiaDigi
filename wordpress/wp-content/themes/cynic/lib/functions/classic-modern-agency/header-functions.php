<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if(!function_exists('classic_modern_header')) {
    function cynic_classic_modern_header()
    { ?>

        <?php
        global $template;
        $page_template = basename($template);
        $cynic_options = cynic_options(); ?>
        <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js no-svg">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
            <link rel="profile" href="http://gmpg.org/xfn/11">

            <?php wp_head(); ?>
        </head>

    <body <?php body_class(); ?>>
    <div id="top"></div>
    <!-- most top information -->
    <?php $sticky_header = cynic_is_active_sticky_header(); ?>
    <div class="header-wrapper <?php echo esc_attr($sticky_header) ?> header-wrapper-extra-top-margin">
        <?php if (isset($cynic_options['cynic_top_bar']) && $cynic_options['cynic_top_bar'] != '1') { ?>
            <header>
                <div class="container">
                    <?php if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '1') { ?>
                        <div class="form-element hidden-xs pull-left">
                            <?php
                            if (isset($cynic_options['cynic_header_search']) && $cynic_options['cynic_header_search']) { ?>
                                <form action="<?php echo esc_url(home_url('/')) ?>" id="custom-search-input"
                                      class="form-inline">
                                    <input type="text" name="s" class="search-query form-control"
                                           placeholder="<?php esc_attr_e('Search', 'cynic') ?>">
                                    <button type="submit" class="search-btn"><i class="icon-magnifier"></i></button>
                                </form>
                                <?php
                            } ?>
                        </div>
                    <?php } else { ?>
                        <div class="hidden-xs pull-left">
                            <ul class="list-inline social_icons text-left">
                                <?php if (isset($cynic_options['cynic_header_media_facebook']) && !empty($cynic_options['cynic_header_media_facebook']) && $cynic_options['cynic_header_media_facebook'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_facebook']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-facebook"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_twitter']) && !empty($cynic_options['cynic_header_media_twitter']) && $cynic_options['cynic_header_media_twitter'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_twitter']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-twitter"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_google_plus']) && !empty($cynic_options['cynic_header_media_google_plus']) && $cynic_options['cynic_header_media_google_plus'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_google_plus']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_instagram']) && !empty($cynic_options['cynic_header_media_instagram']) && $cynic_options['cynic_header_media_instagram'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_instagram']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-instagram"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_pinterest']) && !empty($cynic_options['cynic_header_media_pinterest']) && $cynic_options['cynic_header_media_pinterest'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_pinterest']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_linkedin']) && !empty($cynic_options['cynic_header_media_linkedin']) && $cynic_options['cynic_header_media_linkedin'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_linkedin']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($cynic_options['cynic_header_media_youtube']) && !empty($cynic_options['cynic_header_media_youtube']) && $cynic_options['cynic_header_media_youtube'] != "#") { ?>
                                    <li>
                                        <a href="<?php echo esc_url($cynic_options['cynic_header_media_youtube']); ?>"
                                           target="_blank" class="text-center"><i class="fa fa-youtube"></i></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <!-- End of .form-element -->
                    <div class="contact-info clearfix">
                        <ul class="pull-right list-inline">
                            <?php if (isset($cynic_options['cynic_header_telno']) && $cynic_options['cynic_header_telno']) { ?>
                                <li><a href="tel:<?php print wp_kses_post($cynic_options['cynic_header_telno']) ?>"
                                       class="header-telephone"><span
                                                class="icon-telephone"></span><span><?php echo wp_kses_post($cynic_options['cynic_header_telno']) ?></span></a>
                                </li>
                            <?php } ?>
                            <?php if (isset($cynic_options['cynic_header_email']) && $cynic_options['cynic_header_email']) { ?>
                                <li>
                                    <a href="mailto:<?php echo sanitize_email($cynic_options['cynic_header_email']) ?>"><span
                                                class="icon-envelope"></span><span><?php echo sanitize_email($cynic_options['cynic_header_email']) ?></span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- End of .contact-info -->
                </div>
            </header>
        <?php } ?>
        <!-- end most top information -->
        <!--navigation-->
        <nav id="navbar-main" class="navbar main-menu">
            <div class="container">
                <!--Brand and toggle get grouped for better mobile display-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse-1" aria-expanded="false"><span
                                class="sr-only"><?php esc_html_e('Toggle navigation', 'cynic') ?></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <?php
                    if (isset($cynic_options['cynic_site_logo']) && $cynic_options['cynic_site_logo']) { ?>
                        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($cynic_options['cynic_site_logo']['url']) ?>"
                                 alt="<?php bloginfo('name'); ?>">
                        </a>
                    <?php } ?>
                </div>
                <!--Collect the nav links, and other content for toggling-->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <?php
                    if (has_nav_menu('primary')) :
                        $menu_arg = cynic_nav_menu();
                        wp_nav_menu($menu_arg);
                    endif
                    ?>
                </div>
            </div>
        </nav>
    </div>
    <!--end navigation-->
        <?php
    }
}