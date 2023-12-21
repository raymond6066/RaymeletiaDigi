<?php
get_header();
$theme_finder = cynic_theme_finder();
if ($theme_finder == "illustration") {
    cynic_illustration_reviews();
} else {
    cynic_classic_modern_reviews();
}
get_footer();
?>