<?php
function cynicSEO_get_all_pages()
{
    $pages = get_posts(array('posts_per_page' => -1, 'post_type' => 'page'));
    $pagearr = array('Select' => '');
    if ($pages && !is_wp_error($pages)) {
        foreach ($pages as $page) {
            $pagearr[$page->post_title] = $page->ID;
        }
    }
    return $pagearr;
}

function cynicSEO_get_all_case_studies($post_type = "post")
{
    global $wpdb;
    $postsarr = array();
    $posts = $wpdb->get_results("SELECT post_title,post_name FROM $wpdb->posts WHERE post_status = 'publish' AND post_type='" . $post_type . "'");
    if (!empty($posts) && !is_wp_error($posts)) {
        foreach ($posts as $post) {
            $postsarr[$post->post_title] = $post->post_name;
        }
    }
    return $postsarr;
}

function cynicSEO_features_get_posts_lists($args)
{
    $posts_array = get_posts($args);
    $postsarr = array();
    foreach ($posts_array as $post) {
        $postsarr[$post->post_title] = $post->ID;
    }
    return $postsarr;
}

function cynicSEO_feature_get_catetories_by_texonomy($taxonomy = 'reviews-cat')
{
    global $wpdb;
    $terms = $wpdb->get_results("SELECT t.name,t.slug FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id=tt.term_id WHERE tt.taxonomy='{$taxonomy}' ORDER BY t.name ASC");
    $termsarr = array();
    $termsarr = array('Select' => '');
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $termsarr[$term->name] = $term->slug;
        }
    }
    return $termsarr;
}


function cynicSEO_excerpt_by_id($post_id = 0)
{
    global $post;
    $save_post = $post;
    $post = get_post($post_id);
    setup_postdata($post);
    $excerpt = get_the_excerpt();
    $post = $save_post;
    wp_reset_postdata($post);
    return $excerpt;
}

/*******Common escaping function******/
function esc_html_cynicSEO_string($string)
{
    return html_entity_decode(esc_html($string));
}

function cynicSEO_anchor_link_html($linkArr, $classes = 'primary-btn', $id = '')
{
    $anchorHtml = '';
    if (isset($linkArr['title']) && !empty($linkArr['title'])) {
        $attributes = '';
        $title = esc_html_cynicSEO_string($linkArr['title']);
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

function cynicSEO_anchor_link_array($linkArr, $classes = 'primary-btn', $id = '', $force = false)
{
    $resultArr[0] = false;
    $resultArr[1] = '';
    $resultArr[2] = '';
    if ((isset($linkArr['title']) && !empty($linkArr['title'])) || $force) {
        $attributes = '';
        $title = esc_html_cynicSEO_string($linkArr['title']);
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
        $resultArr[0] = true;
        $resultArr[1] = '<a href="' . $url . '" ' . $attributes . '>' . $title;
        $resultArr[2] = '</a>';
    }
    return $resultArr;
}