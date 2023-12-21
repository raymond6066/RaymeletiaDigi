<?php
/**
 * User: axilweb
 * Date: 10/1/18
 * Time: 7:36 PM
 */

/**
 * Theme setup action
 */
function cynic_setup()
{

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // add_image_size
    $ImageSizeArr = cynic_GetImageSizeArr('illustration');

    if (count($ImageSizeArr) > 1) {
        foreach ($ImageSizeArr as $ImageSize) {
            $imageName = $ImageSize[0];
            $imageWidth = (int)$ImageSize[1];
            $imageHeight = (int)$ImageSize[2];
            $imageCrop = ($ImageSize[3] == 1) ? true : false;
            add_image_size($imageName, $imageWidth, $imageHeight, $imageCrop);
        }
    }

    load_theme_textdomain('cynic', get_template_directory() . '/languages');

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    $register_nav_menu_array = array(
        'primary' => esc_html__('Primary Menu', 'cynic')
    );

    register_nav_menus($register_nav_menu_array);

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
    ));
    add_editor_style(array('css/editor-style.css'));
    $default_color = '#ffffff';
    add_theme_support('custom-background', apply_filters('cynic_custom_background_args', array(
        'default-color' => $default_color,
        'default-attachment' => 'fixed',
    )));
    $defaults = array(
        'default-image' => '',
        'width' => 0,
        'height' => 0,
        'flex-height' => false,
        'flex-width' => false,
        'uploads' => true,
        'random-default' => false,
        'header-text' => true,
        'default-text-color' => '',
        'wp-head-callback' => '',
        'admin-head-callback' => '',
        'admin-preview-callback' => '',
    );
    add_theme_support('custom-header', $defaults);

}

add_action('after_setup_theme', 'cynic_setup');

function cynic_get_meta($option_name, $single = true)
{
    global $post;
    if (is_home() || is_front_page()) {
        return isset($post->ID) ? get_post_meta(get_queried_object_id(), $option_name, $single) : false;
    } else {
        return isset($post->ID) ? get_post_meta($post->ID, $option_name, $single) : false;
    }
}

function cynic_illustration_page_header()
{
    $_pageTitle = cynic_get_meta("cynic_page_title");
    $headDescription = cynic_get_meta('cynic_page_headingtext');
    $is_display_page_header = cynic_get_meta("cynic_page_display_header");
    if (isset($is_display_page_header) && $is_display_page_header == 1 && isset($_pageTitle) && $_pageTitle == 2) :
        get_page_inner_header($_pageTitle, 'text', $headDescription, '', '', '', $is_display_page_header);

    endif;
}

/**
 * @param $blogType
 * @return mixed
 */

function cynicGetblogThumbnilSize($blogType = 'single')
{
    $thumbnilsize = 'full';
    $blog_single_sidebar = cynic_is_check_val('cynic_blog_single_sidebar', true);
    $blog_sidebar = cynic_is_check_val('cynic_blog_sidebar', true);
    if (getCynicOptionsVal('layouts') == 1) {
        if ($blogType == 'single') {
            if ($blog_single_sidebar) {
                $thumbnilsize = 'cynic-illustration-blog-thumbnail-with-sidebar';
            } else {
                $thumbnilsize = 'cynic-illustration-blog-thumbnail-without-sidebar';
            }
        } else {
            if ($blog_sidebar) {
                $thumbnilsize = 'cynic-illustration-blog-thumbnail-with-sidebar';
            } else {
                $thumbnilsize = 'cynic-illustration-blog-thumbnail-without-sidebar';
            }
        }
    }
    return $thumbnilsize;
}

//Cynic inner page pagination
function cynic_inner_page_pagination()
{
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'cynic'),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
    ));
}


/** Allow span tag in tiny mce editor */
add_filter('tiny_mce_before_init', 'cynic_tinymce_init');
function cynic_tinymce_init($settings)
{
    if (isset($settings['extended_valid_elements'])) {
        $settings['extended_valid_elements'] = ', span[style|id|nam|class|lang]';
    } else {
        $settings['extended_valid_elements'] = 'span[style|id|nam|class|lang]';
    }
    $settings['verify_html'] = false;
    return $settings;
}

/**
 * @param $option_index without prefiex
 * @return bool|string
 */

function getCynicOptionsVal($indexval)
{
    $index = 'cynic_' . trim($indexval);
    $option = false;
    $options = get_theme_mod($index);
    if ((isset($options)) && (!empty($options))) {
        $option = $options;
    }
    return $option;
}

