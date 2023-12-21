<?php
//To Get The Sidebar
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_get_sidebar();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_get_sidebar();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_get_sidebar();
} else {
    cynic_classic_modern_get_sidebar();
}