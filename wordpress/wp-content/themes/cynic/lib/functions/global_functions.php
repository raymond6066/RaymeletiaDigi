<?php

function esc_html_decode($string)
{
    return html_entity_decode(esc_html($string));
}

/**
 * @param $theme_type
 * @return Array
 */

function cynic_GetImageSizeArr($theme_type = 'all')
{

    $commonSize = array(
        array('cynic-featured-image', 2000, 1200, 1),
        array('cynic-thumbnail-avatar', 100, 100, 1),
        array('cynic-post-thumbnail', 108, 108, 1),
    );


    $ClassModernAgency = array(
        array('cynic-gallery-thumbnail', 281.5, 334.281, 1),
        array('cynic-testimonial-avatar', 68, 68, 1),
        array('cynic-blog-grids', 360, 220, 1),
        array('cynic-portfolio-thumb', 153, 133, 1),
        array('cynic-portfolio-vlong', 360, 590, 1),
        array('cynic-portfolio-hveq', 400, 400, 1),
        array('cynic-team-hveq', 360, 300, 1),
        array('cynic-positions-hveq', 360, 300, 1),
        array('cynic-portfolio-hlong', 750, 280, 1),
        array('cynic-tab-img', 360, 292, 1),
        array('cynic-onepage-portfolio-img', 360, 260, 1),
        array('cynic-related-case', 555, 360, 1),
        array('cynic-related-case-medium', 360, 208, 1)
    );

    $seoAgency = array(
        array('cynic-portfolio-thumbnail', 555, 370, 1),
        array('cynic-recentpost-thumb', 50, 50, 1),
        array('cynic-global-thumbnail', 490, 330, 1),
        array('cynic-case-studies-thumbnail', 555, 265, 1),
        array('cynic-top-banner-img', 261, 266, 1),
        array('cynic-top-banner-browser', 763, 447, 1),
        array('cynic-case-studies-single-thumbnail', 555, 370, 1),
        array('cynic-recent-blog-thumbnail', 360, 220, 1),
        array('cynic-blog-thumbnail-without-slidebar', 1140, 9999, 0),
        array('cynic-blog-thumbnail-with-slidebar', 750, 9999, 0)
    );

    $trendyAgency = array(
        array('cynic-trendy-portfolio-img', 380, 292, 1),
        array('cynic-trendy-related-case', 525, 460, 1),
        array('cynic-trendy-team-avator', 380, 467, 1),
        array('cynic-trendy-blog-thumbnails', 420, 366, 1),
        array('cynic-trendy-tab-img', 420, 320, 1),
        array('cynic-trendy-blog-thumbnail-with-slidebar', 1230, 597, 1),
        array('cynic-trendy-blog-thumbnail-without-slidebar', 790, 351, 1),
        array('cynic-trendy-custom-blog', 420, 336, 1),
        array('cynic-trendy-related-blog-thumbnail', 380, 304, 1),
    );

    $illustrationAgency = array(
        array('cynic-illustration-portfolio-thumb-img', 296, 336, 1),
        array('cynic-illustration-blog-thumb-img', 336, 236, 1),
        array('cynic-illustration-blog-variasion-thumb-img', 388, 260, 1),
        array('cynic-illustration-cs-thumb-img', 398, 306, 1),
        array('cynic-illustration-small-portfolio-thumb-img', 390, 400, 1),

        array('cynic-illustration-blog-thumbnail-with-sidebar', 810, 500, 1),
        array('cynic-illustration-blog-thumbnail-without-sidebar', 1230, 650, 1),



    );
    if ($theme_type == 'classic-modern-agency') {
        return array_merge_recursive($ClassModernAgency, $commonSize);
    } elseif ($theme_type == 'seo-agency') {
        return array_merge_recursive($seoAgency, $commonSize);
    } elseif ($theme_type == 'trendy-agency') {
        return array_merge_recursive($trendyAgency, $commonSize);
    } elseif ($theme_type == 'illustration') {
        return array_merge_recursive($illustrationAgency, $commonSize);
    } else {
        return array_merge_recursive($commonSize, $ClassModernAgency, $seoAgency, $trendyAgency, $illustrationAgency);
    }
}

/**
 *  checking
 * @return bool
 */
function cynic_demoImportModeIsEnabled()
{
    $CynicOptions = get_option('cynic_options');
    $cynic_theme_demo_import = get_option('cynic_theme_demo_import');

    if ((isset($CynicOptions['cynic_theme_mode']) && $CynicOptions['cynic_theme_mode'] == '2') &&
        (!empty($cynic_theme_demo_import) && $cynic_theme_demo_import == 'general')) {
        return true;
    } else {
        return false;
    }
}

function cynic_get_current_page_url()
{
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function cynic_newline($string)
{
    if (empty($string)) {
        return $string;
    }
    return str_replace(array("\r\n", "\r", "\n"), '<span class="newline"></span>', $string);
}