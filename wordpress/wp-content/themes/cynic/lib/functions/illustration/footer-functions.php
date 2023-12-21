<?php
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 10/1/18
 * Time: 7:43 PM
 */

if (!function_exists('cynic_illustration_footer')) {
    function cynic_illustration_footer()
    {
        $layouts = get_theme_mod("cynic_layouts");
        $get_copyrightText = stripslashes(get_theme_mod('cynic_footer_copyright_text'));
        $copyrightText = !empty($get_copyrightText) ? $get_copyrightText : "";
        if(isset($layouts) && $layouts == 2) { ?>
            <!-- Footer starts
            ======================================= -->
            <footer class="page-footer">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <?php
                        if ($copyrightText) { ?>
                            <div class="col-md-4">
                                <p><?php echo $copyrightText; ?></p>
                            </div>
                            <!-- End of .col-lg-4 -->
                            <?php
                        } ?>

                        <div class="col-md-4 text-md-center">
                            <?php
                            if (is_active_sidebar('social-media-widget')) {
                                dynamic_sidebar('social-media-widget');
                            } ?>
                        </div>
                        <!-- End of .col-lg-4 -->
                        <?php
                        if (get_theme_mod('cynic_onepage_privacy_link') || get_theme_mod('cynic_onepage_terms_condition_link')) { ?>
                            <div class="col-md-4 text-md-right">
                                <p>
                                    <?php
                                    if (get_theme_mod('cynic_onepage_privacy_link')) {
                                        $privacy_policy = get_theme_mod('cynic_onepage_privacy_link'); ?>
                                        <a href="javascript:void(0)" data-post="<?php echo esc_attr($privacy_policy) ?>"
                                           class="cynic-pages-modal"
                                           data-modalwrapper="privacy-modal"><?php echo get_the_title($privacy_policy); ?></a> -
                                        <?php
                                    }
                                    if (get_theme_mod('cynic_onepage_terms_condition_link')) {
                                        $terms_conditions = get_theme_mod('cynic_onepage_terms_condition_link'); ?>
                                        <a href="javascript:void(0)"
                                           data-post="<?php echo esc_attr($terms_conditions) ?>"
                                           class="cynic-pages-modal"
                                           data-modalwrapper="terms-modal"><?php echo get_the_title($terms_conditions); ?></a>
                                        <?php
                                    } ?>
                                </p>
                            </div>
                            <!-- End of .col-lg-4 -->
                            <?php
                        } ?>
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </footer>
            <!-- End of .page-footer -->
            <?php
        } else {
            $footerLogoArr = get_theme_mod('cynic_footer_logo');
            $footerLogoStatus = false;
            if ($footerLogoArr && isset($footerLogoArr) && !empty($footerLogoArr)) {
                $footerLogoStatus = true;
                $footerlogo_url = $footerLogoArr;
            } else {
                $footerLogoStatus = true;
                $footerlogo_url = CYNIC_THEME_URI . '/images/illustration/brand-logo.png';
            }
            $get_image_subheadline = stripslashes(get_theme_mod('footer_image_subheadline_text'));
            $headlineText = !empty($get_image_subheadline) ? $get_image_subheadline : "";

            $form_title = stripslashes(get_theme_mod('cynic_mc_form_title'));
            $form_shortcode = get_theme_mod('cynic_mc_form_shortcode');
            $follow_us_text = get_theme_mod('cynic_mc_follow_us_text');
            $facebook = get_theme_mod('cynic_mc_facebook');
            $twitter = get_theme_mod('cynic_mc_twitter');
            $youtube = get_theme_mod('cynic_mc_youtube');
            $google = get_theme_mod('cynic_mc_google');
            $instagram = get_theme_mod('cynic_mc_instagram');
            $pinterest = get_theme_mod('cynic_mc_pinterest');
            $linkedin = get_theme_mod('cynic_mc_linkedin');
            if(!is_front_page()) { ?>

                <section class="newsletter section-gap theme-bg-d newsletter__white">
                    <div class="container">
                        <?php
                        if (!empty($form_title)) { ?>
                            <h2 class="text-center"><?php echo $form_title; ?></h2>
                            <?php
                        }
                        if (!empty($form_shortcode)) {
                            echo do_shortcode($form_shortcode);
                        } ?>
                        <!-- End of .newsletter-form -->

                        <div class="social-icons-wrapper d-flex justify-content-center">
                            <?php
                            if (!empty($follow_us_text)) { ?>
                                <p><?php echo $follow_us_text; ?></p>
                                <?php
                            }
                            if (!empty($facebook) || !empty($twitter) || !empty($youtube) || !empty($google)
                                || !empty($instagram || !empty($pinterest) || !empty($linkedin))) { ?>
                                <ul class="social-icons">
                                    <?php
                                    if (!empty($facebook)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($twitter)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($youtube)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($google)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($google); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($instagram)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($pinterest)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($pinterest); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    if (!empty($linkedin)) { ?>
                                        <li>
                                            <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <?php
                                    } ?>
                                </ul>
                                <!-- End of .social-icons -->
                                <?php
                            } ?>
                        </div>
                        <!-- End of .social-icons-wrapper -->
                    </div>
                    <!-- End of .container -->
                </section>

                <?php
            } ?>

            <footer class="page-footer dark-footer-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer-widget widget-about">
                                <a href="<?php echo home_url(); ?>">
                                    <img class="footer-logo" src="<?php echo esc_url($footerlogo_url);  ?>"
                                         alt="footer logo" height="16">
                                </a>
                                <?php
                                if($headlineText) { ?>
                                    <p><?php echo $headlineText; ?></p>
                                    <?php
                                }
                                dynamic_sidebar('social-media-widget');
                                if ($copyrightText) { ?>
                                    <p class="copywrite-txt"><?php echo $copyrightText; ?></p>
                                    <?php
                                }?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <?php dynamic_sidebar('services-widget'); ?>
                        </div>
                        <!-- End of .col-lg-2 -->

                        <div class="col-lg-3">
                            <?php dynamic_sidebar('resources-widget'); ?>
                        </div>
                        <!-- End of .col-lg-2 -->

                        <div class="col-lg-2">
                            <?php dynamic_sidebar('support-widget'); ?>
                        </div>
                        <!-- End of .col-lg-2 -->
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .container -->
            </footer>
            <?php
        } ?>
        <?php wp_footer(); ?>
        </body>
        </html>
        <?php
    }
}

add_action('wp_footer', 'cynic_global_modals');

function cynic_global_modals()
{
    ?>
    <!-- Portfolio modal starts
        ================================= -->
    <div class="modal fade full-width-modal" id="product-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="loading-img d-none">
            <img src="<?php echo get_template_directory_uri() ?>/images/loading.gif"
                                      alt="loading gif">
        </div>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <!-- End of .close -->
                </div>
                <!-- End of .modal-header -->
                <div class="modal-body"></div>
                <!-- End of .modal-body -->
            </div>
            <!-- End of .modal-content -->
        </div>
        <!-- End of .modal-dialog -->
    </div>
    <!-- End of .portfolio-modal -->
    <?php

}

add_action('wp_footer', 'cynic_get_a_quote_modals');

function cynic_get_a_quote_modals()
{
    if (get_theme_mod('cynic_is_header_button_open_with_modal') == "modal") {
        $cynicPageID = get_theme_mod('cynic_header_button_page');
        $pageContent = get_post($cynicPageID);
        $content = apply_filters('the_content', $pageContent->post_content); ?>
        <!-- Quote modal starts
        ================================= -->
        <div class="modal fade full-width-modal quote-modal" id="get-a-quote-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content white-bg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                        <!-- End of .close -->
                    </div>
                    <!-- End of .modal-header -->

                    <div class="modal-body d-flex align-items-center justify-content-center text-center">
                        <?php echo esc_html_decode($content); ?>
                    </div>
                </div>
                <!-- End of .modal-content -->
            </div>
            <!-- End of .modal-dialog -->
        </div>
        <!-- End of .quote-modal -->
        <?php
    }

}


