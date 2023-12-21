<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
$theme_finder = cynic_theme_finder();
if ($theme_finder == "seo-agency") {
    cynic_seo_agency_comments($user_identity);
} elseif ($theme_finder == "trendy-agency") {
    cynic_trendy_agency_comments();
} else if ($theme_finder == "illustration") {
    cynic_illustration_comments();
} else {
    cynic_classic_modern_comments($user_identity);
}
