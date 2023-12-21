<?php
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_single_portfolio();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_single_portfolio_without_page_title();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_single_portfolio();
} else {
    cynic_classic_modern_single_portfolio();
}
?>


