<?php
/**
 * Template for displaying search forms in Cynic
 *
 * @package WordPress
 * @subpackage Cynic
 * @since Cynic 1.4
 */
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_get_search_form();
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_get_search_form();
} elseif ($theme_finder == "illustration") {
    cynic_illustration_get_search_form();
} else {
    cynic_classic_modern_get_search_form();

}
?>
