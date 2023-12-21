<?php
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_case_studies_single();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_case_studies_single();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_case_studies_single();
} else {
    cynic_classic_modern_case_studies_single();
}
get_footer();
?>