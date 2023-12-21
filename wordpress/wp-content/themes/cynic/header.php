<?php
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_header();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_header();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_header();
} else {
    cynic_classic_modern_header();
}
?>