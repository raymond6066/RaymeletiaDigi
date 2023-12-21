<?php

function cynic_print_style($array, $index = '', $prop = '', $important = '')
{
    if (isset($array[$index])) {
        print "{$prop}:{$array[$index]}{$important};\n";
    }
}

function cynic_print_weight($array, $index = '', $prop = '', $important = '')
{
    if (isset($array[$index])) {
        print "{$prop}:{$array[$index]}{$important};\n";
    }
}

function cynic_print_font_family($array, $index = '', $prop = '', $important = '', $default = 'sans-serif')
{
    if (isset($array[$index])) {
        $ffname = '"' . $array[$index] . '"';
        print "{$prop}:{$ffname},{$default}{$important};\n";
    }
}

/**
 * @param string $prop
 * @param $index
 * @param string $defaultVal
 * @param string $important
 */
function cynic_printcustomizerstyles($prop = '', $index, $defaultVal = '', $unit = '', $important = 'yes')
{
    $important = ($important == 'yes') ? ' !important' : '';
    $customizerOption = get_theme_mod('cynic_theme');

    if (isset($customizerOption[$index]) &&
        !empty($customizerOption[$index]) &&
        $customizerOption[$index] !== $defaultVal) {
        if (!empty($prop)) {
            return "{$prop}:{$customizerOption[$index]}{$unit}{$important};\n";
        } else {
            return "{$customizerOption[$index]}{$unit}";
        }
    }
}


function debug_customizer($index, $status = true)
{
    $customizerOption = get_theme_mod('cynic_theme');
    if ($status) {
        print_r($customizerOption);
    } else {
        print_r($customizerOption[$index]);
    }

}

/**
 * @param $hex
 * @return RGB
 */
function haxtoRGB($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $string = $r . ',' . $g . ',' . $b;
    return $string;
}

function cynic_get_custom_styles()
{
    ob_start();
    ?>@charset "UTF-8";

    /* -- colors -- dynamic -- */
    <?php
    if (getCynicOptionsVal('body_font')) {
        ?>body{
        <?php cynic_print_font_family(getCynicOptionsVal('body_font'), 'font-family', 'font-family') ?>
        <?php cynic_print_weight(getCynicOptionsVal('body_font'), 'font-weight', 'font-weight') ?>
        }
        <?php
    }
    if (getCynicOptionsVal('p_font')) {
        ?>p{
        <?php cynic_print_font_family(getCynicOptionsVal('p_font'), 'font-family', 'font-family') ?>
        <?php cynic_print_weight(getCynicOptionsVal('p_font'), 'font-weight', 'font-weight') ?>
        <?php cynic_print_style(getCynicOptionsVal('p_font'), 'font-size', 'font-size') ?>
        }
        <?php
    }
    if (getCynicOptionsVal('banner_p_font')) {
        ?>.banner p{
        <?php cynic_print_font_family(getCynicOptionsVal('banner_p_font'), 'font-family', 'font-family') ?>
        <?php cynic_print_weight(getCynicOptionsVal('banner_p_font'), 'font-weight', 'font-weight') ?>
        <?php cynic_print_style(getCynicOptionsVal('banner_p_font'), 'font-size', 'font-size') ?>
        }
        <?php
    }

    if (getCynicOptionsVal('headings_font')) {
        ?>h1, h2, h3, h4, h5, h6 {
        <?php cynic_print_font_family(getCynicOptionsVal('headings_font'), 'font-family', 'font-family', '', 'serif') ?>
        }
        <?php
    }
    if (getCynicOptionsVal('menu_font')) {
        ?>.navbar .nav-item .nav-link{
        <?php cynic_print_font_family(getCynicOptionsVal('menu_font'), 'font-family', 'font-family') ?>
        <?php cynic_print_style(getCynicOptionsVal('menu_font'), 'font-size', 'font-size') ?>
        }

        .page-footer .footer-mid .footer-mid-nav .nav-item:first-child{
        <?php cynic_print_font_family(getCynicOptionsVal('menu_font'), 'font-family', 'font-family') ?>
        }
        <?php
    }

    if (getCynicOptionsVal('top_menu_font')) {
        ?>.fullscreen-menu .navbar .navbar-nav .nav-item .nav-link{
        <?php cynic_print_font_family(getCynicOptionsVal('top_menu_font'), 'font-family', 'font-family', '', 'serif') ?>
        <?php cynic_print_style(getCynicOptionsVal('top_menu_font'), 'font-size', 'font-size') ?>
        }
        <?php
    }
    ?>

    <?php
    /***    Header Color **/
    ?>
    <?php
    $header_brand_logo_max_width = cynic_printcustomizerstyles('', 'header_brand_logo_max_width', '210', 'px');
    if ($header_brand_logo_max_width) {
        ?>
        .header-wrapper .header-top .navbar-brand img{
        max-width:<?php echo esc_attr($header_brand_logo_max_width) ?>;
        }
        <?php
    }


    $headerBackgroup = cynic_printcustomizerstyles('', 'header_background_color', '#ffffff');
    if ($headerBackgroup) {
        ?>.header-wrapper {background-color:<?php echo esc_attr($headerBackgroup) ?>;}
        .header-wrapper .header-top{border-color:<?php echo esc_attr($headerBackgroup); ?>}
        <?php
    }
    ?>

    <?php
    $headerContactNoTextColor = cynic_printcustomizerstyles('', 'header_phone_text_color', '#333333');
    if ($headerContactNoTextColor) {
        ?>.header-wrapper .header-top .contact-numb {color:<?php echo esc_attr($headerContactNoTextColor); ?>;}
        <?php
    }
    ?>

    <?php
    $headerContactNoTextHoverColor = cynic_printcustomizerstyles('', 'header_phone_hover_text_color', '#333333');
    if ($headerContactNoTextHoverColor) {
        ?>.header-wrapper .header-top .contact-numb:hover {color:<?php echo esc_attr($headerContactNoTextHoverColor); ?>;}
        <?php
    }
    ?>


    <?php
    /***    Fill Button **/
    ?>
    <?php
    $btnBorderRadious = cynic_printcustomizerstyles('', 'button_border_radius', '50', 'px');
    $fill_button_text_color = cynic_printcustomizerstyles('', 'fill_button_text_color', '#ffffff');
    $fill_button_bg_color_left = cynic_printcustomizerstyles('', 'fill_button_bg_color_left', '#4fbf53');
    $fill_button_bg_color_right = cynic_printcustomizerstyles('', 'fill_button_bg_color_right', '#9dcf56');
    $fill_button_border_color = cynic_printcustomizerstyles('', 'fill_button_border_color', '#ffffff');

    if ($btnBorderRadious || $fill_button_text_color
        || $fill_button_bg_color_left || $fill_button_bg_color_right
        || $fill_button_border_color) {

        $fill_button_bg_color_left = ($fill_button_bg_color_left) ? $fill_button_bg_color_left : '#4fbf53';
        $fill_button_bg_color_right = ($fill_button_bg_color_right) ? $fill_button_bg_color_right : '#9dcf56';
        ?>.primary-btn, .floating-footer-form .form-heading .primary-btn, .secondary-btn, .floating-footer-form .form-heading .secondary-btn{
        <?php
        if ($btnBorderRadious) {
            ?>    border-radius:<?php echo esc_attr($btnBorderRadious) ?>;
            <?php
        }
        ?>
        }
        .primary-btn, .floating-footer-form .form-heading .primary-btn{
        <?php
        if ($fill_button_text_color) {
            ?>color:<?php echo esc_attr($fill_button_text_color) ?>;
            <?php
        }
        ?>background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($fill_button_bg_color_left) ?>), to(<?php echo esc_attr($fill_button_bg_color_right) ?>));
        background-image: -webkit-linear-gradient(left, <?php echo esc_attr($fill_button_bg_color_left) ?>, <?php echo esc_attr($fill_button_bg_color_right) ?>);
        background-image: linear-gradient(to right, <?php echo esc_attr($fill_button_bg_color_left) ?>, <?php echo esc_attr($fill_button_bg_color_right) ?>);
        <?php
        if ($fill_button_border_color) {
            ?>border: 1px solid <?php echo esc_attr($fill_button_border_color) ?>;
            <?php
        }
        ?>}

        <?php
    }
    ?>

    <?php
    $fill_button_hover_text_color = cynic_printcustomizerstyles('', 'fill_button_hover_text_color', '#ffffff');
    $fill_button_border_hvr_color = cynic_printcustomizerstyles('', 'fill_button_border_hvr_color', '#ffffff');
    $fill_button_box_shadow_hvr_color = cynic_printcustomizerstyles('', 'fill_button_box_shadow_hvr_color', '#000000');

    $fill_button_hvr_bg_color_left = cynic_printcustomizerstyles('', 'fill_button_hvr_bg_color_left', '#4fbf53');
    $fill_button_hvr_bg_color_right = cynic_printcustomizerstyles('', 'fill_button_hvr_bg_color_right', '#9dcf56');

    if ($fill_button_hover_text_color || $fill_button_border_hvr_color
        || $fill_button_box_shadow_hvr_color ||
        $fill_button_hvr_bg_color_left || $fill_button_hvr_bg_color_right) {
        $fill_button_hvr_bg_color_left = ($fill_button_hvr_bg_color_left) ? $fill_button_hvr_bg_color_left : '#4fbf53';
        $fill_button_hvr_bg_color_right = ($fill_button_hvr_bg_color_right) ? $fill_button_hvr_bg_color_right : '#9dcf56';
        ?>     .primary-btn:hover, .floating-footer-form .form-heading .primary-btn:hover, .rev_slider .primary-btn:hover {
        <?php
        if ($fill_button_hover_text_color) {
            ?>    color:<?php echo esc_attr($fill_button_hover_text_color) ?>;
            <?php
        }
        if ($fill_button_border_hvr_color) {
            ?>border-color:<?php echo esc_attr($fill_button_border_hvr_color) ?>;
            <?php
        }

        if ($fill_button_box_shadow_hvr_color) {
            ?>box-shadow:0 2px 2px rgba(<?php echo esc_attr(haxtoRGB($fill_button_box_shadow_hvr_color)) ?>, 0.2);
            <?php
        }
        ?>background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($fill_button_hvr_bg_color_left) ?>), to(<?php echo esc_attr($fill_button_hvr_bg_color_right) ?>));
        background-image: -webkit-linear-gradient(left, <?php echo esc_attr($fill_button_hvr_bg_color_left) ?>, <?php echo esc_attr($fill_button_hvr_bg_color_right) ?>);
        background-image: linear-gradient(to right, <?php echo esc_attr($fill_button_hvr_bg_color_left) ?>, <?php echo esc_attr($fill_button_hvr_bg_color_right) ?>);
        <?php
        ?>}
        <?php
    }
    ?>


    <?php //No Fill Button Color

    $no_fill_button_text_color = cynic_printcustomizerstyles('', 'no_fill_button_text_color', '#ffffff');
    $no_fill_button_border_color = cynic_printcustomizerstyles('', 'no_fill_button_border_color', '#4fbf53');


    if ($no_fill_button_text_color || $no_fill_button_border_color) {

        ?>   .secondary-btn, .team-gridder .gridder .gridder-list .inner-content .overlay .secondary-btn {
        <?php
        if ($no_fill_button_text_color) {
            ?>    color:<?php echo esc_attr($no_fill_button_text_color) ?>;
            <?php
        }
        if ($no_fill_button_border_color) {
            ?>border-color:<?php echo esc_attr($no_fill_button_border_color) ?>;
            <?php
        }
        ?>}
        <?php
    }
    ?>

    <?php
    $no_fill_button_hover_text_color = cynic_printcustomizerstyles('', 'no_fill_button_hover_text_color', '#ffffff');
    $no_fill_button_border_hvr_color = cynic_printcustomizerstyles('', 'no_fill_button_border_hvr_color', '#4fbf53');
    $no_fill_button_box_shadow_hvr_color = cynic_printcustomizerstyles('', 'no_fill_button_box_shadow_hvr_color', '#000000');
    $no_fill_button_hvr_bg_color_left = cynic_printcustomizerstyles('', 'no_fill_button_hvr_bg_color_left', '#4fbf53');
    $no_fill_button_hvr_bg_color_right = cynic_printcustomizerstyles('', 'no_fill_button_hvr_bg_color_right', '#9dcf56');

    if ($no_fill_button_hover_text_color || $no_fill_button_border_hvr_color
        || $no_fill_button_box_shadow_hvr_color || $no_fill_button_hvr_bg_color_left || $no_fill_button_hvr_bg_color_right) {
        $no_fill_button_hvr_bg_color_left = ($no_fill_button_hvr_bg_color_left) ? $no_fill_button_hvr_bg_color_left : '#4fbf53';
        $no_fill_button_hvr_bg_color_right = ($no_fill_button_hvr_bg_color_right) ? $no_fill_button_hvr_bg_color_right : '#9dcf56';
        ?>   .secondary-btn:hover, .pricing-plan .pricing-container .pricing-table.featured .secondary-btn:hover,
        .pricing-plan .pricing-container .pricing-table.featured .secondary-btn,
        .team-gridder .gridder .gridder-list .inner-content .overlay .secondary-btn:hover{
        <?php
        if ($no_fill_button_hover_text_color) {
            ?>    color:<?php echo esc_attr($no_fill_button_hover_text_color) ?>;
            <?php
        }
        if ($no_fill_button_border_hvr_color) {
            ?>border-color:<?php echo esc_attr($no_fill_button_border_hvr_color) ?>;
            <?php
        }

        if ($no_fill_button_box_shadow_hvr_color) {
            ?>box-shadow: 0 2px 2px rgba(<?php echo esc_attr(haxtoRGB($no_fill_button_box_shadow_hvr_color)); ?>, 0.2);
            <?php
        }

        ?>background-color:<?php echo esc_attr($no_fill_button_hvr_bg_color_left) ?>;
        background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($no_fill_button_hvr_bg_color_left) ?>), to(<?php echo esc_attr($no_fill_button_hvr_bg_color_right) ?>));
        background-image: -webkit-linear-gradient(left, <?php echo esc_attr($no_fill_button_hvr_bg_color_left) ?>, <?php echo esc_attr($no_fill_button_hvr_bg_color_right) ?>);
        background-image: linear-gradient(to right, <?php echo esc_attr($no_fill_button_hvr_bg_color_left) ?>, <?php echo esc_attr($no_fill_button_hvr_bg_color_right) ?>);
        <?php
        ?>
        }
        <?php
    }

    ?>


    <?php //Footer Color
    $footer_brand_logo_max_width = cynic_printcustomizerstyles('', 'footer_brand_logo_max_width', '100%', '%', '');
    if ($footer_brand_logo_max_width) {
        ?>
        img.footer-brand-logo {max-width:<?php echo esc_attr($footer_brand_logo_max_width); ?>}
        <?php
    }


    $footer_background_color = cynic_printcustomizerstyles('', 'footer_background_color', '#2b2a2e', '', 'no');
    if ($footer_background_color) {
        ?>
        .page-footer{ background-color: <?php echo esc_attr($footer_background_color) ?>;}
        <?php
    }

    $footer_widget_title_color = cynic_printcustomizerstyles('', 'footer_widget_title_color', '#ffffff', '', 'no');
    if ($footer_widget_title_color) {
        ?>
        .page-footer .footer-mid .footer-mid-nav .nav-item:first-child,
        .page-footer .footer-bottom p,
        .page-footer .footer-top .navbar-nav .nav-item .nav-link
        { color: <?php echo esc_attr($footer_widget_title_color) ?>;}
        <?php
    }


// Footer Color Settings
    $footer_link_text_color = cynic_printcustomizerstyles('', 'footer_link_text_color', '#8c8c8c', '', 'no');
    if ($footer_link_text_color) {
        ?>
        footer ul li,
        footer ul li a,
        .footer-newsletter form .form-group .form-text,
        .page-footer .footer-bottom .footer-bottom-links a
        { color: <?php echo esc_attr($footer_link_text_color) ?>;}
        .footer-newsletter form .form-group .form-control::placeholder {color: <?php echo esc_attr($footer_link_text_color) ?>;}
        .footer-newsletter form .form-group .form-control:-ms-input-placeholder{color: <?php echo esc_attr($footer_link_text_color) ?>;}
        .footer-newsletter form .form-group .form-control::-ms-input-placeholder{color: <?php echo esc_attr($footer_link_text_color) ?>;}
        <?php
    }

    $footer_link_text_hover_color = cynic_printcustomizerstyles('', 'footer_link_text_hover_color', '#4fbf53', '', 'no');
    if ($footer_link_text_hover_color) {
        ?>
        footer ul li a:hover,
        .page-footer .footer-bottom .footer-bottom-links a:hover,
        .page-footer .footer-top .navbar-nav .nav-item .nav-link:hover, .page-footer .footer-top .navbar-nav .nav-item.active .nav-link
        { color: <?php echo esc_attr($footer_link_text_hover_color) ?>;}
        <?php
    }

    $footer_email_field_line_color = cynic_printcustomizerstyles('', 'footer_email_field_line_color', '#413f48', '', 'no');
    if ($footer_email_field_line_color) {
        ?>
        .footer-newsletter form .form-group .form-control { border-bottom: 2px solid <?php echo esc_attr($footer_email_field_line_color) ?>;}
        .footer-newsletter form .form-group button svg .cls-1 {fill:<?php echo esc_attr($footer_email_field_line_color) ?>;}
        <?php
    }


    $footer_email_field_active_color = cynic_printcustomizerstyles('', 'footer_email_field_active_color', '#4fbf53', '', 'no');
    if ($footer_email_field_active_color) {
        ?>
        .footer-newsletter form .form-group .form-control:focus { border-color: <?php echo esc_attr($footer_email_field_active_color) ?>;}
        .footer-newsletter form .form-group button:hover svg .cls-1 {fill:<?php echo esc_attr($footer_email_field_active_color) ?>;}
        <?php
    }


    $footer_go_to_top_scroll_icon_color = cynic_printcustomizerstyles('', 'footer_go_to_top_scroll_icon_color', '#ffffff', '', 'no');
    $footer_go_to_top_scroll_bg_color = cynic_printcustomizerstyles('', 'footer_go_to_top_scroll_bg_color', '#4fbf53', '', 'no');
    if ($footer_go_to_top_scroll_icon_color || $footer_go_to_top_scroll_bg_color) {
        ?>
        .go-to-top,.slick-dots li.slick-active {
        <?php
        if ($footer_go_to_top_scroll_icon_color) {
            ?>color:<?php echo esc_attr($footer_go_to_top_scroll_icon_color) ?>;
            <?php
        }
        if ($footer_go_to_top_scroll_bg_color) {
            ?>background-color:<?php echo esc_attr($footer_go_to_top_scroll_bg_color) ?>;
            <?php
        }
        ?>

        }
        <?php
    }

    $footer_horizonal_line_color = cynic_printcustomizerstyles('', 'footer_horizonal_line_color', '#413f48');
    if ($footer_horizonal_line_color) {
        ?>
        .page-footer .footer-top,
        .page-footer .footer-mid
        {
        border-color: <?php echo esc_attr($footer_horizonal_line_color) ?>;
        }
        <?php
    }


    ## if Classic Menu is enable :
    if (cynic_top_menu_EnableDisable()) {
        ## Top Menu

        $header_top_menu_parent_item_color = cynic_printcustomizerstyles('', 'header_top_menu_parent_item_color', '#333333', '', 'no');
        if ($header_top_menu_parent_item_color) {
            ?>
            .fullscreen-menu .navbar .navbar-nav .nav-item .nav-link
            {
            color: <?php echo esc_attr($header_top_menu_parent_item_color) ?>;
            }
        <?php }

        $header_top_menu_parent_item_text_hover_color = cynic_printcustomizerstyles('', 'header_top_menu_parent_item_text_hover_color', '#4fbf53', '', 'no');
        if ($header_top_menu_parent_item_text_hover_color) {
            ?>
            .fullscreen-menu .navbar .navbar-nav .nav-item .nav-link.active,
            .fullscreen-menu .navbar .navbar-nav .nav-item .nav-link:hover
            {
            color: <?php echo esc_attr($header_top_menu_parent_item_text_hover_color) ?>;
            }
        <?php }

        $header_top_menu_parent_item_font_size = cynic_printcustomizerstyles('', 'header_top_menu_parent_item_font_size', '38', '', 'no');
        if ($header_top_menu_parent_item_font_size) {
            ?>
            .fullscreen-menu .navbar .navbar-nav .nav-item .nav-link
            {
            font-size: <?php echo esc_attr($header_top_menu_parent_item_font_size) ?>px;
            }
        <?php }
// Top Sub Menu
        $header_top_menu_child_item_color = cynic_printcustomizerstyles('', 'header_top_menu_child_item_color', '#212529', '', 'no');
        if ($header_top_menu_child_item_color) {
            ?>
            .fullscreen-menu .dropdown-item
            {
            color: <?php echo esc_attr($header_top_menu_child_item_color) ?>;
            }
        <?php }

        $header_top_menu_child_item_text_hover_color = cynic_printcustomizerstyles('', 'header_top_menu_child_item_text_hover_color', '#4fbf53', '', 'no');
        if ($header_top_menu_child_item_text_hover_color) {
            ?>
            .fullscreen-menu .navbar .navbar-nav .nav-item.current-menu-ancestor > a,
            .fullscreen-menu .navbar .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover,
            .fullscreen-menu .navbar .navbar-nav .nav-item .dropdown-menu .dropdown-item.active
            {
            color: <?php echo esc_attr($header_top_menu_child_item_text_hover_color) ?>;
            }
        <?php }

        $header_top_menu_child_item_font_size = cynic_printcustomizerstyles('', 'header_top_menu_child_item_font_size', '24', '', 'no');
        if ($header_top_menu_child_item_font_size) {
            ?>
            .fullscreen-menu .navbar .navbar-nav .nav-item .dropdown-menu .dropdown-item
            {
            font-size: <?php echo esc_attr($header_top_menu_child_item_font_size) ?>px;
            }
        <?php }
        $header_top_menu_close_icon_color = cynic_printcustomizerstyles('', 'header_top_menu_close_icon_color', '#979797', '', 'no');
        if ($header_top_menu_close_icon_color) {
            ?>
            .fullscreen-menu .navbar .close-menu i

            {
            color: <?php echo esc_attr($header_top_menu_close_icon_color) ?>;
            }
        <?php }
        $header_top_menu_close_icon_hover_color = cynic_printcustomizerstyles('', 'header_top_menu_close_icon_hover_color', '#979797', '', 'no');
        if ($header_top_menu_close_icon_hover_color) {
            ?>
            .fullscreen-menu .navbar .close-menu:hover i

            {
            color: <?php echo esc_attr($header_top_menu_close_icon_hover_color) ?>;
            }
        <?php }
        $header_top_menu_right_border_color = cynic_printcustomizerstyles('', 'header_top_menu_right_border_color', '#eeeeee', '', 'no');
        if ($header_top_menu_right_border_color) {
            ?>
            .fullscreen-menu .navbar .navbar-nav::-webkit-scrollbar-thumb
            {
            background-color: <?php echo esc_attr($header_top_menu_right_border_color) ?>;
            }
        <?php }
        $header_top_menu_right_scroller_bar_color = cynic_printcustomizerstyles('', 'header_top_menu_right_scroller_bar_color', '#fafafa', '', 'no');
        if ($header_top_menu_right_scroller_bar_color) {
            ?>
            .fullscreen-menu .navbar .navbar-nav::-webkit-scrollbar-track
            {
            background-color: <?php echo esc_attr($header_top_menu_right_scroller_bar_color) ?>;
            }
        <?php }




        ############## Classic Menu ##############

        // Menu Text Color
        $header_classic_menu_parent_item_color = cynic_printcustomizerstyles('', 'header_classic_menu_parent_item_color', '#333333', '', 'no');
        if ($header_classic_menu_parent_item_color) {
            ?>
            .navbar .navbar-nav > .nav-item > .nav-link,
            .accordion-container .card .card-header h4 a:not(.collapsed){
            color:<?php echo esc_attr($header_classic_menu_parent_item_color) ?>;
            }
        <?php }

        // Menu Text Hover Color and Menu Item Active Background Hover Color
        $header_classic_menu_parent_item_bg_hover_color = cynic_printcustomizerstyles('', 'header_classic_menu_parent_item_bg_hover_color', '', '', 'no');
        $header_classic_menu_parent_item_text_hover_color = cynic_printcustomizerstyles('', 'header_classic_menu_parent_item_text_hover_color', '#4fbf53', '', 'no');
        if ($header_classic_menu_parent_item_bg_hover_color || $header_classic_menu_parent_item_text_hover_color) {
            ?>

            .navbar .navbar-nav > .nav-item > .nav-link:hover {
            <?php if ($header_classic_menu_parent_item_bg_hover_color) { ?>
                background:<?php echo esc_attr($header_classic_menu_parent_item_bg_hover_color); ?>;
            <?php } ?>
            <?php if ($header_classic_menu_parent_item_text_hover_color) { ?>
                color:<?php echo esc_attr($header_classic_menu_parent_item_text_hover_color); ?>
            <?php } ?>
            }
        <?php }

        // Menu Active Hover Upper Line color
        $header_classic_menu_parent_item_line_hover_color = cynic_printcustomizerstyles('', 'header_classic_menu_parent_item_line_hover_color', '#4fbf53', '', 'no');
        if ($header_classic_menu_parent_item_line_hover_color) {
            ?>
            .header-wrapper .navbar .nav-item .nav-link::before {
            background:<?php echo esc_attr($header_classic_menu_parent_item_line_hover_color); ?>;
            }

            <?php
        }

        // Menu Background Left and right
        $header_classic_menu_background_color_left = cynic_printcustomizerstyles('', 'header_classic_menu_background_color_left', '');
        $header_classic_menu_background_color_right = cynic_printcustomizerstyles('', 'header_classic_menu_background_color_right', '');

        if ($header_classic_menu_background_color_left || $header_classic_menu_background_color_right) {
            $header_classic_menu_background_color_left = ($header_classic_menu_background_color_left) ? $header_classic_menu_background_color_left : '#ffffff';
            $header_classic_menu_background_color_right = ($header_classic_menu_background_color_right) ? $header_classic_menu_background_color_right : '#ffffff';

            ?>
            .cynic-classic-menu, .accordion-container .card .card-header h4 a:not(.collapsed){
            background-color:<?php echo esc_attr($header_classic_menu_background_color_left) ?>;
            background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($header_classic_menu_background_color_left) ?>), to(<?php echo esc_attr($header_classic_menu_background_color_right) ?>));
            background-image: -webkit-linear-gradient(left, <?php echo esc_attr($header_classic_menu_background_color_left) ?>, <?php echo esc_attr($header_classic_menu_background_color_right) ?>);
            background-image: linear-gradient(to right, <?php echo esc_attr($header_classic_menu_background_color_left) ?>, <?php echo esc_attr($header_classic_menu_background_color_right) ?>);
            }
            <?php
        }

        $header_classic_menu_sub_item_color = cynic_printcustomizerstyles('', 'header_classic_menu_sub_item_color', '#333333', '', 'no');
        $header_classic_menu_sub_item_bg_color = cynic_printcustomizerstyles('', 'header_classic_menu_sub_item_bg_color', '', '', 'no');
        if ($header_classic_menu_sub_item_color || $header_classic_menu_sub_item_bg_color) {
            ?>
            .cynic-classic-menu.navbar .nav-item .sub-menu .nav-link
            {
            <?php
            if ($header_classic_menu_sub_item_color) {
                ?>
                color:<?php echo esc_attr($header_classic_menu_sub_item_color); ?>;
                <?php
            }
            if ($header_classic_menu_sub_item_bg_color) {
                ?>
                background-color:<?php echo esc_attr($header_classic_menu_sub_item_bg_color); ?>;
                <?php
            }
            ?>
            }
        <?php }

        $header_classic_menu_sub_item_border_color = cynic_printcustomizerstyles('', 'header_classic_menu_sub_item_border_color', '#f6f6f6', '', 'no');
        if ($header_classic_menu_sub_item_border_color) {
            ?>
            .cynic-classic-menu .navbar-nav .nav-item .nav-item .nav-link{
            border-color:<?php echo esc_attr($header_classic_menu_sub_item_border_color) ?>;
            }
            <?php
        }


        $header_classic_menu_child_item_hover_color = cynic_printcustomizerstyles('', 'header_classic_menu_child_item_hover_color', '#4fbf53', '', 'no');
        $header_classic_menu_child_item_hover_bg_color = cynic_printcustomizerstyles('', 'header_classic_menu_child_item_hover_bg_color', '', '', 'no');
        if ($header_classic_menu_child_item_hover_color || $header_classic_menu_child_item_hover_bg_color) {
            ?>
            .navbar.cynic-classic-menu .nav-item .sub-menu li a:hover,
            .navbar.cynic-classic-menu .nav-item .sub-menu .nav-item.active>.nav-link{
            <?php if ($header_classic_menu_child_item_hover_color) {
                ?>
                color:<?php echo esc_attr($header_classic_menu_child_item_hover_color); ?>;
                <?php
            }
            if ($header_classic_menu_child_item_hover_bg_color) {
                ?>
                background-color:<?php echo esc_attr($header_classic_menu_child_item_hover_bg_color); ?>;
                <?php
            }
            ?>
            }
        <?php }



    } else {
    ## if modern menu is enable:
    ## Modern Menu Color :
    $header_main_menu_background_color_left = cynic_printcustomizerstyles('', 'header_main_menu_background_color_left', '#5c81fa');
    $header_main_menu_background_color_right = cynic_printcustomizerstyles('', 'header_main_menu_background_color_right', '#39a8fe');

    if ($header_main_menu_background_color_left || $header_main_menu_background_color_right) {
        $header_main_menu_background_color_left = ($header_main_menu_background_color_left) ? $header_main_menu_background_color_left : '#5c81fa';
        $header_main_menu_background_color_right = ($header_main_menu_background_color_right) ? $header_main_menu_background_color_right : '#39a8fe';

        ?>
        .cynic-no-nav-top-menu, .accordion-container .card .card-header h4 a:not(.collapsed){
        background-color:<?php echo esc_attr($header_main_menu_background_color_left) ?>;
        background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($header_main_menu_background_color_left) ?>), to(<?php echo esc_attr($header_main_menu_background_color_right) ?>));
        background-image: -webkit-linear-gradient(left, <?php echo esc_attr($header_main_menu_background_color_left) ?>, <?php echo esc_attr($header_main_menu_background_color_right) ?>);
        background-image: linear-gradient(to right, <?php echo esc_attr($header_main_menu_background_color_left) ?>, <?php echo esc_attr($header_main_menu_background_color_right) ?>);
        }
        <?php
    }
    ?>
    <?php
    $header_main_menu_parent_item_color = cynic_printcustomizerstyles('', 'header_main_menu_parent_item_color', '#ffffff', '', 'no');
    if ($header_main_menu_parent_item_color) {
        ?>
        .cynic-no-nav-top-menu .nav-item .nav-link,
        .accordion-container .card .card-header h4 a:not(.collapsed){
        color:<?php echo esc_attr($header_main_menu_parent_item_color) ?>;
        }
    <?php } ?>
    <?php
    if ($header_main_menu_parent_item_color) {
        ?>
        .cynic-no-nav-top-menu .menu-item-has-children::before {
        color:<?php echo esc_attr($header_main_menu_parent_item_color) ?>;
        }
        <?php
    }

    $header_main_menu_parent_item_bg_hover_color = cynic_printcustomizerstyles('', 'header_main_menu_parent_item_bg_hover_color', '#5c81fa', '', 'no');
    $header_main_menu_parent_item_text_hover_color = cynic_printcustomizerstyles('', 'header_main_menu_parent_item_text_hover_color', '#ffffff', '', 'no');
    if ($header_main_menu_parent_item_bg_hover_color || $header_main_menu_parent_item_text_hover_color) {
        ?>

        .navbar.cynic-no-nav-top-menu .navbar-nav > .nav-item > .nav-link:hover {
        <?php if ($header_main_menu_parent_item_bg_hover_color) { ?>
            background:<?php echo esc_attr($header_main_menu_parent_item_bg_hover_color); ?>;
        <?php } ?>
        <?php if ($header_main_menu_parent_item_text_hover_color) { ?>
            color:<?php echo esc_attr($header_main_menu_parent_item_text_hover_color); ?>
        <?php } ?>
        }
    <?php } ?>


    <?php

    if ($header_main_menu_parent_item_text_hover_color || $header_main_menu_parent_item_bg_hover_color) {
        ?>
        .navbar.cynic-no-nav-top-menu .navbar-nav > .nav-item.active > .nav-link,
        .header-wrapper .navbar .current-menu-ancestor > .nav-link
        {
        <?php
        if ($header_main_menu_parent_item_text_hover_color) {
            ?>
            color:<?php echo esc_attr($header_main_menu_parent_item_text_hover_color) ?>;
            <?php
        }
        if ($header_main_menu_parent_item_bg_hover_color) {
            ?>
            background:<?php echo esc_attr($header_main_menu_parent_item_bg_hover_color) ?>;
            <?php
        }
        ?>
        }
        <?php
    }
    ?>

    <?php
    $header_main_menu_parent_item_line_hover_color = cynic_printcustomizerstyles('', 'header_main_menu_parent_item_line_hover_color', '#ffffff', '', 'no');
    if ($header_main_menu_parent_item_line_hover_color) {
        ?>
        .header-wrapper .cynic-no-nav-top-menu .nav-item .nav-link::before { background:<?php echo esc_attr($header_main_menu_parent_item_line_hover_color); ?>; }
        @media screen and (max-width: 991px) {
        .header-wrapper .navbar .nav-item .nav-link {
        border-color: <?php echo esc_attr($header_main_menu_parent_item_line_hover_color); ?>;
        }
        }
        <?php
    }


    $header_main_menu_sub_item_color = cynic_printcustomizerstyles('', 'header_main_menu_sub_item_color', '#555555', '', 'no');
    $header_main_menu_sub_item_bg_color = cynic_printcustomizerstyles('', 'header_main_menu_sub_item_bg_color', '#ffffff', '', 'no');
    if ($header_main_menu_sub_item_color || $header_main_menu_sub_item_bg_color) {
        ?>
        .cynic-no-nav-top-menu .nav-item .sub-menu li a{
        <?php
        if ($header_main_menu_sub_item_color) {
            ?>
            color:<?php echo esc_attr($header_main_menu_sub_item_color); ?>;
            <?php
        }
        if ($header_main_menu_sub_item_bg_color) {
            ?>
            background-color:<?php echo esc_attr($header_main_menu_sub_item_bg_color); ?>;
            <?php
        }
        ?>
        }
    <?php } ?>

    <?php
    $header_main_menu_sub_item_border_color = cynic_printcustomizerstyles('', 'header_main_menu_sub_item_border_color', '#f6f6f6', '', 'no');
    if ($header_main_menu_sub_item_border_color) {
        ?>
        .navbar-nav .nav-item .nav-item .nav-link{border-top: 1px solid <?php echo esc_attr($header_main_menu_sub_item_border_color) ?>; }
        <?php
    }
    ?>


    <?php
    $header_main_menu_child_item_hover_color = cynic_printcustomizerstyles('', 'header_main_menu_child_item_hover_color', '#4fbf53', '', 'no');
    $header_main_menu_child_item_hover_bg_color = cynic_printcustomizerstyles('', 'header_main_menu_child_item_hover_bg_color', '#ffffff', '', 'no');
    if ($header_main_menu_child_item_hover_color || $header_main_menu_child_item_hover_bg_color) {
        ?>
        .navbar.cynic-no-nav-top-menu .nav-item .sub-menu li a:hover, .navbar.cynic-no-nav-top-menu .nav-item .sub-menu .nav-item.active>.nav-link{
        <?php if ($header_main_menu_child_item_hover_color) {
            ?>
            color:<?php echo esc_attr($header_main_menu_child_item_hover_color); ?>;
            <?php
        }
        if ($header_main_menu_child_item_hover_bg_color) {
            ?>
            background-color:<?php echo esc_attr($header_main_menu_child_item_hover_bg_color); ?>;
            <?php
        }
        ?>
        }
    <?php }

}
## Menu END
    ?>


    <?php
//    General Color
    ?>

    <?php

    $body_background_image = cynic_printcustomizerstyles('', 'body_background_image', CYNIC_THEME_URI . '/images/mainbg-bottom.png', '', 'no');
    $body_background_color = cynic_printcustomizerstyles('', 'body_background_color', '#ffffff', '', 'no');
    if ($body_background_image || $body_background_color) {
        ?>
        body>.main {
        <?php
        if($body_background_image){
            ?>
            background-image:url(<?php echo esc_url($body_background_image); ?>);
            <?php
        }
        if($body_background_color){
            ?>
            background-color:<?php echo esc_attr($body_background_color) ?>;
            <?php
        }
        ?>
        }
    <?php }

    $section_heading_color = cynic_printcustomizerstyles('', 'section_heading_color', '#333333', '', 'no');
    if ($section_heading_color) {
        ?>
        h1, h2, h3, h4, h5, h1 a, h2 a, h3 a, h4 a, h5 a,
        .section h6, .section h6 a,
        h1 strong,h2 strong, h3 strong,h4 strong,h5 strong,h6 strong,
        .awards-achieved .row div[class^="col-"] .content h3,
        .components .tab-container.type-1 .tab-content .tab-pane .text-content .content h4,
        article.blog-item .article-head .post-title h2 a,
        .work-sample .section-heading h2 strong,
        .post-tags,.blog-details .post-nav .nav-social-links .share-label,
        .comment-author cite, .comment-author cite a,
        .form-content .form-heading h3,
        .form-content .form-container form .address address p,
        p-404-error .fullscreen-banner.banner-404 h1
        {
        color:<?php echo esc_attr($section_heading_color); ?>;
        }
        .p-under-construction .fullscreen-banner h1 span {
            color: <?php echo esc_attr($section_heading_color); ?>;
            -webkit-text-fill-color: <?php echo esc_attr($section_heading_color); ?>;
        }
    <?php }

    // Normal Anchor Text Color
    $link_text_color = cynic_printcustomizerstyles('', 'link_text_color', '#333333', '', 'no');
    if ($link_text_color) {
        ?>
        a, .comment-text a, .logged-in-as a {
        color:<?php echo esc_attr($link_text_color); ?>;
        }
    <?php }

    // Nornal Anchor Hover Color
    $link_hover_text_color = cynic_printcustomizerstyles('', 'link_hover_text_color', '#4fbf53', '', 'no');
    if ($link_hover_text_color) {
        ?>
        a:hover, .box-with-img:hover .text-content h3 a,
        article.blog-item .article-head .post-title h2 a:hover,
        article.blog-item .article-head .post-title h2 a:hover,
        .blog .blog-content-wrapper .row [class^="col-"] .blog-content:hover h3 a,
        article.blog-item .article-head .post-date span,
        .comment-text a:hover, .logged-in-as a:hover,
        .widget ul li a:hover, .tagcloud a:hover, .post-tags a:hover,
        .comment-author cite a:hover, .comment-author .comment-meta a:hover,
        h4 a:hover, .form-content .form-heading .ff-close-btn:hover
        {
        color:<?php echo esc_attr($link_hover_text_color); ?>;
        }
        .tagcloud a:hover, .post-tags a:hover, .form-content .form-heading .ff-close-btn:hover{
        border-color:<?php echo esc_attr($link_hover_text_color); ?>;
        }
    <?php }

// Read More Text Color
    $read_more_link_text_color = cynic_printcustomizerstyles('', 'read_more_link_text_color', '#4fbf53', '', 'no');
    if ($read_more_link_text_color) {
        ?>
        .readmore-btn>div,.readmore-btn>div i
        {
        color: <?php echo esc_attr($read_more_link_text_color) ?>;
        background: -webkit-linear-gradient(to right, <?php echo esc_attr($read_more_link_text_color) ?>, <?php echo esc_attr($read_more_link_text_color) ?>);
        background: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($read_more_link_text_color) ?>), to(<?php echo esc_attr($read_more_link_text_color) ?>));
        background: -webkit-linear-gradient(left, <?php echo esc_attr($read_more_link_text_color) ?>, <?php echo esc_attr($read_more_link_text_color) ?>);
        background: -o-linear-gradient(left, <?php echo esc_attr($read_more_link_text_color) ?>, <?php echo esc_attr($read_more_link_text_color) ?>);
        background: linear-gradient(to right, <?php echo esc_attr($read_more_link_text_color) ?>, <?php echo esc_attr($read_more_link_text_color) ?>);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        }


        @media screen and (min-width: 0\0) {
        .readmore-btn>div,
        .readmore-btn> div i,
            {
            background: none!important;
            color: <?php echo esc_attr($read_more_link_text_color) ?>;
            }
        }


    <?php }

    $read_more_link_text_hover_color = cynic_printcustomizerstyles('', 'read_more_link_text_hover_color', '#4fbf53', '', 'no');
    if ($read_more_link_text_hover_color) {
        ?>
        .readmore-btn:hover > div,.readmore-btn:hover >div i
        {
        color: <?php echo esc_attr($read_more_link_text_hover_color) ?>;
        background: -webkit-linear-gradient(to right, <?php echo esc_attr($read_more_link_text_hover_color) ?>, <?php echo esc_attr($read_more_link_text_hover_color) ?>);
        background: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($read_more_link_text_hover_color) ?>), to(<?php echo esc_attr($read_more_link_text_hover_color) ?>));
        background: -webkit-linear-gradient(left, <?php echo esc_attr($read_more_link_text_hover_color) ?>, <?php echo esc_attr($read_more_link_text_hover_color) ?>);
        background: -o-linear-gradient(left, <?php echo esc_attr($read_more_link_text_hover_color) ?>, <?php echo esc_attr($read_more_link_text_hover_color) ?>);
        background: linear-gradient(to right, <?php echo esc_attr($read_more_link_text_hover_color) ?>, <?php echo esc_attr($read_more_link_text_hover_color) ?>);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        }

        @media screen and (min-width: 0\0) {
        .readmore-btn:hover > div,
        .readmore-btn:hover >div i,
        .featured-works .box-with-img:hover .overlay .readmore-btn > div i,
        .box-with-img:hover .readmore-btn>div i
            {
            background: none!important;
            color: <?php echo esc_attr($read_more_link_text_hover_color) ?>;
            }
        }

    <?php }

    $featured_portfolio_box_links_color = cynic_printcustomizerstyles('', 'featured_portfolio_box_links_color', '#ffffff', '', 'no');
    if ($featured_portfolio_box_links_color) {
        ?>
        .featured-works .box-with-img .overlay .text-content h3,
        .featured-work-content .box-with-img:hover .readmore-btn>div,
        .featured-work-content .box-with-img:hover .readmore-btn>div i{
        color: <?php echo esc_attr($featured_portfolio_box_links_color) ?>;
        -webkit-text-fill-color: <?php echo esc_attr($featured_portfolio_box_links_color) ?>;
        text-fill-color: <?php echo esc_attr($featured_portfolio_box_links_color) ?>;
        }
    <?php }
    $fontIconColor = cynic_printcustomizerstyles('', 'font_icon_color', '#4fbf53', '', '');
    if ($fontIconColor) {
        ?>
        .grad-icon::before {
        background: -webkit-linear-gradient(to right, <?php echo esc_attr($fontIconColor) ?>, <?php echo esc_attr($fontIconColor) ?>);
        background: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($fontIconColor) ?>), to(<?php echo esc_attr($fontIconColor) ?>));
        background: -webkit-linear-gradient(left, <?php echo esc_attr($fontIconColor) ?>, <?php echo esc_attr($fontIconColor) ?>);
        background: -o-linear-gradient(left, <?php echo esc_attr($fontIconColor) ?>, <?php echo esc_attr($fontIconColor) ?>);
        background: linear-gradient(to right, <?php echo esc_attr($fontIconColor) ?>, <?php echo esc_attr($fontIconColor) ?>);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        }
        .loader_wrapper .loader {
        border-color: <?php echo esc_attr($fontIconColor) ?>;
        }

        @media screen and (min-width: 0\0) {
        .grad-icon::before
            {
            background: none!important;
            color: <?php echo esc_attr($fontIconColor) ?>;
            }
        }
    <?php }
    $breadcrumb_text_default_color = (getCynicOptionsVal('header_banner_mode') == 1) ? '#ffffff' : '#555555';
    $breadcrumb_text_color = cynic_printcustomizerstyles('', 'breadcrumb_text_color', $breadcrumb_text_default_color, '', 'no');
    if ($breadcrumb_text_color) {
        ?>
        .top-header-image .breadcrumb .breadcrumb-item, .top-header-image .breadcrumb .breadcrumb-item a,
        .top-header-image .breadcrumb .breadcrumb-item a i

        {
        color:<?php echo esc_attr($breadcrumb_text_color); ?>;
        }
    <?php }

    $breadcrumb_anchor_text_hover_color = cynic_printcustomizerstyles('', 'breadcrumb_anchor_text_hover_color', '#4fbf53', '', 'no');
    if ($breadcrumb_anchor_text_hover_color) {
        ?>
        .top-header-image .breadcrumb .breadcrumb-item a:hover
        {
        color:<?php echo esc_attr($breadcrumb_anchor_text_hover_color); ?>;
        }
    <?php } ?>



    <?php
    $innerPageTitledefaultColor = (getCynicOptionsVal('header_banner_mode') == 1) ? '#ffffff' : '#33afff';
    $innerPageTitleColor = cynic_printcustomizerstyles('', 'inner_page_banner_heading_color', $innerPageTitledefaultColor, '', 'no');
    if ($innerPageTitleColor) {
    ?>
           .ip-banner.top-header-image .content h1,
            .top-header-image .content h1,
            .ip-banner .content h1,
            header.entry-header h1.entry-title,
            .p-under-construction .fullscreen-banner h1,
            .p-404-error .fullscreen-banner.banner-404 h1 span,
            .contact-us .contact-info .content h3 a
        {
            background: -webkit-gradient(linear, right top, left top, from(<?php echo esc_attr($innerPageTitleColor); ?>), to(<?php echo esc_attr($innerPageTitleColor); ?>));
            background: -webkit-linear-gradient(right, <?php echo esc_attr($innerPageTitleColor);?>, <?php echo esc_attr($innerPageTitleColor);?>);
            background: -o-linear-gradient(right, <?php echo esc_attr($innerPageTitleColor);?>, <?php echo esc_attr($innerPageTitleColor);?>);
            background: linear-gradient(to left, <?php echo esc_attr($innerPageTitleColor);?>, <?php echo esc_attr($innerPageTitleColor);?>);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
            }

        @media screen and (min-width: 0\0) {
        .ip-banner.top-header-image .content h1,
        .details-banner.top-header-image .content h1,
        .contact-us .contact-info .content h3 a
            {
            background: none!important;
            color: <?php echo esc_attr($innerPageTitleColor); ?>;
            }
        }

        <?php }
    $inner_page_banner_text_defaultcolor = (getCynicOptionsVal('header_banner_mode') == 1) ? '#ffffff' : '#555555';
    $inner_page_banner_text_color = cynic_printcustomizerstyles('', 'inner_page_banner_text_color', $inner_page_banner_text_defaultcolor, '', 'no');
    if ($inner_page_banner_text_color) { ?>
            .top-header-image .content p, .ip-banner .content p  {
            color:<?php echo esc_attr($inner_page_banner_text_color); ?>;
            }
        <?php
    }

        $section_heading_span_color = cynic_printcustomizerstyles('', 'section_heading_span_color', '#5c81fa', '', 'no');
        if ($section_heading_span_color) { ?>
            h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
            .section-heading h2 span,
            .banner-with-form .form-content h3{
            color:<?php echo esc_attr($section_heading_span_color); ?>;
            }
    <?php }

        $section_sub_heading_color = cynic_printcustomizerstyles('', 'section_sub_heading_color', '#888888', '', 'no');
        if ($section_sub_heading_color) { ?>
            .blog .blog-content-wrapper .row [class^="col-"] .blog-content .text-content span,
            .team-gridder .gridder .gridder-expanded-content h3 span,
            .review-content .media .media-body,
            .widget .media .media-body,
            article.blog-item .article-head .post-title .post-info a,
            article.blog-item .article-head .post-title .post-info .category-icon,
            article.blog-item .article-head .post-date,
            .blog-item .category-icon I,
            .pagination .page-numbers,
            .blog-details .post-nav .prev-next a,
            .vacant-positions .list-of-jobs .position h3 span,
            .awards-achieved .row div[class^="col-"] .content h3 span,
            .comment-author .comment-meta a, .widget ul li a,
            .tagcloud a, .post-tags a,.form-content .form-heading .ff-close-btn
            {
            color:<?php echo esc_attr($section_sub_heading_color);?>;
            }
            .tagcloud a, .post-tags a, .form-content .form-heading .ff-close-btn {
            border-color:<?php echo esc_attr($section_sub_heading_color);?>;
            }
        <?php }

        $section_inner_banner_blue_bg_text_color = cynic_printcustomizerstyles('', 'section_inner_banner_blue_bg_text_color', '#ffffff', '', 'no');
        if ($section_inner_banner_blue_bg_text_color) { ?>
            .components .head-with-bg .overlay .section-heading h2,
            .components .head-with-bg .overlay .section-heading p,
            .drive-trafic .form-content h3{
            color:<?php echo esc_attr($section_inner_banner_blue_bg_text_color);?>;
            }
        <?php }

    $inner_page_banner_background_image = cynic_printcustomizerstyles('', 'inner_page_banner_background_image', CYNIC_THEME_URI . '/images/mainbg-top.png', '', 'no');
    if ($inner_page_banner_background_image) { ?>
            .ip-banner.top-header-image {
                background-image: url(<?php echo esc_url($inner_page_banner_background_image) ?>);
            }
        <?php }

//Inner Page Banner (Solid)


    $inner_page_solid_banner_background_color_left = cynic_printcustomizerstyles('', 'inner_page_solid_banner_background_color_left', '#5c81fa', '', 'no');
    $inner_page_solid_banner_background_color_right = cynic_printcustomizerstyles('', 'inner_page_solid_banner_background_color_right', '#39a8fe', '', 'no');
    if ($inner_page_solid_banner_background_color_left || $inner_page_solid_banner_background_color_right) {
        $inner_page_solid_banner_background_color_left = ($inner_page_solid_banner_background_color_left) ? $inner_page_solid_banner_background_color_left : '#5c81fa';
        $inner_page_solid_banner_background_color_right = ($inner_page_solid_banner_background_color_right) ? $inner_page_solid_banner_background_color_right : '#39a8fe';
        ?>
        .details-banner {
        background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($inner_page_solid_banner_background_color_left) ?>), to(<?php echo esc_attr($inner_page_solid_banner_background_color_right) ?>));
        background-image: -webkit-linear-gradient(left, <?php echo esc_attr($inner_page_solid_banner_background_color_left) ?>, <?php echo esc_attr($inner_page_solid_banner_background_color_right) ?>);
        background-image: -o-linear-gradient(left, <?php echo esc_attr($inner_page_solid_banner_background_color_left) ?>, <?php echo esc_attr($inner_page_solid_banner_background_color_right) ?>);
        background-image: linear-gradient(to right, <?php echo esc_attr($inner_page_solid_banner_background_color_left) ?>, <?php echo esc_attr($inner_page_solid_banner_background_color_right) ?>);
        }
    <?php }

    $inner_page_solid_banner_heading_color = cynic_printcustomizerstyles('', 'inner_page_solid_banner_heading_color', '#ffffff', '', 'no');
    if ($inner_page_solid_banner_heading_color) {
        ?>
        .details-banner.top-header-image .content h1,
        .details-banner .content h1,
        .contact-us .contact-info .content h3 a
        {
        background: -webkit-gradient(linear, right top, left top, from(<?php echo esc_attr($inner_page_solid_banner_heading_color); ?>), to(<?php echo esc_attr($inner_page_solid_banner_heading_color); ?>));
        background: -webkit-linear-gradient(right, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>);
        background: -o-linear-gradient(right, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>);
        background: linear-gradient(to left, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>, <?php echo esc_attr($inner_page_solid_banner_heading_color);?>);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        }

        @media screen and (min-width: 0\0) {
        .ip-banner.top-header-image .content h1,
        .details-banner.top-header-image .content h1,
        .contact-us .contact-info .content h3 a
        {
        background: none!important;
        color: <?php echo esc_attr($inner_page_solid_banner_heading_color); ?>;
        }
        }

    <?php }

    $inner_page_solid_banner_breadcrumb_text_color = cynic_printcustomizerstyles('', 'inner_page_solid_banner_breadcrumb_text_color', '#ffffff', '', 'no');
    if ($inner_page_solid_banner_breadcrumb_text_color) {
        ?>
        .breadcrumb .breadcrumb-item a, .breadcrumb .breadcrumb-item,
        .breadcrumb .breadcrumb-item a i

        {
        color:<?php echo esc_attr($inner_page_solid_banner_breadcrumb_text_color); ?>;
        }
    <?php }

    $inner_page_solid_banner_breadcrumb_anchor_text_hover_color = cynic_printcustomizerstyles('', 'inner_page_solid_banner_breadcrumb_anchor_text_hover_color', '#ffffff', '', 'no');
    if ($inner_page_solid_banner_breadcrumb_anchor_text_hover_color) {
        ?>
        .breadcrumb .breadcrumb-item a:hover{
        color:<?php echo esc_attr($inner_page_solid_banner_breadcrumb_anchor_text_hover_color); ?>;
        }
    <?php }



        $navLinkHoverColorTop = cynic_printcustomizerstyles('', 'section_tab_hover_bg_color_top', '#eef7fe', '', 'no');
        $navLinkHoverColorBottom = cynic_printcustomizerstyles('', 'section_tab_hover_bg_color_bottom', '#ffffff', '', 'no');
    if ($navLinkHoverColorTop || $navLinkHoverColorBottom) {
        $navLinkHoverColorTop = ($navLinkHoverColorTop) ? $navLinkHoverColorTop : '#eef7fe';
        $navLinkHoverColorBottom = ($navLinkHoverColorBottom) ? $navLinkHoverColorBottom : '#ffffff';
    ?>
            .services .content:hover,
            .tab-container.type-1 .nav-tabs .nav-item .nav-link:hover,
            .tab-container.type-1 .nav-tabs .nav-item .nav-link.active,
            .tab-container.type-2 .nav-tabs .nav-item .nav-link.active .img-container::after,
            .tab-container.type-2 .nav-tabs .nav-item.visited .img-container::after,
            .pricing-plan .pricing-container .pricing-table:hover,
            .pricing-plan .pricing-container .pricing-table.featured,
            .featured-projects .tab-container .nav-tabs .nav-item .nav-link:hover,
            .featured-projects .tab-container .nav-tabs .nav-item .nav-link.active
            {
            background-image: -webkit-linear-gradient(to top, <?php echo esc_attr($navLinkHoverColorBottom)?>, <?php echo esc_attr($navLinkHoverColorTop) ?>);
            background-image: -moz-linear-gradient(to top, <?php echo esc_attr($navLinkHoverColorBottom)?>, <?php echo esc_attr($navLinkHoverColorTop)?>);
            background-image: -o-linear-gradient(to top, <?php echo esc_attr($navLinkHoverColorBottom)?>, <?php echo esc_attr($navLinkHoverColorTop)?>);
            background-image: -ms-linear-gradient(to top, <?php echo esc_attr($navLinkHoverColorBottom) ?>,<?php echo esc_attr($navLinkHoverColorTop)?>);
            background-image: -webkit-gradient(linear, left bottom, left top, from(<?php echo esc_attr($navLinkHoverColorBottom)?>), to(<?php echo esc_attr($navLinkHoverColorTop)?>));
            background-image: -webkit-linear-gradient(bottom, <?php echo esc_attr($navLinkHoverColorBottom)?>,<?php echo esc_attr($navLinkHoverColorTop)?>);
            background-image: -o-linear-gradient(bottom, <?php echo esc_attr($navLinkHoverColorBottom)?>,<?php echo esc_attr($navLinkHoverColorTop)?>);
            background-image: linear-gradient(to top, <?php echo esc_attr($navLinkHoverColorBottom)?>, <?php echo esc_attr($navLinkHoverColorTop)?>);
            }
    <?php }

        $section_tab_border_color_top = cynic_printcustomizerstyles('', 'section_tab_border_color_top', '#5c81fa', '', 'no');
        $section_tab_border_color_bottom = cynic_printcustomizerstyles('', 'section_tab_border_color_bottom', '#39a8fe', '', 'no');
        if($section_tab_border_color_top || $section_tab_border_color_bottom){
            $section_tab_border_color_top = ($section_tab_border_color_top)?$section_tab_border_color_top:'#5c81fa';
            $section_tab_border_color_bottom = ($section_tab_border_color_bottom)?$section_tab_border_color_bottom:'#39a8fe';
    ?>

        .tab-container.type-2 .nav-tabs .nav-item.visited .img-container,
        .tab-container.type-2 .nav-tabs .nav-item .nav-link.active .img-container
        {
            background-image: -webkit-linear-gradient(to top, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: -moz-linear-gradient(to top, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: -o-linear-gradient(to top, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: -ms-linear-gradient(to top, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: -webkit-gradient(linear, left bottom, left top, from(<?php echo esc_attr($section_tab_border_color_bottom)?>), to(<?php echo esc_attr($section_tab_border_color_top)?>));
            background-image: -webkit-linear-gradient(bottom, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: -o-linear-gradient(bottom, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            background-image: linear-gradient(to top, <?php echo esc_attr($section_tab_border_color_bottom)?>, <?php echo esc_attr($section_tab_border_color_top)?>);
            }
    <?php
        }

    $section_tab_bottom_border_line_hover_color = cynic_printcustomizerstyles('', 'section_tab_bottom_border_line_hover_color', '#5c81fa', '', 'no');
    if ($section_tab_bottom_border_line_hover_color) {
    ?>  .services .content::after,.featured-projects .tab-container .nav-tabs .nav-item .nav-link::after,
        .tab-container.type-1 .nav-tabs .nav-item .nav-link::after,
        .tab-container.type-1 .nav-tabs .nav-item .nav-link:hover::after,
        .banner-with-form .form-content h3::after
        {
            background-color:<?php echo esc_attr($section_tab_bottom_border_line_hover_color);?>;
            }
        <?php }

    $section_tab_bottom_border_line_active_color = cynic_printcustomizerstyles('', 'section_tab_bottom_border_line_active_color', '#5c81fa', '', 'no');
    if($section_tab_bottom_border_line_active_color){
        ?>
        .tab-container.type-1 .nav-tabs .nav-item .nav-link.active::after,
        .featured-projects .tab-container .nav-tabs .nav-item .nav-link.active::after
        {
            background: <?php echo esc_attr($section_tab_bottom_border_line_active_color) ?>;
        }

        .pricing-plan .pricing-container .pricing-table.featured {
        border-color:<?php echo esc_attr($section_tab_bottom_border_line_active_color) ?>;
        }
    <?php
    }

        $section_vc_element_content_paragram_color = cynic_printcustomizerstyles('', 'section_vc_element_content_paragram_color', '#555555', '', 'no');
        if ($section_vc_element_content_paragram_color) {?>
            .section  p, .section  p span, .section  p strong,
            .section  p span:not(.wpcf7-not-valid-tip),
            .section .text-content ul li,
            .section .text-content  ul li span,
            .section .text-content  ul li strong,
            .section ul.search-list-box li,
            .section ul.search-list-box li strong,
            .tab-container .tab-content .tab-pane .text-content .seo-list-box li span,
            .tab-container .tab-content .tab-pane .text-content .seo-list-box li i,
            .service-cat-checklist .row div[class^="col-"] .content .checklist-list-group li,
            .tab-container .tab-content .tab-pane .text-content p,
            .talent-hunt-banner .content-block p,
            .job-facilities .content p,
            .job-description .description-box .list-box li,
            .pricing-plan .pricing-container .pricing-table .what-is-included li,
            ul li,
            .contact-page-form .form-content .form-container form .checkbox-holder .checkbox-title,
            .form-content .form-container form .checkbox-holder .checkbox-title,
            .form-content .form-container form .address address p span,
            .form-content .form-container form .address address p a,
            .checkbox-holder span, .p-404-error .fullscreen-banner p,
            .banner .banner-content p

            {
            color:<?php echo esc_attr($section_vc_element_content_paragram_color)?>;
            }
            .form-control::placeholder
            {
                color:<?php echo esc_attr($section_vc_element_content_paragram_color)?>;
                }
            .form-control:-ms-input-placeholder
                 {
                color:<?php echo esc_attr($section_vc_element_content_paragram_color)?>;
                }
                .form-control::-ms-input-placeholder {
                color:<?php echo esc_attr($section_vc_element_content_paragram_color)?>;
                }

        <?php }


    $section_tab_text_color = cynic_printcustomizerstyles('', 'section_tab_text_color', '#555555', '', 'no');
    if ($section_tab_text_color) { ?>
        .tab-container.type-2 .nav-tabs .nav-item .nav-link,
        .tab-container.type-1 .nav-tabs .nav-item .nav-link
        {
        color:<?php echo esc_attr($section_tab_text_color);?>;
        }
    <?php }

    $section_tab_active_visited_text_color = cynic_printcustomizerstyles('', 'section_tab_active_visited_text_color', '#33afff', '', 'no');
    if ($section_tab_active_visited_text_color) { ?>
        .tab-container.type-1 .nav-tabs .nav-item .nav-link:hover span,
        .tab-container.type-1 .nav-tabs .nav-item .nav-link.active span,
        .tab-container.type-2 .nav-tabs .nav-item .nav-link.active span,
        .tab-container.type-2 .nav-tabs .nav-item.visited .nav-link span
        {
        background: -webkit-linear-gradient(to left, <?php echo esc_attr($section_tab_active_visited_text_color);?> <?php echo esc_attr($section_tab_active_visited_text_color);?>);
        background: -webkit-gradient(linear, right top, left top, from(<?php echo esc_attr($section_tab_active_visited_text_color);?>), to(<?php echo esc_attr($section_tab_active_visited_text_color);?>));
        background: -webkit-linear-gradient(right, <?php echo esc_attr($section_tab_active_visited_text_color);?>, <?php echo esc_attr($section_tab_active_visited_text_color);?>);
        background: -o-linear-gradient(right, <?php echo esc_attr($section_tab_active_visited_text_color);?>, <?php echo esc_attr($section_tab_active_visited_text_color);?>);
        background: linear-gradient(to left, <?php echo esc_attr($section_tab_active_visited_text_color);?>, <?php echo esc_attr($section_tab_active_visited_text_color);?>);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        }
        .tab-container.type-2 .nav-tabs .nav-item:not(:last-child)::after,
        .tab-container.type-2 .nav-tabs .nav-item.visited:not(:last-child)::before{
        background:<?php echo esc_attr($section_tab_active_visited_text_color) ?>;
        }

        @media screen and (min-width: 0\0) {
        .tab-container.type-1 .nav-tabs .nav-item .nav-link:hover span,
        .tab-container.type-1 .nav-tabs .nav-item .nav-link.active span,
        .tab-container.type-2 .nav-tabs .nav-item .nav-link.active span,
        .tab-container.type-2 .nav-tabs .nav-item.visited .nav-link span
            {
            background: none!important;
            color: <?php echo esc_attr($section_tab_active_visited_text_color);?>;
            }
        }

    <?php }

    $themeMode = getCynicOptionsVal('theme_mode');
    $section_background_image = cynic_printcustomizerstyles('', 'section_background_image', CYNIC_THEME_URI . '/images/graybg-overlay.png', '', 'no');
    $section_background_image_color = cynic_printcustomizerstyles('', 'section_background_image_color','#def2ff', '', 'no');
    if ($themeMode == 2) {
        if($section_background_image || $section_background_image_color){
            ?>
            .grey-bg {
            <?php
                if($section_background_image_color){
                ?>
                background-color: <?php echo esc_attr($section_background_image_color); ?>;
                 <?php
                }
                if(($section_background_image)){
                    ?>
                background-image: <?php echo esc_url($section_background_image);?>;
                <?php
                }
            ?>

            }
            <?php
        }
        ?>
            <?php
    } else {
    ?>
            .grey-bg {
            background:none !important;
            }
            <?php
    }

    $section_pricing_label_bg_left = cynic_printcustomizerstyles('', 'section_pricing_label_bg_left', '#5c81fa', '', 'no');
    $section_pricing_label_bg_right = cynic_printcustomizerstyles('', 'section_pricing_label_bg_right', '#39a8fe', '', 'no');
    $section_pricing_label_text_color = cynic_printcustomizerstyles('', 'section_pricing_label_text_color', 'ffffff', '', 'no');
    if($section_pricing_label_bg_left || $section_pricing_label_bg_right || $section_pricing_label_text_color){
        $section_pricing_label_bg_left = ($section_pricing_label_bg_left)?$section_pricing_label_bg_left:'#5c81fa';
        $section_pricing_label_bg_right = ($section_pricing_label_bg_right)?$section_pricing_label_bg_right:'#39a8fe';
        $section_pricing_label_text_color = ($section_pricing_label_text_color)?$section_pricing_label_text_color:'#ffffff';
        ?>
        .pricing-plan .pricing-container .pricing-table .price, .featured::after{
            color: <?php echo esc_attr($section_pricing_label_text_color) ?>;
            background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($section_pricing_label_bg_left) ?>), to(<?php echo esc_attr($section_pricing_label_bg_right) ?>));
            background-image: -webkit-linear-gradient(left, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);
            background-image: -o-linear-gradient(left, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);
            background-image: linear-gradient(to right, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);
        }
        .drive-trafic .form-content h3 {
            background-image: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($section_pricing_label_bg_left) ?>), to(<?php echo esc_attr($section_pricing_label_bg_right) ?>));
            background-image: -webkit-linear-gradient(left, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);
            background-image: -o-linear-gradient(left, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);
            background-image: linear-gradient(to right, <?php echo esc_attr($section_pricing_label_bg_left) ?>, <?php echo esc_attr($section_pricing_label_bg_right) ?>);

        }
        <?php
    }


        $overLayLeftColor = cynic_printcustomizerstyles('', 'section_overlay_color_left', '#5c81fa', '', 'no');
    $overLayRightColor = cynic_printcustomizerstyles('', 'section_overlay_color_right', '#39a8fe', '', 'no');
    $overLayAlpha = cynic_printcustomizerstyles('', 'section_alpha_transparent', '10', '', 'no');
    $overLayAlpha = (!empty($overLayAlpha)) ? $overLayAlpha : 'zero';

    if ($overLayLeftColor || $overLayRightColor || $overLayAlpha) {
        $overLayLeftColor = haxtoRGB(($overLayLeftColor) ? $overLayLeftColor : '#5c81fa');
        $overLayRightColor = haxtoRGB(($overLayRightColor) ? $overLayRightColor : '#39a8fe');
        $overLayAlpha = ($overLayAlpha == 'zero') ? 0 : $overLayAlpha;
    ?>      .featured-works .box-with-img .overlay::after, .overlay        {
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(<?php echo esc_attr($overLayLeftColor)?>,<?php echo esc_attr($overLayAlpha)?>)), to(rgba(<?php echo esc_attr($overLayRightColor)?>, <?php echo esc_attr($overLayAlpha)?>)));
            background-image: -webkit-linear-gradient(left, rgba(<?php echo esc_attr($overLayLeftColor)?>,<?php echo esc_attr($overLayAlpha)?>), rgba(<?php echo esc_attr($overLayRightColor)?>, <?php echo esc_attr($overLayAlpha)?>));
            background-image: -o-linear-gradient(left, rgba(<?php echo esc_attr($overLayLeftColor)?>,<?php echo esc_attr($overLayAlpha)?>), rgba(<?php echo esc_attr($overLayRightColor)?>,<?php echo esc_attr($overLayAlpha)?>));
            background-image: linear-gradient(to right, rgba(<?php echo esc_attr($overLayLeftColor)?>,<?php echo esc_attr($overLayAlpha)?>), rgba(<?php echo esc_attr($overLayRightColor)?>,<?php echo esc_attr($overLayAlpha)?>));
            }
        <?php }
    ?>


    <?php
//    Blog Section
    ?>
      <?php
    $blog_banner_post_info_link_color = cynic_printcustomizerstyles('', 'blog_banner_post_info_link_color', '#ffffff', '', 'no');
    if ($blog_banner_post_info_link_color) {
        ?>
        .details-banner .post-info a, .details-banner .post-info .category-icon i {
        color:<?php echo esc_attr($blog_banner_post_info_link_color); ?>;
        }
        <?php
    }

    $blog_banner_post_info_link_hover_color = cynic_printcustomizerstyles('', 'blog_banner_post_info_link_hover_color', '#ffffff', '', 'no');
    if ($blog_banner_post_info_link_hover_color) {
        ?>
        .details-banner .post-info a:hover {
        color:<?php echo esc_attr($blog_banner_post_info_link_hover_color); ?>;
        }
        <?php
    }

    $PoststickbgColor = cynic_printcustomizerstyles('', 'blog_sticky_post_background_color', '#f6f6f6', '', 'no');
    $PoststickleftBorderColor = cynic_printcustomizerstyles('', 'blog_sticky_post_left_border_color', '#5c81fa', '', 'no');
    if ($PoststickbgColor || $PoststickleftBorderColor) {
        ?>
        article.sticky{
        <?php echo esc_attr((($PoststickbgColor) ? 'background:' . $PoststickbgColor . ';' : '')) ?>
        <?php echo esc_attr((($PoststickleftBorderColor) ? 'border-color:' . $PoststickleftBorderColor . ';' : '')) ?>
        }
        blockquote {
        <?php echo esc_attr((($PoststickleftBorderColor) ? 'border-color:' . $PoststickleftBorderColor . ';' : '')) ?>
        }
        <?php
    }
    ?>


    <?php
//    Widget
    ?>

    <?php

    $widget_bottom_border_color = cynic_printcustomizerstyles('', 'widget_bottom_border_color', '#5c81fa', '', 'no');
    if ($widget_bottom_border_color) {
        ?>
        .widget .widget-heading{
        border-color:<?php echo esc_attr($widget_bottom_border_color) ?>;
        }
        <?php
    }
    ?>

    <?php

    $widget_search_field_bottom_border_color = cynic_printcustomizerstyles('', 'widget_search_field_bottom_border_color', '#e6e6e6', '', 'no');
    if ($widget_search_field_bottom_border_color) {
        ?>
        .widget form .form-control{
            border-color: <?php echo esc_attr($widget_search_field_bottom_border_color); ?>
        }
        <?php
    }

    $widget_search_field_focus_bottom_border_color = cynic_printcustomizerstyles('', 'widget_search_field_focus_bottom_border_color', '#4fbf53', '', 'no');
    if ($widget_search_field_focus_bottom_border_color) {
        ?>
        .widget form .form-control:focus{
        border-color:<?php echo esc_attr($widget_search_field_focus_bottom_border_color) ?>;
        }
    <?php }

    // Form Color

    $global_form_control_input_field_border_color = cynic_printcustomizerstyles('', 'global_form_control_input_field_border_color', '#e6e6e6', '', 'no');
    if ($global_form_control_input_field_border_color) {
        ?>
        form .form-control,
        .contact-page-form .form-content .form-container form .form-control{
        border-color:<?php echo esc_attr($global_form_control_input_field_border_color) ?>;
        }
    <?php }

    $global_form_control_input_field_focus_border_color = cynic_printcustomizerstyles('', 'global_form_control_input_field_focus_border_color', '#4fbf53', '', 'no');
    if ($global_form_control_input_field_focus_border_color) {
        ?>
        form .form-control:focus,
        .contact-page-form .form-content .form-container form .form-control:focus{
        border-color:<?php echo esc_attr($global_form_control_input_field_focus_border_color) ?>;
        }
    <?php }

    $global_form_control_check_box_color = cynic_printcustomizerstyles('', 'global_form_control_check_box_color', '#bebebe', '', 'no');
    if ($global_form_control_check_box_color) {
        ?>
        .checkbox-holder .wpcf7-list-item label::before {
           border-color:<?php echo esc_attr($global_form_control_check_box_color) ?>;
        }
    <?php }

    $global_form_control_check_box_active_color = cynic_printcustomizerstyles('', 'global_form_control_check_box_active_color', '#4fbf53', '', 'no');
    if ($global_form_control_check_box_active_color) {
        ?>
        .form-content .form-container form label.checkd-box-field::before {
        background-color:<?php echo esc_attr($global_form_control_check_box_active_color) ?>;
        }
    <?php } ?>



    <?php
    // Revulation Slider
    ?>
    <?php
    $revolution_slider_heading_color = cynic_printcustomizerstyles('', 'revolution_slider_heading_color', '#ffffff', '', 'no');
    if ($revolution_slider_heading_color) {
        ?>
        .rev_slider_wrapper h1,.rev_slider_wrapper h2,.rev_slider_wrapper h3,.rev_slider_wrapper h4, .rev_slider_wrapper h5, .rev_slider_wrapper h6
        {
        color:<?php echo esc_attr($revolution_slider_heading_color) ?> !important;
        }
    <?php }
    $revolution_slider_sub_heading_color = cynic_printcustomizerstyles('', 'revolution_slider_sub_heading_color', '#ffffff', '', 'no');
    if ($revolution_slider_sub_heading_color) {
        ?>
        .rev_slider_wrapper p, .rev_slider_wrapper p span{
        color:<?php echo esc_attr($revolution_slider_sub_heading_color) ?> !important;
        }
    <?php }

    $revolution_slider_arrows_color = cynic_printcustomizerstyles('', 'revolution_slider_arrows_color', '#ffffff', '', 'no');
    if ($revolution_slider_arrows_color) {
        ?>
        .tparrows:before
            {
                color: <?php echo esc_attr($revolution_slider_arrows_color) ?>;
            }
    <?php }
 ?>

    <?php

    $styleCss = ob_get_clean();
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $styleCss);
    return $stripped;
}