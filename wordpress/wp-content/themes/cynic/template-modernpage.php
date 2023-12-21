<?php
/**
 * Template Name: Modern Page
 * @package cynic
 * @author Axilweb
 */


get_header();

$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_get_default_page_template();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_modern_page_template();
}elseif ($theme_finder == "illustration") {
    cynic_illustration_get_mpdern_page_template();
} else {
    cynic_get_custom_page_template();
}
get_footer();
