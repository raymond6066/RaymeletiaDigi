<?php
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_single_positions();
} else {
    cynic_classic_modern_single_positions();
}
get_footer();
?>