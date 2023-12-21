<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if (!function_exists('cynic_seo_agency_footer')) {
    function cynic_seo_agency_footer()
    { ?>
        <?php
        /**header Free SEO Audit button **/
        if (getCynicOptionsVal('footer_modal_secton_showIn_pages')) {
            $options = $footerButtonPageId = getCynicOptionsVal('footer_modal_secton_showIn_pages');
            $page_object = get_queried_object();
            $page_id = get_queried_object_id();
            $page = get_page($page_id);
            $page_slug = (isset($page->post_name) && !empty($page->post_name)) ? $page->post_name : "";
            if (is_single()) {
                $post_type = get_post_type();
                if ($post_type == "case_studies") {
                    $page_slug = 'case-study-details';
                } else if ($post_type == "positions") {
                    $page_slug = 'career-details';
                } else if ($post_type == "post") {
                    $page_slug = 'blog-single';
                }
            }
            if (!empty($page_slug) && isset($options[$page_slug]) && $options[$page_slug] == 1 && getCynicOptionsVal('footer_modal_button_display')) {
                if (getCynicOptionsVal('footer_button_text')) {
                    $footerbtntext = (getCynicOptionsVal('footer_button_text')) ? getCynicOptionsVal('footer_button_text') : __('Ready to Start Your Project?', 'cynic');
                    $footerbtnOpentype = getCynicOptionsVal('footer_button_open_type');

                    $isopenwithModalfooter = getCynicOptionsVal('is_footer_button_open_with_modal');
                    $footerbtntypeAtt = ($isopenwithModalfooter) ? 'data-toggle=modal data-target=#footer-contact-form-modal' : " target=" . $footerbtnOpentype;
                    $footerhtnhref = 'javascript:void(0)';
                    if (!$isopenwithModalfooter) {
                        $footButtonPageId = getCynicOptionsVal('footer_button_page');
                        $footerhtnhref = get_permalink($footButtonPageId);
                    }

                    ?>
                    <section class="floating-footer-form">
                        <div class="container">
                            <div class="form-heading d-flex justify-content-between align-items-center">
                                <h3 class="visible"><?php echo esc_html(getCynicOptionsVal('footer_modal_button_left_text')) ?></h3>
                                <a class="primary-btn"
                                   data-page="<?php echo esc_attr(getCynicOptionsVal('footer_button_page')) ?>"
                                   href="<?php echo esc_url($footerhtnhref); ?>" <?php echo esc_attr($footerbtntypeAtt); ?>><?php echo esc_html($footerbtntext); ?></a>
                            </div>
                            <!-- End of .form-heading -->
                        </div>
                        <!-- End of .container -->
                    </section>

                    <?php
                }
            }
        }
        ?>


        </div>
        <!-- End of .main -->
        <div id="footer-scroll"></div>
        <?php $cynic_options = cynic_options(); ?>
        <footer class="page-footer">
            <div class="container">
                <?php
                $class = "";
                $site_footerLogoArr = getCynicOptionsVal('footer_logo');
                if (isset($site_footerLogoArr['url']) && !empty($site_footerLogoArr['url'])) {
                    $class = "footer-top";
                } else if (has_nav_menu('footer_menu')) {
                    $class = "footer-top";
                } ?>
                <div class="<?php echo esc_attr($class); ?>">
                    <div class="row">
                        <?php
                        /** Footer Logo**/
                        if (isset($site_footerLogoArr['url']) && !empty($site_footerLogoArr['url'])) {
                            $footerLogo = $site_footerLogoArr['url'];

                            ?>
                            <div class="col-md-4">
                                <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                                    <img src="<?php echo esc_url($footerLogo) ?>"
                                         alt="<?php bloginfo('name'); ?>" class="footer-brand-logo">
                                </a>
                            </div>
                        <?php } ?>
                        <?php
                        /** Footer Menu **/
                        if (has_nav_menu('footer_menu')) :
                            $menu_arg = cynic_nav_menu('footer_menu');
                            wp_nav_menu($menu_arg);
                        endif
                        ?>
                    </div>
                </div>
                <?php if ((is_active_sidebar('services-widget') || is_active_sidebar('about-widget') || is_active_sidebar('partners-widget') || is_active_sidebar('newsletter-widget'))) { ?>
                    <div class="footer-mid">
                        <div class="row">
                            <div class="col-md-3">
                                <?php dynamic_sidebar('services-widget'); ?>
                            </div><!-- .first .widget-area -->
                            <div class="col-md-3">
                                <?php dynamic_sidebar('about-widget'); ?>
                            </div><!-- .second .widget-area -->
                            <div class="col-md-3">
                                <?php dynamic_sidebar('partners-widget'); ?>
                            </div><!-- .third .widget-area -->
                            <div class="col-md-3">
                                <?php dynamic_sidebar('newsletter-widget'); ?>
                            </div><!-- .fourth .widget-area -->
                        </div>
                        <!-- End of .row -->
                    </div>
                    <!-- End of .footer-mid -->
                <?php } ?>

                <div class="footer-bottom">
                    <div class="row align-text-center justify-content-between">
                        <div class="col-md-auto  text-left">
                            <?php if (getCynicOptionsVal('footer_copyright_text')) { ?>
                                <p><?php echo esc_html_decode(getCynicOptionsVal('footer_copyright_text')) ?></p>
                            <?php } else {
                                ?>
                                <p><?php esc_html_e('&copy; 2018 All rights reserved by Your Company', 'cynic') ?></p>
                                <?php
                            }
                            if (getCynicOptionsVal('footer_pp_n_tnc_bar_show')) {
                                ?>
                                <div class="footer-bottom-links">
                                    <?php
                                    $cynicFooterOptions = get_option('cynic_options');
                                    if (getCynicOptionsVal('privacy_policy_link_text')) {
                                        $privacy_policy_link = (isset($cynicFooterOptions['cynic_privacy_policy_link']) && !empty($cynicFooterOptions['cynic_privacy_policy_link'])) ? get_page_link($cynicFooterOptions['cynic_privacy_policy_link']) : '#';
                                        ?>
                                        <a class="<?php (cynic_get_current_page_url()== esc_url($privacy_policy_link))? print 'active':''; ?>" href="<?php echo esc_url($privacy_policy_link); ?>"><?php echo esc_html(getCynicOptionsVal('privacy_policy_link_text')); ?></a>
                                        <?php
                                    }
                                    if (getCynicOptionsVal('terms_condition_link_text')) {
                                        $terms_condition_link = (isset($cynicFooterOptions['cynic_terms_condition_link']) && !empty($cynicFooterOptions['cynic_terms_condition_link'])) ? get_page_link($cynicFooterOptions['cynic_terms_condition_link']) : '#';
                                        ?>
                                        <a class="<?php (cynic_get_current_page_url()== esc_url($terms_condition_link))? print 'active':''; ?>" href="<?php echo esc_url($terms_condition_link); ?>"><?php echo esc_html(getCynicOptionsVal('terms_condition_link_text')); ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <!-- End of .footer-bottom-links -->
                        </div>
                        <!--                 End of .col-md-6-->
                        <?php
                        if (getCynicOptionsVal('footer_social_bar_show')) {
                            ?>
                            <div class="col-md-auto  text-left">
                                <?php
                                if (getCynicOptionsVal('footer_media_title')) {
                                    ?>
                                    <p><?php echo esc_html(getCynicOptionsVal('footer_media_title')); ?></p>
                                    <?php
                                }
                                ?>
                                <div class="footer-bottom-icons d-flex justify-content-md-center">
                                    <?php
                                    echo getsiteSocialMediaHtml($cynic_options);
                                    ?>
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                        <!-- End of .col-md-6 -->
                    </div>
                    <!-- End of .row -->
                </div>
                <!-- End of .footer-bottom -->
            </div>
            <!-- End of .container -->
        </footer>
        <!-- End of .page-footer -->

        <?php wp_footer(); ?>
        <?php
        if (getCynicOptionsVal('scroll_to_top')) {
            ?>
            <a class="go-to-top" href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
            <?php
        }
        ?>


        <?php
        /**Header button Modal Content**/
        if (getCynicOptionsVal('header_button_display')) {
            $headButtonPageId = getCynicOptionsVal('header_button_page');
            $post = get_post($headButtonPageId);
            if ($post && !empty($headButtonPageId)):
                $content = apply_filters('the_content', $post->post_content);
                ?>
                <div class="footer-modal modal fade" id="contact-form-modal" tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="contact-form-modal modal-dialog modal-dialog-centered">
                        <div class="form-content">
                            <div class="form-heading d-flex justify-content-between align-items-center">
                                <h3><?php echo esc_html(getCynicOptionsVal('header_modal_title')) ?></h3>
                                <a href="javascript:void(0)" class="ff-close-btn"
                                   data-dismiss="modal"><?php echo esc_html(getCynicOptionsVal('header_modal_close_text')) ?></a>
                            </div>
                            <?php echo esc_html_decode($content); ?>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        }

        /**Footer button Modal Content**/
        if (getCynicOptionsVal('footer_modal_button_display')) {
            $footerButtonPageId = getCynicOptionsVal('footer_button_page');
            $footerpost = get_post($footerButtonPageId);
            if ($post && !empty($footerButtonPageId)):
                $content = apply_filters('the_content', $footerpost->post_content); ?>
                <div class="footer-modal modal fade" id="footer-contact-form-modal" tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="contact-form-modal modal-dialog modal-dialog-centered">
                        <div class="form-content">
                            <div class="form-heading d-flex justify-content-between align-items-center">
                                <h3><?php echo esc_html(getCynicOptionsVal('footer_modal_title')) ?></h3>
                                <a href="javascript:void(0)" class="ff-close-btn"
                                   data-dismiss="modal"><?php echo esc_html(getCynicOptionsVal('footer_modal_close_text')) ?></a>
                            </div>
                            <?php echo esc_html_decode($content); ?>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        }
        ?>
        </body>

        </html>
        <?php

    }
}