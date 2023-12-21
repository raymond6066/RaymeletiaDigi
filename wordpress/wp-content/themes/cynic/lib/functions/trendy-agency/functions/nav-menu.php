<?php
/**
 *  get menu argsuments
 */
function cynic_nav_menu($theme_location)
{
    if ($theme_location == 'primary') {
        $args = array(
            'theme_location' => $theme_location,
            'container' => false,
            'menu_class' => 'navbar-nav ml-md-auto typo-color-c align-items-center',
            'walker' => new trendy_Agency_Walker_Nav_Menu(),
        );
        return $args;
    }
}




