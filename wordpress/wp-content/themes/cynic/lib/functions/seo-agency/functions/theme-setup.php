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
    $ImageSizeArr = cynic_GetImageSizeArr('seo-agency');

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
    if (getCynicOptionsVal('theme_mode') == 2) {
        $register_nav_menu_array = array_merge($register_nav_menu_array,
            array('top_menu' => esc_html__('Top Menu', 'cynic')),
            array('footer_menu' => esc_html__('Footer Menu', 'cynic'))
        );
    }

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
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_theme_mode']) && $cynic_options['cynic_theme_mode'] == 1) {
        $classes[] = 'unit-mode';
    }
    $options = $footerButtonPageId = getCynicOptionsVal('footer_modal_secton_showIn_pages');
    $page_object = get_queried_object();
    $page_id = get_queried_object_id();
    $page = get_page($page_id);
    $page_slug = (isset($page->post_name) && !empty($page->post_name)) ? $page->post_name : "";
    if (is_singular()) {
        $post_type = get_post_type();
        if ($post_type == "case_studies") {
            $page_slug = 'case-study-details';
        } else if ($post_type == "positions") {
            $page_slug = 'career-details';
        } else if ($post_type == "post") {
            $page_slug = 'blog-single';
        }
    }
    if (!empty($page_slug) && isset($options[$page_slug]) && $options[$page_slug] == 1 && getCynicOptionsVal('footer_modal_button_display')) {
        if (getCynicOptionsVal('footer_button_text')) {
            $classes[] = 'cynic-padding';
        }
    }
    return $classes;
}


//cynic breadcrumbs
function cynic_breadcrumb($imageTag = 'no')
{

    global $post;
    $author_id = $post->post_author;
    $post_author = get_user_by('id', $post->post_author);
    $post_author_name = (isset($post_author->data->display_name) && !empty($post_author->data->display_name)) ? $post_author->data->display_name : "";

    $id = get_option('page_for_posts');
    $posttype = get_post_type();
    $page_name = esc_html((trim(getCynicOptionsVal('breadcrumb_blog_title'))) ? getCynicOptionsVal('breadcrumb_blog_title') : "Blog");
    if (isset($id) && !empty($id) && (isset($post->post_type) && $post->post_type != "page")) {
        $page_name = get_the_title($id);
    } else if (isset($post->post_type) && $post->post_type == "page" && isset($post->post_title) && !empty($post->post_title)) {
        $page_name = $post->post_title;
    } else if (isset($post->post_type) && $post->post_type == "post") {
        $page_name = $post->post_title;
    }
    $pageDescription = cynic_get_meta('cynic_page_headingtext');
    $bannerVariable = getCynicOptionsVal('header_banner_mode'); ?>

    <div class="content d-flex align-items-center justify-content-center text-center">
        <div class="container">
            <?php
            if (getCynicOptionsVal('is_enabled_breadcrumb')) {
                ?>
                <div class="breadcrumb-holder d-inline-flex">
                    <nav aria-label="breadcrumb">
                        <?php cynic_breadcrumb_html() ?>
                    </nav>
                </div>
            <?php } ?>
            <!-- End of .breadcrumb-holder -->
            <?php if (is_single()) { ?>
                <h1><?php echo esc_html(wp_strip_all_tags(get_the_title())); ?></h1>
                <?php if ($posttype == "post") { ?>
                    <div class="post-info">
                        <a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>">
                            <i class="icon-Calendar---Check"></i><?php the_time('j F, Y'); ?></a>
                        <?php if (!empty($post_author_name)) { ?>
                            <a href="<?php echo get_author_posts_url($author_id); ?>">
                                <i class="icon-User"></i><?php echo esc_html($post_author_name) ?></a>
                        <?php } ?>
                        <a href="<?php echo esc_url(get_comments_link(get_the_ID())) ?>">
                            <i class="icon-Comment"></i><?php printf(_nx('%2s Comment', '%2s Comments', get_comments_number(), 'comments title', 'cynic'), number_format_i18n(get_comments_number())) ?>
                        </a>
                        <span class="category-icon">
                            <i class="icon-Tag"></i>
                            <?php if (has_category()) { ?><?php echo get_the_category_list(esc_html__('&#44; ', 'cynic')); ?><?php } ?>
                        </span>
                    </div>
                <?php } ?>
                <!-- End of .post-info -->
            <?php } else { ?>
                <h1><?php echo esc_html($page_name); ?></h1>
                <?php
                if (isset($pageDescription) && !empty($pageDescription)) {
                    echo html_entity_decode(esc_html($pageDescription));
                } ?>
                <?php
                if ($imageTag == 'yes') {
                    if ($bannerVariable == 2) {
                        echo wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full');
                    }
                }
            } ?>
        </div>
        <!-- End of .container -->
    </div>
<?php }


function cynic_breadcrumb_html()
{
    // Settings
    $tropcaOptions = cynic_options();
    $separator = (isset($tropcaOptions['cynic_breadcrumb_separator']) && !empty($tropcaOptions['cynic_breadcrumb_separator'])) ? $tropcaOptions['cynic_breadcrumb_separator'] : '&gt;';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumb';
    $home_title = (isset($tropcaOptions['cynic_breadcrumb_home_title']) && !empty($tropcaOptions['cynic_breadcrumb_home_title'])) ? $tropcaOptions['cynic_breadcrumb_home_title'] : 'Home';
    $blog_title = esc_html(trim((getCynicOptionsVal('breadcrumb_blog_title'))) ? getCynicOptionsVal('breadcrumb_blog_title') : "Blog");

    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'sample_product_cat';

    // Get the query & post information
    global $post, $wp_query;

    // Do not display on the homepage
    if (!is_front_page()) {

        $post_type = get_post_type();
        $post_blog_permalink = get_permalink(get_option('page_for_posts'));

        // Build the breadcrums
        echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home breadcrumb-item"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . $separator . '</a></li>';

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

            echo '<li class="item-current item-archive breadcrumb-item">' . __('Archives', 'cynic') . '</li>';

        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . wp_strip_all_tags($post_type_object->labels->name) . $separator . '</a></li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="breadcrumb-item item-current item-archive">' . $custom_tax_name . '</li>';

        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="breadcrumb-item item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . wp_strip_all_tags($post_type_object->labels->name) . $separator . '</a></li>';

            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = $category[count($category) - 1];

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                if ($post_type == 'post') {
                    $cat_display .= '<li class="breadcrumb-item item-cat"><a class="bread-cat bread-post-type-' . $post_type . '" href="' . $post_blog_permalink . '" title="' . $blog_title . '">' . $blog_title . $separator . '</a></li>';
                }
            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo esc_html_decode($cat_display);
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '">' . wp_strip_all_tags(get_the_title()) . '</li>';

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {
                echo '<li class="breadcrumb-item item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . wp_strip_all_tags($cat_name) . $separator . '</a></li>';
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '">' . wp_strip_all_tags(get_the_title()) . '</li>';
            } else {
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '">' . wp_strip_all_tags(get_the_title()) . '</li>';
            }

        } else if (is_category()) {
            // Category page
            echo '<li class="breadcrumb-item item-current item-cat">' . wp_strip_all_tags(single_cat_title('', false)) . '</li>';

        } else if (is_page()) {
            // Standard page
            if ($post->post_parent) {

                // If child page, get parents
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);
                // Parent page loop
                if (!isset($parents)) $parents = null;
                foreach ($anc as $ancestor) {
                    $parents .= '<li class="breadcrumb-item item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . wp_strip_all_tags(get_the_title($ancestor)) . $separator . '</a></li>';
                }
                // Display parent pages
                echo esc_html_decode($parents);
                // Current page
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '">' . wp_strip_all_tags(get_the_title()) . '</li>';

            } else {
                // Just display current page if not parents
                echo '<li class="breadcrumb-item item-current item-' . $post->ID . '">' . wp_strip_all_tags(get_the_title()) . '</li>';
            }

        } else if (is_tag()) {
            // Tag page
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;
            // Display the tag name
            echo '<li class="breadcrumb-item item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '">' . wp_strip_all_tags($get_term_name) . '</li>';

        } elseif (is_day()) {
            // Day archive
            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' ' . __('Archives', 'cynic') . $separator . '</a></li>';
            // Month link
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' ' . __('Archives', 'cynic') . $separator . '</a></li>';
            // Day display
            echo '<li class="breadcrumb-item item-current item-' . get_the_time('j') . '">' . get_the_time('jS') . ' ' . get_the_time('M') . __('Archives', 'cynic') . '</li>';

        } else if (is_month()) {
            // Month Archive
            // Year link
            echo '<li class="breadcrumb-item item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __('Archives', 'cynic') . $separator . '</a></li>';
            // Month display
            echo '<li class="breadcrumb-item item-month item-month-' . get_the_time('m') . '">' . get_the_time('M') . __('Archives', 'cynic') . '</li>';

        } else if (is_year()) {
            // Display year archive
            echo '<li class="breadcrumb-item item-current item-current-' . get_the_time('Y') . '">' . get_the_time('Y') . __('Archives', 'cynic') . '</li>';

        } else if (is_author()) {
            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata($author);
            // Display author name
            echo '<li class="breadcrumb-item item-current item-current-' . $userdata->user_nicename . '">' . __('Author', 'cynic') . ': ' . wp_strip_all_tags($userdata->display_name) . '</li>';

        } else if (get_query_var('paged')) {
            // Paginated archives
            echo '<li class="breadcrumb-item item-current item-current-' . get_query_var('paged') . '">' . __('Page', 'cynic') . ' ' . wp_strip_all_tags(get_query_var('paged')) . '</li>';
        } else if (is_search()) {
            // Search results page
            echo '<li class="breadcrumb-item item-current item-current-' . get_search_query() . '">' . __('Search results for', 'cynic') . ': ' . get_search_query() . '</li>';
        } elseif ($post_type == 'post') {
            ?>
            <li class="breadcrumb-item item-current"><?php echo esc_html($blog_title) ?></li>
            <?php
        } elseif (is_404()) {
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
        echo '</ol>';

    }
}

function cynic_excerpt_more($more)
{
    return '';
}

add_filter('excerpt_more', 'cynic_excerpt_more');

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
    return isset($post->ID) ? get_post_meta($post->ID, $option_name, $single) : false;
}

//Cynic Author Details
function cynic_author()
{ ?>
    <div class="about-author">
        <h3><?php esc_html_e('About the Author', 'cynic') ?></h3>
        <div class="media author-media row">
            <a class="media-figure col-md"
               href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                <div class="blogger-img"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
            </a>
            <div class="media-body col-md">
                <h4 class="mt-0">
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a>
                </h4><?php the_author_meta('description'); ?>
            </div>
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


function getsiteSocialMediaHtml($cynic_options)
{

    $html = '';
    if (isset($cynic_options['cynic_footer_media_facebook']) && !empty($cynic_options['cynic_footer_media_facebook'])) {
        $html .= '<a class="c-facebook" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_facebook']) . '">
            <i class="fa fa-facebook"></i>
        </a>';
    }

    if (isset($cynic_options['cynic_footer_media_twitter']) && !empty($cynic_options['cynic_footer_media_twitter'])) {
        $html .= '<a class="c-twitter" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_twitter']) . '">
            <i class="fa fa-twitter"></i>
        </a>';
    }

    if (isset($cynic_options['cynic_footer_media_instagram']) && !empty($cynic_options['cynic_footer_media_instagram'])) {
        $html .= '<a class="c-instagram" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_instagram']) . '">
            <i class="fa fa-instagram"></i>
        </a>';
    }

    if (isset($cynic_options['cynic_footer_media_pinterest']) && !empty($cynic_options['cynic_footer_media_pinterest'])) {
        $html .= '<a class="c-pinterest" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_pinterest']) . '">
            <i class="fa fa-pinterest"></i>
        </a>';
    }

    if (isset($cynic_options['cynic_footer_media_google_plus']) && !empty($cynic_options['cynic_footer_media_google_plus'])) {
        $html .= '<a class="c-google-plus" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_google_plus']) . '">
            <i class="fa fa-google-plus"></i>
        </a>';
    }
    if (isset($cynic_options['cynic_footer_media_youtube']) && !empty($cynic_options['cynic_footer_media_youtube'])) {
        $html .= '<a class="c-youtube" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_youtube']) . '">
            <i class="fa fa-youtube"></i>
        </a>';
    }
    if (isset($cynic_options['cynic_footer_media_linkedin']) && !empty($cynic_options['cynic_footer_media_linkedin'])) {
        $html .= '<a class="c-linkedin" target="_blank" href="' . esc_url($cynic_options['cynic_footer_media_linkedin']) . '"><i class="fa fa-linkedin"></i>
        </a>';
    }
    return $html;
}