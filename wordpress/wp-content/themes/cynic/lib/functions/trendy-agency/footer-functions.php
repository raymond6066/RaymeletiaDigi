<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */

add_action('wp_footer', 'cynic_footer_modals');

function cynic_footer_modals()
{ ?>
    <!-- Featured-designs modal -->
    <div class="modal fade" id="trendy-agency-modal" tabindex="-1"
         role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="loading-img"><img src="<?php echo get_template_directory_uri() ?>/images/loading.gif"
                                          alt="loading gif"></div>
            <div class="modal-content">
                <svg class="modal-bg" xmlns="http://www.w3.org/2000/svg"
                     width="379px" height="369px">
                    <defs>
                        <linearGradient id="PSgrad_012" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                            <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                        </linearGradient>

                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_012)"
                          d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                    />
                </svg>
                <!-- End of .modal-bg -->

                <svg class="featured-project-modal-bg" xmlns="http://www.w3.org/2000/svg"
                     width="379px"
                     height="369px">
                    <defs>
                        <linearGradient id="PSgrad_013" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                            <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                        </linearGradient>

                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_013)"
                          d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                    />
                </svg>
                <!-- End of .modal-bg -->

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ml-symtwo-24-multiply-cross-math"></i>
                </button>
                <!-- End of .close -->

                <div class="modal-body"></div>
                <!-- End of .modal-body -->
            </div>
            <!-- End of .modal-content -->
        </div>
        <!-- End of .modal-dialog -->
    </div>
    <!-- End of .modal -->

    <?php
    if (getCynicOptionsVal('layouts') == 2 || getCynicOptionsVal('is_header_button_open_with_modal') == "modal") { ?>

        <!-- One Page Modal Starts -->
        <div class="modal fade privacy-modal" id="cynic-pages-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <svg class="modal-bg" xmlns="http://www.w3.org/2000/svg"
                             width="379px" height="369px">
                            <defs>
                                <linearGradient id="PSgrad_016" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                </linearGradient>

                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_016)"
                                  d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                            />
                        </svg>
                        <!-- End of .modal-bg -->

                        <svg class="news-modal-bg" xmlns="http://www.w3.org/2000/svg"
                             width="379px" height="369px">
                            <defs>
                                <linearGradient id="PSgrad_017" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1"/>
                                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0"/>
                                </linearGradient>

                            </defs>
                            <path fill-rule="evenodd" fill="url(#PSgrad_017)"
                                  d="M54.086,281.380 L105.962,327.505 C173.075,387.178 276.496,381.853 336.956,315.610 C397.418,249.367 392.025,147.292 324.911,87.619 L273.035,41.495 C205.921,-18.178 102.501,-12.853 42.040,53.390 C-18.422,119.633 -13.028,221.708 54.086,281.380 Z"
                            />
                        </svg>
                        <!-- End of .modal-bg -->

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ml-symtwo-24-multiply-cross-math"></i>
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
        <!-- End of .privacy-modal -->
        <?php
    }
}

if (!function_exists('cynic_trendy_agency_footer')) {
    function cynic_trendy_agency_footer()
    {
        $get_copyrightText = stripslashes(get_theme_mod('cynic_footer_copyright_text'));
        $copyrightText = !empty($get_copyrightText) ? $get_copyrightText : "";
        if (get_theme_mod('cynic_layouts') == 2) { ?>
            <!-- Footer starts
            ======================================= -->
            <footer class="page-footer">
                <div class="container">
                    <div class="footer-content d-flex justify-content-between">
                        <?php if ($copyrightText) { ?>
                            <p><?php echo $copyrightText; ?></p>
                        <?php } ?>
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
                                <a href="javascript:void(0)" data-post="<?php echo esc_attr($terms_conditions) ?>"
                                   class="cynic-pages-modal"
                                   data-modalwrapper="terms-modal"><?php echo get_the_title($terms_conditions); ?></a>
                                <?php
                            } ?>
                        </p>
                    </div>
                    <!-- End of .footer-content -->
                </div>
                <!-- End of .container -->
            </footer>
            <!-- End of footer -->
            <?php
        } else {

            $bubble_colors = get_theme_mod('cynic_shape-color');
            $get_colors = cynic_get_bubble_color($bubble_colors);
            if(!is_404()) {
                $display_subscription = get_theme_mod('cynic_display_mailchimp');
                $cynic_mailchimp_shortcode = get_theme_mod('cynic_mailchimp_shortcode');
                if ($display_subscription && !empty($cynic_mailchimp_shortcode)) { ?>
                    <!-- Newsletter starts
                    ======================================= -->
                    <section class="newsletter">
                        <div class="container">
                            <?php print apply_filters('the_content', $cynic_mailchimp_shortcode); ?>
                        </div>
                        <!-- End of .container -->
                    </section>
                    <!-- End of .newsletter -->
                    <?php
                }
            }?>
            <footer class="small-agency-footer  grey-bg">
                <svg class="bg-shape shape-footer-top reveal-from-left" xmlns="http://www.w3.org/2000/svg"
                     width="779px"
                     height="759px">
                    <defs>
                        <linearGradient id="PSgrad_05" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_05)"
                          d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>

                <svg class="bg-shape shape-footer-bottom reveal-from-right" xmlns="http://www.w3.org/2000/svg"
                     width="779px"
                     height="759px">
                    <defs>
                        <linearGradient id="PSgrad_06" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="1"/>
                            <stop offset="100%" stop-color="<?php echo esc_attr($get_colors); ?>" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_06)"
                          d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                    />
                </svg>

                <?php
                /** Header Logos**/

                $footerLogoArr = get_theme_mod('cynic_footer_logo');
                $footerLogoStatus = false;
                if ($footerLogoArr && isset($footerLogoArr) && !empty($footerLogoArr)) {
                    $footerLogoStatus = true;
                    $footerlogo_url = $footerLogoArr;
                } else {
                    $footerLogoStatus = true;
                    $footerlogo_url = CYNIC_THEME_URI . '/images/trendy-agency-footer-logo.png';
                }
                if ($footerLogoStatus || (is_active_sidebar('social-media-widget') || is_active_sidebar('services-widget')
                        || is_active_sidebar('support-widget') || is_active_sidebar('resources-widget'))
                ) { ?>
                    <div class="footer-nav-wrapper">
                        <div class="container">
                            <div class="row">

                                <div class="col-md-3">
                                    <?php
                                    if ($footerLogoStatus) { ?>
                                        <a class="footer-logo" href="<?php echo esc_url(home_url('/')); ?>">
                                            <img src="<?php echo esc_url($footerlogo_url) ?>"
                                                 alt="<?php bloginfo('name'); ?>">
                                        </a>
                                    <?php } ?>
                                    <?php dynamic_sidebar('social-media-widget'); ?>
                                </div><!-- .first .widget-area -->
                                <div class="col-md-3">
                                    <nav class="footer-nav">
                                        <?php dynamic_sidebar('services-widget'); ?>
                                    </nav>
                                </div><!-- .second .widget-area -->
                                <div class="col-md-3">
                                    <nav class="footer-nav">
                                        <?php dynamic_sidebar('support-widget'); ?>
                                    </nav>
                                </div><!-- .third .widget-area -->
                                <div class="col-md-3">
                                    <nav class="footer-nav">
                                        <?php dynamic_sidebar('resources-widget'); ?>
                                    </nav>
                                </div><!-- .fourth .widget-area -->

                            </div>
                            <!-- End of .row -->
                        </div>
                        <!-- End of .container -->
                    </div>
                    <!-- End of .footer-nav -->
                <?php } ?>
                <?php
                if ($copyrightText) { ?>
                    <div class="footer-bottom">
                        <div class="container">
                            <p class="text-center"><?php echo $copyrightText; ?></p>
                        </div>
                        <!-- End of .container -->
                    </div>
                    <?php
                } ?>
                <!-- End of .footer-content -->
            </footer>
            <!-- End of footer -->
            <?php
        }
        $is_display_page_header = cynic_get_meta("cynic_page_display_header");
        if (!is_front_page() && array( 'post', 'case_studies', 'portfolio' )) {
            $is_display_page_header = 1;
        } elseif(is_404() || is_search()){
            $is_display_page_header = 1;
        }
        if (isset($is_display_page_header) && $is_display_page_header == 1):
            ?>
            </div>
            <!-- End of .page-wrapper -->
            <?php
        endif;
        ?>
        <?php wp_footer(); ?>
        </body>

        </html>
        <?php
    }
}

add_action('wp_footer', 'cynic_trendy_agency_case_studies_slider_modal');
if (!function_exists('cynic_trendy_agency_case_studies_slider_modal')) {
    function cynic_trendy_agency_case_studies_slider_modal()
    {
        ?>
        <!-- Featured-designs modal -->
        <div class="modal fade case-study-modal " id="cynic_feature_case_studies_slider_modal" tabindex="-1"
             role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="loading-img"><img src="<?php echo get_template_directory_uri() ?>/images/loading.gif"
                                              alt="loading gif"></div>
                <div class="modal-content">
                </div>
                <!-- End of .modal-content -->
            </div>
            <!-- End of .modal-dialog -->
        </div>
        <?php
    }
}

add_action('wp_footer', 'cynic_get_a_quote_modals');

function cynic_get_a_quote_modals()
{
    if (get_theme_mod('cynic_is_header_button_open_with_modal') == "modal") {
        $cynicPageID = get_theme_mod('cynic_header_button_page');
        $pageContent = get_post($cynicPageID);
        $content = apply_filters('the_content', $pageContent->post_content);?>
        <!-- Get a quote Modal Starts -->
        <div class="modal fade get-a-quote-modal" id="get-a-quote-modal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ml-symtwo-24-multiply-cross-math"></i>
                        </button>
                        <!-- End of .close -->
                    </div>
                    <!-- End of .modal-header -->

                    <div class="modal-body">
                        <?php echo esc_html_decode($content); ?>
                    </div>
                    <!-- End of .modal-body -->
                </div>
                <!-- End of .modal-content -->
            </div>
            <!-- End of .modal-dialog -->
        </div>
        <!-- End of .get-a-quote-modal -->
        <?php
    }

}