<?php
/**
 * @package WordPress
 * @subpackage Cynic
 * @since 1.0
 * @version 1.9
 */
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_category_archieve();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_get_posts();
}
else if ($theme_finder == "illustration") {
    cynic_illustration_get_posts();
} else {
    cynic_classic_modern_category_archieve();
}
get_footer();
