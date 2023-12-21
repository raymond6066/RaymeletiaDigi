<?php
function cynic_trendy_anchor_link_html($linkArr, $classes = 'custom-btn', $id = '')
{
    $anchorHtml = '';
    if (isset($linkArr['title']) && !empty($linkArr['title'])) {
        $attributes = '';
        $title = esc_html_cynic_trendy_string($linkArr['title']);
        $url = (!empty($linkArr['url'])) ? esc_url($linkArr['url']) : AXILWEB_JAVASCRIPTVOID;
        $rel = esc_attr($linkArr['rel']);
        $target = esc_attr($linkArr['target']);
        $classes = esc_attr($classes);
        $id = esc_attr($id);

        if ($rel) {
            $attributes .= ' rel="' . $rel . '"';
        }

        if ($target) {
            $attributes .= ' target="' . $target . '"';
        }
        if ($classes) {
            $attributes .= ' class="' . $classes . '"';
        }
        if ($id) {
            $attributes .= ' id="' . $id . '"';
        }
        $anchorHtml = '<a href="' . $url . '" ' . $attributes . '>' . $title . '</a>';
    }
    return $anchorHtml;
}

/*******Common escaping function******/
function esc_html_cynic_trendy_string($string)
{
    return html_entity_decode(esc_html($string));
}

function get_bubble_color($colors)
{
    $rgb_color = haxtoRGB($colors);
    $shape_color = !empty($color) ? "rgb(" . $rgb_color . ")" : "rgb(237,247,255)";
    return $shape_color;
}

function haxtoRGB($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $string = $r . ',' . $g . ',' . $b;
    return $string;
}

function cynic_get_posts($postType = "portfolio")
{
    global $wpdb;
    /* Get all posts for posts */
    $postsarr = array();
    $posts = $wpdb->get_results("SELECT post_title,post_name FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='$postType'");
    if (!empty($posts) && !is_wp_error($posts)) {
        foreach ($posts as $post) {
            $postsarr[$post->post_title] = $post->post_name;
        }
    }
    return $postsarr;
}

function cynic_get_pages()
{
    global $wpdb;
    /* Get all pages */
    $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
    $pagearr = array('Select' => '');
    if ($pages && !is_wp_error($pages)) {
        foreach ($pages as $page) {
            $pagearr[$page->post_title] = $page->post_name;
        }
    }

    return $pagearr;

}

function cynic_get_categories($taxonomy = "category")
{
    $categories = get_terms($taxonomy);
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $cat) {
            $catarr[$cat->name] = $cat->slug;
        }
    }
    return $catarr;
}

function cynic_get_links($button_link, $internal_link, $external_link=null)
{
    $link = "";
    if (isset($button_link) && $button_link == 1 && (isset($internal_link)) && is_numeric($internal_link)) {
        $page_link = get_permalink((int)$internal_link);
        $link = (!empty($page_link)) ? $page_link : $external_link;
    } else {
        $pageObj = get_page_by_path($internal_link);
        if ($pageObj) {
            $link = get_permalink((int)$pageObj->ID);
        } else {
            $link = $external_link;
        }
    }
    return $link;
}

function new_excerpt_more($more)
{
    return '';
}

add_filter('excerpt_more', 'new_excerpt_more');



/**
 * Aallowed svg types
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 */
function cynic_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}


if(get_theme_mod('cynic_allowed_svg_types')){
    add_filter('upload_mimes', 'cynic_mime_types');
}
