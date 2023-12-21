<?php
/**
 * Author : axilweb
 * Website: http://www.axilweb.com
 */
if(!function_exists('classic_modern_footer')) {
    function cynic_classic_modern_footer()
    { ?>

        <?php $cynic_options = cynic_options(); ?>
        <footer class="footer">
            <?php if (isset($cynic_options['cynic_scroll_to_top']) && $cynic_options['cynic_scroll_to_top'] == '1' && isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '1') { ?>
                <a class="top-btn page-scroll" href="#top"><span
                        class="icon-chevron-up b-clor regular-text text-center"></span></a>
            <?php } ?>
            <?php if (isset($cynic_options['cynic_display_footer_subscribe'])
                && $cynic_options['cynic_display_footer_subscribe']
                && $cynic_options['cynic_footer_subscribe_text']
            ) {
                ?>
                <div class="grey-dark-bg text-center">
                    <div class="container">
                        <?php print apply_filters('the_content', $cynic_options['cynic_footer_subscribe_text']); ?>
                    </div>
                </div>
                <?php
            } ?>
            <?php if (is_active_sidebar('services-widget')
                || is_active_sidebar('resource-widget') || is_active_sidebar('support-widget')
                || is_active_sidebar('social-media-widget')) { ?>
                <div class="footer-area light-ash-bg">
                    <div class="container">
                        <div class="col-md-2-5 col-sm-6 col-xs-12">
                            <?php dynamic_sidebar('services-widget') ?>
                        </div>
                        <div class="col-md-2-5 col-sm-6 col-xs-12">
                            <?php dynamic_sidebar('resources-widget') ?>
                        </div>
                        <div class="col-md-2-5 col-sm-6 col-xs-12">
                            <?php dynamic_sidebar('support-widget') ?>
                        </div>
                        <div class="col-md-2-5 col-sm-6 col-xs-12">
                            <?php dynamic_sidebar('social-media-widget') ?>
                        </div>
                        <?php if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '1' && isset($cynic_options['cynic_onepage_footer_copyright']) && !empty($cynic_options['cynic_onepage_footer_copyright'])) { ?>
                            <div class="footer-bottom col-xs-12">
                                <p><?php echo html_entity_decode(esc_html($cynic_options['cynic_onepage_footer_copyright'])); ?></p>
                            </div>
                        <?php } ?>
                    </div>

                </div>

            <?php } else {
                if (isset($cynic_options['cynic_display_default_footer']) && $cynic_options['cynic_display_default_footer'] == '1') { ?>
                    <div class="default-op-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <p><?php esc_html_e('&copy; 2017. All rights reserved by Your Company', 'cynic') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </footer>

        <?php if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '2' && isset($cynic_options['cynic_onepage_footer_copyright']) && !empty($cynic_options['cynic_onepage_footer_copyright'])) { ?>
        <!-- Footer part -->
        <footer class="text-center clearfix">
            <p>
                <?php
                echo html_entity_decode(esc_html($cynic_options['cynic_onepage_footer_copyright']));
                if (isset($cynic_options['cynic_onepage_privacy_link']) && !empty($cynic_options['cynic_onepage_terms_condition_link'])) {
                    echo " - " . html_entity_decode(esc_html('<a href="javascript:void(0)" class="proDetModal getPrivacyPage">' . get_the_title($cynic_options['cynic_onepage_privacy_link']) . '</a>'));
                }
                if (isset($cynic_options['cynic_onepage_terms_condition_link']) && !empty($cynic_options['cynic_onepage_terms_condition_link'])) {
                    echo " - " . html_entity_decode(esc_html('<a href="javascript:void(0)" class="proDetModal getTermsConditionsPage">' . get_the_title($cynic_options['cynic_onepage_terms_condition_link']) . '</a>'));
                }
                ?>

            </p>
        </footer>
    <?php } ?>
        <?php if (isset($cynic_options['cynic_scroll_to_top']) && $cynic_options['cynic_scroll_to_top'] == '1' && isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '2') { ?>
        <a class="to-top" href="#top"><span class="icon-chevron-up"></span></a>
    <?php } ?>
        <?php wp_footer(); ?>
        </body>
        </html>

        <?php
    }
}