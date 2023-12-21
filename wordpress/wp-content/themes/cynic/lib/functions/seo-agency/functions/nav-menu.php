<?php
/**
 *  get menu argsuments
 */
function cynic_nav_menu($theme_location)
{

    global $post;
    $cynic_options = cynic_options();

    if ($theme_location == 'primary') {
        $args = array(
            'theme_location' => $theme_location,
            'container' => false,
            'menu_class' => 'navbar-nav d-flex w-100 align-items-center justify-content-between',
            'walker' => new Seo_Agency_Walker_Nav_Menu(),
        );
        return $args;
    } elseif ($theme_location == 'top_menu') {
        $args = array(
            'theme_location' => $theme_location,
            'container' => false,
            'menu_class' => 'navbar-nav ml-auto',
            'walker' => new Seo_Agency_Top_Menu_Walker(),
        );
        return $args;
    } elseif ($theme_location == 'footer_menu') {
        $args = array(
            'theme_location' => $theme_location,
            'container' => 'div',
            'container_class' => 'col-md-8 ml-md-auto',
            'menu_class' => 'navbar-nav navbar-expand-md',
            'walker' => new Seo_Agency_Walker_Nav_Menu(),
        );
        return $args;
    }

}

add_filter('wp_nav_menu_items', 'add_social_media_at_to_menu_nav', 10, 2);
function add_social_media_at_to_menu_nav($items, $args)
{
    if ($args->theme_location == 'top_menu') {
        $cynic_options = cynic_options();
        if (getCynicOptionsVal('header_top_menu_social')) {
            $html = '<li class="nav-social-links d-flex justify-content-end">';
            $html .= getsiteSocialMediaHtml($cynic_options);
            $html .= '</li>';
            $items .= $html;
        }
    }
    return $items;
}


function cynic_top_menu_EnableDisable()
{
    $headerMenu = getCynicOptionsVal('header_menu_layout');
    $theme_mode = getCynicOptionsVal('theme_mode');
    if (strpos($headerMenu, 'menu_with_top_menu') == false || $theme_mode == 1) {
        return false;
    }
    return true;
}




