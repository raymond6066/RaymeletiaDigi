<?php
function get_page_header($_pageTitle)
{
    if (isset($_pageTitle) && $_pageTitle == 2):
        $bannerVariable = getCynicOptionsVal('header_banner_mode');
        $hbg_class = ' ';
        if ($bannerVariable == 2) {
            $hbg_class = ' top-header-image';
        }
        $bg_image = "";
        $imageTag = false;
        if (has_post_thumbnail()) {
            $bg_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $imageTag = 'yes';
        }


        $banner_class = (isset($bg_image) && !empty($bg_image)) ? "ip-banner" . $hbg_class : "details-banner ".$hbg_class; ?>
        <!-- banner starts
        ============================================ -->
        <div class="<?php echo esc_attr($banner_class); ?>" <?php if (!empty($bg_image) && $bannerVariable == 1) : ?> data-bg="<?php echo esc_attr($bg_image); ?>" <?php endif; ?>>
            <?php cynic_breadcrumb($imageTag); ?>
        </div>
        <!-- End of .banner -->
        <?php
    endif;
}