<?php
/**
 * The template for displaying search results pages.
 *
 */
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_get_search_results_page($posts, $max_number_pages = $wp_query->max_num_pages);
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_get_search_results_page($posts, $max_number_pages = $wp_query->max_num_pages);
} else {
    cynic_classic_modern_get_search_results_page($posts, $max_number_pages = $wp_query->max_num_pages);
}
get_footer();
