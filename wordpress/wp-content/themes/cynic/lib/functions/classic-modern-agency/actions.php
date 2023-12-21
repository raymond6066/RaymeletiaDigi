<?php
if(!function_exists('cynic_page_title')){
    function cynic_page_title()
    {
        if (is_home() || is_singular('post')) {
            echo '<h1>';
            esc_html_e("Blog", 'cynic');
            echo '</h1>';
        } elseif (is_singular('case_studies')) {
            echo '<h1>';
            echo esc_html(the_title());
            echo '</h1>';
        } elseif (is_archive() || is_category() || is_tag()) {
            echo '<h1>';
            the_archive_title('', '');
            echo '</h1>';
            the_archive_description('<div class="taxonomy-description">', '</div>');
        } elseif (is_search()) {
            echo '<h1>';
            printf(esc_html__('Search Results For: %s', 'cynic'), get_search_query());
            echo '</h1>';
        } else {
            echo '<h1>';
            single_post_title();
            echo '</h1>';
        }
    }
}

add_action('cynic_breadcrumb', 'cynic_page_subtext', 2);

/**
 * @abstract print breadcrumb
 */
function cynic_page_subtext()
{
    if (is_page()) {
        $headingtext = cynic_get_meta('cynic_page_headingtext');
        if ($headingtext) {
            echo wp_kses_post(apply_filters('the_content', $headingtext));
        }
    }
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
    return isset($post->ID) ? get_post_meta($post->ID, $option_name, $single) : false;
}

/**
 * @abstract comments callback
 */
function cynic_comment_cb($comment, $args = array(), $depth = 1)
{
    if (!isset($args['depth'])) {
        $args['depth'] = $depth;
    }
    $args['reply_text'] = wp_kses(__('<i class="icon-reply"></i> Reply', 'cynic'), array('i' => array(
        'class' => array(),
    )));
    ?>

    <div class="row" id="comment-<?php comment_ID() ?>">
        <?php
        $avatar = get_avatar($comment);
        if ($avatar !== false) { ?>
            <div class="blogger-img"> <?php echo get_avatar($comment, 90, '', '', array('class' => 'img-responsive')); ?></div>
        <?php } ?>
        <div class="blog-description <?php if ($avatar === false) {
            echo esc_attr('comment-full-width');
        } ?>">
            <p class="bloger-name"><?php comment_author(); ?></p>
            <span>
                <?php if (('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) && $args['short_ping']) { ?>
                    <?php comment_author_link($comment); ?>
                <?php } else { ?>
                    <a href="<?php comment_author_url(); ?>"><strong><?php comment_author(); ?></strong></a>
                <?php } ?>&nbsp;&nbsp;
                <?php esc_html_e('Posted on:', 'cynic') ?>
                <span class="post-time"><?php echo get_comment_date() . ' ' . get_comment_time() ?></span>&nbsp;
                <?php comment_reply_link($args) ?>
            </span>
            <p class="regular-text"><?php echo wp_kses_post($comment->comment_content); ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php
}

add_action('admin_init', 'cynic_admin_init', 10000);

function cynic_admin_init()
{
    add_filter('wp_edit_nav_menu_walker', 'Init_Walker_cynic_Nav_Menu_Edit');
    add_action('wp_update_nav_menu_item', array('Walker_cynic_Nav_Menu_Edit', 'save_meta_options'), 10, 3);
}

function Init_Walker_cynic_Nav_Menu_Edit()
{
    return "Walker_cynic_Nav_Menu_Edit";
}

add_filter('navigation_markup_template', 'cynic_navigation_markup_template', 10, 2);

function cynic_navigation_markup_template($template, $class = false)
{
    $template = '<nav class="navigation %1$s">
		<div class="nav-links">%3$s</div>
	</nav>';
    return $template;
}

/* nav menu attributes action */

add_filter('nav_menu_link_attributes', 'cynic_nav_menu_link_attributes', 100, 4);
add_filter('nav_menu_item_title', 'cynic_nav_menu_item_title', 100, 4);
add_filter('nav_menu_css_class', 'cynic_nav_menu_css_class', 100, 4);

function cynic_nav_menu_css_class($classes, $item, $args, $depth)
{
    if (!is_object($args)) {
        $args = (object)$args;
    }
    if ($args->theme_location == 'primary') {
        if (is_array($item->classes) && in_array('menu-item-has-children', $item->classes)) {
            $classes[] = 'dropdown';
        }
    }
    return $classes;
}

function cynic_nav_menu_link_attributes($atts, $item, $args, $depth)
{
    if (!is_object($args)) {
        $args = (object)$args;
    }
    if ($args->theme_location == 'primary') {
        if (!isset($item->attr_title)) {
            $atts['title'] = !empty($item->post_title) ? $item->post_title : '';
            $atts['target'] = '';
            $atts['rel'] = '';
            $atts['href'] = get_permalink($item->ID);
        }
    }

    return $atts;
}

function cynic_nav_menu_item_title($title, $item, $args, $depth)
{
    if (!is_object($args)) {
        $args = (object)$args;
    }
    if ($args->theme_location == 'primary') {
        $icon = get_post_meta((int)$item->ID, '_menu_item_icon', true);
        if (!$title) {
            $title = $item->post_title;
        }
        if ($icon) {
            $title = '<span class="' . $icon . '"></span>' . $title;
        }
    }
    return $title;
}

add_action('wp_footer', 'cynic_footer_modals');

function cynic_footer_modals()
{
    $cynic_options = cynic_options();
    ?>
    <!--portfolio details  modal-->
    <div class="modal fade verticl-center-modal" id="portfolioDetModal" tabindex="-1" role="dialog"
         aria-labelledby="portfolioDetModal">
        <div class="modal-dialog getguoteModal-dialog potfolio-modal" role="document">
            <div class="loading-img"><img src="<?php echo get_template_directory_uri() ?>/images/loading.gif"
                                          alt="loading gif"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="<?php esc_attr_e('Close', 'cynic') ?>"><span class="icon-cross-circle"></span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!--end portfolio details modal-->
    <?php
    if (isset($cynic_options['cynic_feature_modal_button']) && $cynic_options['cynic_feature_modal_button'] && isset($cynic_options['cynic_feature_modal_page']) && $cynic_options['cynic_feature_modal_page']
    ) {
        $args = array(
            'post_type' => 'page',
            'showposts' => 1,
            'page_id' => (int)$cynic_options['cynic_feature_modal_page'],
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <!-- quote modal-->
                <div class="modal fade verticl-center-modal" id="getAQuoteModal" tabindex="-1" role="dialog"
                     aria-labelledby="getAQuoteModal">
                    <div class="modal-dialog getguoteModal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            class="icon-cross-circle"></span></button>
                            </div>
                            <div class="modal-body">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end get a quote modal-->
                <?php
            }
        }
        wp_reset_postdata();
    }
    if (isset($cynic_options['cynic_onepage_privacy_link']) && !empty($cynic_options['cynic_onepage_privacy_link'])) {
        $args = array(
            'post_type' => 'page',
            'showposts' => 1,
            'page_id' => (int)$cynic_options['cynic_onepage_privacy_link'],
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <!-- quote modal-->
                <div class="modal fade verticl-center-modal get-privacy-terms page-link-modal" id="getPrivacyPage"
                     tabindex="-1" role="dialog" aria-labelledby="getPrivacyPage">
                    <div class="modal-dialog getguoteModal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            class="icon-cross-circle"></span></button>
                            </div>
                            <div class="modal-body">
                                <h2 class="b-clor"><?php the_title() ?></h2>
                                <?php
                                the_content();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end get a quote modal-->
                <?php
            }
        }
        wp_reset_postdata();
    }
    if (isset($cynic_options['cynic_onepage_terms_condition_link']) && !empty($cynic_options['cynic_onepage_terms_condition_link'])) {
        $args = array(
            'post_type' => 'page',
            'showposts' => 1,
            'page_id' => (int)$cynic_options['cynic_onepage_terms_condition_link'],
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <!-- quote modal-->
                <div class="modal fade verticl-center-modal get-privacy-terms page-link-modal"
                     id="getTermsConditionsPage" tabindex="-1" role="dialog" aria-labelledby="getTermsConditionsPage">
                    <div class="modal-dialog getguoteModal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            class="icon-cross-circle"></span></button>
                            </div>
                            <div class="modal-body">
                                <h2 class="b-clor"><?php the_title() ?></h2>
                                <?php
                                the_content();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end get a quote modal-->
                <?php
            }
        }
        wp_reset_postdata();
    }
}

add_filter('cynic_featured_mark', 'cynic_featured_mark');

function cynic_featured_mark($url)
{
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_featured_ribbon']['url']) && $cynic_options['cynic_featured_ribbon']['url']) {
        $url = $cynic_options['cynic_featured_ribbon']['url'];
    }
    return $url;
}

/*
 Check if stick header is enable
*/

function cynic_is_active_sticky_header()
{
    $sticky_header = "";
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_sticky_header']) && $cynic_options['cynic_sticky_header'] == 0) {
        $sticky_header = "sticky-header";
    }
    return $sticky_header;
}

/* 
 Add Body class for modern page
*/
add_filter('body_class', 'cynic_custom_class');
function cynic_custom_class($classes)
{
    $cynic_options = cynic_options();
    if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == 1) {
        $classes[] = 'multipage-agency';
    }
    if (isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == 2) {
        $classes[] = 'onepage-agency';
    }
    if (isset($cynic_options['cynic_theme_mode']) && $cynic_options['cynic_theme_mode'] == '1') {
        $classes[] = 'page-template-unit-mode';
    } else {
        if (!is_page() && is_singular() && isset($cynic_options['cynic_layouts']) && $cynic_options['cynic_layouts'] == 1) {
            $classes[] = 'page-template-template-modernpage';
        } elseif (!is_front_page() && is_home()) {
            $classes[] = 'page-template-template-modernpage';
        }

    }
    if (isset($cynic_options['cynic_menu']) && $cynic_options['cynic_menu'] == 1) {
        $classes[] = 'cynic-normal-menu';
    } elseif (isset($cynic_options['cynic_menu']) && $cynic_options['cynic_menu'] == 2) {
        $classes[] = 'cynic-mega-menu';
    } else {
        $classes[] = 'cynic-default-unit-menu';
    }
    return $classes;
}

function cynic_remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'cynic_remove_admin_login_header');


// Remove active class from menu
function cynic_remove_active_class($class)
{
    return ($class == 'active') ? FALSE : TRUE;
}

function cynic_add_class_to_menu_item($sorted_menu_objects, $args)
{
    $theme_location = 'primary';  // Name, ID, or Slug of the target menu location
    $target_menu_title = 'Link';  // Name/Title of the menu item you want to target
    $class_to_add = 'my_own_class';  // Class you want to add
    if ($args->theme_location == $theme_location) {
        foreach ($sorted_menu_objects as $key => $menu_object) {
            if ($menu_object->url != "#") {
                $url = $menu_object->url;
                $explode = explode('/', rtrim($menu_object->url, '/'));
                $slug = end($explode);
                $menu_object->classes[] = "meg-nav-menu-" . strtolower($slug);
            }
        }
    }

    return $sorted_menu_objects;
}

add_filter('wp_nav_menu_objects', 'cynic_add_class_to_menu_item', 10, 2);


// Add active class to menu of post type single template
function cynic_add_class_to_wp_nav_menu($classes)
{
    switch (get_post_type()) {
        case 'case_studies':
            $classes = array_filter($classes, 'cynic_remove_active_class');
            if (in_array('meg-nav-menu-case-studies', $classes)) {
                $classes[] = 'active';
            }
    }
    if (is_404() || is_search()) {
        $classes = array_filter($classes, 'cynic_remove_active_class');
        if (in_array('meg-nav-menu-team-members', $classes)) {
            $classes[] = 'active';
        }
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'cynic_add_class_to_wp_nav_menu');