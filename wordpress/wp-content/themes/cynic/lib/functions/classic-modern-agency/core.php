<?php
/**
 * Author: Axilweb
 * Website: http://www.axilweb.com
 */
require_once CYNIC_THEME_CORE_INCLUDES . 'theme-config.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'class-cynic-walker-nav-menu-edit.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'class-cynic-walker-nav-menu.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'class-cynic-mega-walker-nav-menu.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'actions.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'customization.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'widgets/cynic_social.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'style.php';
require_once CYNIC_THEME_CORE_INCLUDES . 'class-cynic-customer-reviews.php';


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
    $ImageSizeArr = array();
    if (cynic_demoImportModeIsEnabled()) {
        $ImageSizeArr = cynic_GetImageSizeArr('all');
    } else {
        $ImageSizeArr = cynic_GetImageSizeArr('classic-modern-agency');
    }

    if (count($ImageSizeArr) > 1) {
        foreach ($ImageSizeArr as $ImageSize) {
            $imageName = $ImageSize[0];
            $imageWidth = (int)$ImageSize[1];
            $imageHeight = (int)$ImageSize[2];
            $imageCrop = ($ImageSize[3] == 1) ? true : false;
            add_image_size($imageName, $imageWidth, $imageHeight, $imageCrop);
        }
    }

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    load_theme_textdomain('cynic', get_template_directory() . '/languages');

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'cynic'),
        'secondary' => esc_html__('Secondary Menu', 'cynic'),
    ));

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


function cynic_enqueue_scripts()
{
    //fonts

    $cynic_options = cynic_options();
    $fontareas = array('body_font', 'headings_font', 'menu_font');
    $fontrootsrc = 'https://fonts.googleapis.com/css';
    $variants = ':300,300i,400,400i,600,600i,700,700i,800,800i';
    $oppref = 'cynic_';
    $fontsrc = array();
    foreach ($fontareas as $fontop) {
        if (isset($cynic_options[$oppref . $fontop])) {
            $fontdata = $cynic_options[$oppref . $fontop];
            if (isset($fontdata['font-family']) && !in_array($fontdata['font-family'], $fontsrc)) {
                $fontsrc[$oppref . $fontop] = $fontdata['font-family'];
            }
        }
    }
    if (!empty($fontsrc)) {
        foreach ($fontsrc as $fkey => $fontfamily) {
            $fsrc = add_query_arg(array('family' => $fontfamily . $variants), $fontrootsrc);
            wp_enqueue_style($fkey, $fsrc);
        }
    }

    // styles
    wp_enqueue_style('linearicons', CYNIC_THEME_URI . '/css/classic-modern-agency/linearicons-font.css', array());
    wp_enqueue_style('flatcons', CYNIC_THEME_URI . '/css/classic-modern-agency/flaticon.css', array());
    wp_enqueue_style('bootstrap', CYNIC_THEME_URI . '/css/classic-modern-agency/bootstrap.css', array());
    wp_enqueue_style('magnific-popup', CYNIC_THEME_URI . '/css/classic-modern-agency/magnific-popup.css', array());
    wp_enqueue_style('font-awesome', CYNIC_THEME_URI . '/css/classic-modern-agency/font-awesome.min.css', array());
    wp_enqueue_style('owl-carousel', CYNIC_THEME_URI . '/css/classic-modern-agency/owl.carousel.css', array());
    wp_enqueue_style('owl-carousel-theme-default', CYNIC_THEME_URI . '/css/classic-modern-agency/owl.theme.default.min.css', array());
    wp_enqueue_style('cynic-core', CYNIC_THEME_URI . '/css/classic-modern-agency/main.css', array(), CYNIC_THEME_VERSION);

    if (isset($cynic_options['cynic_menu']) && $cynic_options['cynic_menu'] == 0) {
        wp_enqueue_style('cynic-menu', CYNIC_THEME_URI . '/css/classic-modern-agency/mega-menu.css', array(), CYNIC_THEME_VERSION);
    } else {
        wp_enqueue_style('cynic-menu', CYNIC_THEME_URI . '/css/classic-modern-agency/normal-menu.css', array(), CYNIC_THEME_VERSION);
    }
    wp_enqueue_style('cynic-base', CYNIC_THEME_URI . '/css/classic-modern-agency/base.css', array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic', get_stylesheet_uri(), array(), CYNIC_THEME_VERSION);
    wp_enqueue_style('cynic-responsive', CYNIC_THEME_URI . '/css/classic-modern-agency/responsive.css', array(), CYNIC_THEME_VERSION);

    $custom_styles = cynic_get_custom_styles();
    wp_add_inline_style('cynic', $custom_styles);

    // scripts
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }

    wp_enqueue_script('cynic-comment-script', CYNIC_THEME_URI . '/js/classic-modern-agency/jquery.validate.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('modernizr', CYNIC_THEME_URI . '/js/classic-modern-agency/modernizr.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('magnific-popup', CYNIC_THEME_URI . '/js/classic-modern-agency/jquery.magnific-popup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('bootstrap', CYNIC_THEME_URI . '/js/classic-modern-agency/bootstrap.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('counterup', CYNIC_THEME_URI . '/js/classic-modern-agency/jquery.counterup.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('waypoints', CYNIC_THEME_URI . '/js/classic-modern-agency/waypoints.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('parallax', CYNIC_THEME_URI . '/js/classic-modern-agency/parallax.min.js', array('jquery'), CYNIC_THEME_VERSION, true);
    wp_enqueue_script('owl-carousel', CYNIC_THEME_URI . '/js/classic-modern-agency/owl.carousel.min.js', array('jquery'), CYNIC_THEME_VERSION, true);

    wp_enqueue_script('cynic-script', CYNIC_THEME_URI . '/js/classic-modern-agency/script.js', array('jquery', 'jquery-effects-core'), CYNIC_THEME_VERSION, true);
    wp_localize_script('cynic-script', 'cynic_ajax', esc_url(admin_url('admin-ajax.php')));
    wp_localize_script('cynic-script', 'cynic_homeurl', esc_url(home_url('/')));
}

add_action('wp_enqueue_scripts', 'cynic_enqueue_scripts', 1000);
add_action('admin_enqueue_scripts', 'cynic_admin_scripts', 1000);

function cynic_admin_scripts($page = '')
{
    if ($page == 'nav-menus.php') {
        wp_enqueue_style('linearicons', CYNIC_THEME_URI . '/css/classic-modern-agency/linearicons-font.css', array(), CYNIC_THEME_VERSION);
        wp_enqueue_script('linearicons', CYNIC_THEME_URI . '/js/classic-modern-agency/linearicons.js', array('jquery'), CYNIC_THEME_VERSION, true);
    }
    wp_enqueue_style('cynic-admin', CYNIC_THEME_URI . '/css/classic-modern-agency/admin.css', array(), CYNIC_THEME_VERSION);
    if ($page == 'widgets.php') {
        wp_enqueue_media();
    }
    wp_enqueue_script('cynic-admin', CYNIC_THEME_URI . '/js/classic-modern-agency/admin.js', array('jquery'), CYNIC_THEME_VERSION, true);
    $strings = array(
        'media_title' => esc_html__('Select or Upload Media Of Your Chosen Persuasion', 'cynic'),
        'media_button_title' => esc_html__('Use this media', 'cynic'),
    );
    wp_localize_script('cynic-admin', 'cynic_admin', $strings);
}


/**
 *  get menu arguments
 */
function cynic_nav_menu()
{

    global $post;
    $cynic_options = cynic_options();
    $arg = array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'nav navbar-nav navbar-right',
        'walker' => new cynic_Walker_Nav_Menu,
    );
    if (isset($cynic_options['cynic_menu']) && $cynic_options['cynic_menu'] == 0) {
        $arg = array(
            'theme_location' => 'primary',
            'depth' => 3,
            'container' => false,
            'menu_class' => 'nav navbar-nav navbar-right',
            'walker' => new cynicMega_Walker_Nav_Menu()
        );
    }
    return $arg;
}

/**
 * Register Widgets
 */
add_action('widgets_init', 'cynic_widgets_init');

function cynic_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Blog Sidebar', 'cynic'),
        'id' => 'blog-sidebar',
        'description' => esc_html__('Blog sidebar', 'cynic'),
        'before_widget' => '<div id="%1$s" class="widget blog-sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title font-alt">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Services Widget', 'cynic'),
        'id' => 'services-widget',
        'description' => esc_html__('Footer Services Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="regular-text text-color-light">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Resources Widget', 'cynic'),
        'id' => 'resources-widget',
        'description' => esc_html__('Footer Resources Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="regular-text text-color-light">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Support Widget', 'cynic'),
        'id' => 'support-widget',
        'description' => esc_html__('Footer Support Widget', 'cynic'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="regular-text text-color-light">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Social Media Widget', 'cynic'),
        'id' => 'social-media-widget',
        'description' => esc_html__('Footer sidebar 5', 'cynic'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="regular-text text-color-light">',
        'after_title' => '</h4>',
    ));
}

## SEO Agency widget for initalizing widget for solving SEO Agency demo import
require_once CYNIC_THEME_CORE_FUNCTIONS . 'classic-modern-agency/seo-agency-widgets-register.php';

/**
 * Body classes filter
 */
add_filter('body_class', 'cynic_filter_body_class', 1000);
function cynic_filter_body_class($classes)
{
    global $post;
    $cynic_options = cynic_options();
    if (!isset($cynic_options['cynic_sticky_header']) || !$cynic_options['cynic_sticky_header']) {
        $classes[] = 'disable-sticky-header';
    }
    if (is_404() || is_single() || is_home() || is_category() || is_tag() || is_archive() || is_search() || (is_page() && !has_post_thumbnail($post) && !get_page_template_slug())) {
        $classes[] = 'no-featured-image';
    }
    if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == '2') {
        $classes[] = 'page-template-template-modernpage';
    }

    return $classes;
}

function cynic_add_scripts()
{
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_footer_google_api']) && !empty($cynic_options['cynic_footer_google_api']) && !is_single()) {
        wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=' . $cynic_options['cynic_footer_google_api'] . '&callback=initMap', null, null, true);
    }
}

add_action('wp_enqueue_scripts', 'cynic_add_scripts');

if (!function_exists('cynic_classic_modern_comments')) {
    function cynic_classic_modern_comments($user_identity = null)
    {
        if (post_password_required()) {
            return;
        } ?>

        <div id="comments" class="comments-area">

            <?php if (have_comments()) : ?>
                <h2 class="b-clor"><?php
                    $comments_number = get_comments_number();
                    if (1 === $comments_number) {
                        /* translators: %s: post title */
                        printf(esc_html_x('1 comment', 'comments title', 'cynic'));
                    } else {
                        printf(
                        /* translators: 1: number of comments, 2: post title */
                            _nx(
                                '%1$s Comment',
                                '%1$s Comments',
                                $comments_number,
                                'Comments title',
                                'cynic'
                            ),
                            number_format_i18n($comments_number)
                        );
                    }
                    ?></h2>
                <hr class="dark-line">

                <?php the_comments_navigation(); ?>

                <?php
                wp_list_comments(array(
                    'style' => 'ul',
                    'short_ping' => true,
                    'avatar_size' => 42,
                    'callback' => 'cynic_comment_cb',
                ));
                ?>

                <?php the_comments_navigation(); ?>

            <?php endif; // Check for have_comments().
            ?>

            <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
                ?>
                <p class="no-comments"><?php esc_html_e('Comments are closed.', 'cynic'); ?></p>
            <?php endif; ?>
            <?php
            $required_text = wp_kses_post(sprintf(' ' . __('Required fields are marked %s', 'cynic'), '<span class="required">*</span>'));
            $commenter = wp_get_current_commenter();
            $req = get_option('require_name_email');
            $aria_req = ($req ? " aria-required='true'" : '');
            $fields = array(

                'author' =>
                    '<div class="col-sm-6 col-xs-12">
					<div class="form-group customised-formgroup"> <span class="icon-user"></span>' .
                    '<input id="author" class="form-control" name="author" type="text" placeholder="' . sprintf(esc_attr__('Name%s', 'cynic'), ($req ? ' *' : '')) . '" value="' . esc_attr($commenter['comment_author']) .
                    '" size="30"' . $aria_req . ' /></div></div>',

                'email' =>
                    '<div class="col-sm-6 col-xs-12">
					<div class="form-group customised-formgroup"> <span class="icon-envelope"></span>' .
                    '<input id="email" name="email" class="form-control" type="text" placeholder="' . sprintf(esc_attr__('Email%s', 'cynic'), ($req ? ' *' : '')) . '" value="' . esc_attr($commenter['comment_author_email']) .
                    '" size="30"' . $aria_req . ' /></div></div>',


                'url' =>
                    '<div class="col-sm-12 col-xs-12">
					<div class="form-group customised-formgroup"> <span class="icon-laptop"></span>' .
                    '<input id="url" name="url" class="form-control" placeholder="' . esc_attr__('Website', 'cynic') . '" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                    '" size="30" /></div></div>',
            );
            $args = array(
                'id_form' => 'commentform',
                'class_form' => 'comment-form customise-form',
                'id_submit' => 'submit',
                'class_submit' => 'btn btn-fill submit',
                'name_submit' => 'submit',
                'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
                'submit_field' => '<div class="form-submit col-xs-12 col-sm-12">%1$s %2$s</div>',
                'title_reply_before' => '<div class="leave-a-reply-padding"><h2 id="reply-title" class="comment-reply-title b-clor">',
                'title_reply_after' => '</h2><hr class="dark-line"></div>',
                'title_reply' => esc_html__('Leave a Reply', 'cynic'),
                'title_reply_to' => esc_html__('Leave a Reply', 'cynic'),
                'cancel_reply_link' => esc_html__('Cancel Reply', 'cynic'),
                'label_submit' => esc_html__('Submit comment', 'cynic'),
                'format' => 'xhtml',
                'comment_notes_before' => '<div class="comment-notes col-sm-12"><span id="email-notes">' . esc_html__('Your email address will not be published.', 'cynic') . '</span>' . ($req ? $required_text : '') . '</div>',
                'comment_field' => '<div class="col-sm-12 col-xs-12">
                <div class="form-group customised-formgroup"> <span class="icon-bubble"></span>' .
                    '<textarea id="message-box" class="form-control" placeholder="' . sprintf(esc_attr_x('Comment%s', 'noun', 'cynic'), ($req ? ' *' : '')) . '" name="comment" cols="45" rows="8" aria-required="true">' .
                    '</textarea></div></div>',

                'must_log_in' => '<div class="must-log-in col-sm-12 col-xs-12">' .
                    sprintf(
                        wp_kses_post(__('You must be <a href="%s">logged in</a> to post a comment.', 'cynic')),
                        esc_url(wp_login_url(apply_filters('the_permalink', get_permalink())))
                    ) . '</div>',

                'logged_in_as' => '<div class="logged-in-as col-sm-12 col-xs-12">' .
                    sprintf(
                        wp_kses_post(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'cynic')),
                        esc_url(admin_url('profile.php')),
                        $user_identity,
                        esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink())))
                    ) . '</div>',
                'fields' => $fields,
            );
            ?>

            <div class="customise-form contact-form">
                <?php
                comment_form($args);
                ?>
            </div><!--.row-->

        </div><!-- .comments-area -->
        <?php

    }
}