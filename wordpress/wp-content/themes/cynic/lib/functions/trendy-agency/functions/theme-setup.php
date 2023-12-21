<?php


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
    $ImageSizeArr = cynic_GetImageSizeArr('trendy-agency');

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

/**
 * add filter body class
 */

add_filter('body_class', 'custom_body_class');
function custom_body_class($classes)
{
    $colors = cynic_get_meta("cynic_page_header_colors");
    if ($colors == 2) {
        $classes[] = 'body-bg-style-1';
    } elseif ($colors == 3) {
        $classes[] = 'body-bg-style-3';
    } elseif (is_404()) {
        $header_color = get_theme_mod('cynic_404_header_color');
        if ($header_color == 2) {
            $classes[] = 'body-bg-style-1';
        } elseif ($header_color == 3) {
            $classes[] = 'body-bg-style-3';
        } else {
            $classes[] = 'body-bg-style-2';
        }
    } else if (is_search()) {
        $header_color = get_theme_mod('cynic_search_header_color');
        if ($header_color == 2) {
            $classes[] = 'body-bg-style-1';
        } elseif ($header_color == 3) {
            $classes[] = 'body-bg-style-3';
        } else {
            $classes[] = 'body-bg-style-2';
        }
    } else {
        $classes[] = 'body-bg-style-2';
    }
    $is_display_page_header = cynic_get_meta("cynic_page_display_header");
    $_pageTitle = cynic_get_meta("cynic_page_title");
    if (!is_front_page() && is_singular(array('post', 'case_studies', 'portfolio'))) {
        $is_display_page_header = 1;
        $_pageTitle = 2;
    }
    if (is_search()) {
        $is_display_page_header = 1;
        $_pageTitle = 2;
    }
    if (isset($is_display_page_header) && $is_display_page_header == 1
        && isset($_pageTitle) && $_pageTitle == 2) {
        $classes[] = "inner-page";
    } else if (is_404()) {
        $classes[] = "inner-page error-404-page";
    }
    return $classes;
}


/**
 *
 * @global type $post
 * @param type $option_name
 * @param type $single
 * @return type
 */

function cynic_get_meta($option_name, $single = true)
{
    global $post;
    if (is_home() || is_front_page()) {
        return isset($post->ID) ? get_post_meta(get_queried_object_id(), $option_name, $single) : false;
    } else {
        return isset($post->ID) ? get_post_meta($post->ID, $option_name, $single) : false;
    }
}

//Cynic Author Details
function cynic_author()
{ ?>
    <div class="author-details">
        <h2><?php esc_html_e('Author Details', 'cynic') ?></h2>
        <div class="media">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <?php echo get_avatar(get_the_author_meta('ID'), 105, '', 'author thumbnail image', array('class' => 'author-thumbnail')); ?>
            </a>
            <div class="media-body">
                <h5>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a>
                </h5>
                <?php the_author_meta('description'); ?>
            </div>
            <!-- End of .media-body -->
        </div>
    </div>
<?php }

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

/*Adding Extra Class For Margin Top*/
function cynic_margin_top()
{
    $margin_top = "";
    $is_display_page_header = cynic_get_meta("cynic_page_display_header");
    if (isset($is_display_page_header) && $is_display_page_header != 1) {
        $margin_top = "cynic-margin-top";
    }
    return $margin_top;
}

/*Cynic Get Trendy Page Header*/

function cynic_trendy_page_header()
{
    $_pageTitle = cynic_get_meta("cynic_page_title");
    $headDescription = cynic_get_meta('cynic_page_headingtext');
    $is_display_page_header = cynic_get_meta("cynic_page_display_header");
    if (isset($is_display_page_header) && $is_display_page_header == 1 && isset($_pageTitle) && $_pageTitle == 2) :
        get_page_inner_header($_pageTitle, 'text', $headDescription, '', '', $is_display_page_header);
    endif;
}