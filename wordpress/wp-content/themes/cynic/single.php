<?php
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_single_posts();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_single_posts();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_single_post();
} else {
    cynic_classic_modern_single_posts();
}
get_footer();
