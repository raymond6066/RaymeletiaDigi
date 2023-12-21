<?php
function cynic_print_style($array, $index = '', $prop = '', $important = '')
{
    if (isset($array)) {
        print "{$prop}:{$array}{$important};\n";
    }
}


function cynic_print_font_family($array, $prop = '', $fontIn = '', $important = '')
{
    if (isset($array) && isset($prop)) {
        print "{$prop}:{$array}{$fontIn}{$important};\n";
    }
}

function cynic_is_check_val($index, $default = true)
{
    $customizerValue = $default;
    // echo $index;
    $options = get_theme_mod(trim('' . $index . ''));

    // var_dump($options);
    if ($options && $options == 1) {
        $customizerValue = $options;
    } else {
        $customizerValue = $options;
    }

    $customizerValue;

    return $customizerValue;

}

function cynic_haxto_rgb($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $string = $r . ',' . $g . ',' . $b;
    return $string;
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

function cynic_get_custom_styles()
{
    ob_start();
    ?>@charset "UTF-8";
    <?php
    /*Headline And Body Font & Typography*/
    if (get_theme_mod('cynic_body_font')) {
        $bodyFonts = get_theme_mod('cynic_body_font');
        $bodyFonts = json_decode($bodyFonts, true);
        $bFont = (isset($bodyFonts['font']) && isset($bodyFonts['category'])) ?
            $bodyFonts['font'] . ', ' . $bodyFonts['category'] : "Hind Vadodara, sans-serif";
        ?>body, p, .section-subheading{
        <?php cynic_print_font_family($bFont, 'font-family') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline-font')) {
        $headlineFonts = get_theme_mod('cynic_headline-font');
        $headlineFonts = json_decode($headlineFonts, true);
        $hFont = (isset($headlineFonts['font']) && isset($headlineFonts['category'])) ?
            $headlineFonts['font'] . ', ' . $headlineFonts['category'] : "Fira Sans, sans-serif";
        ?>h1, h2, h3, h4, h5, h6, .counter-wrapper, .contact-wrapper h3,.common-slider .item h5 a, .view-map-btn {
        <?php cynic_print_font_family($hFont, 'font-family') ?>
        }
        <?php
    }

    $get_headline1_font_size_in = get_theme_mod('cynic_headline1_font_size_in');
    $headline1_font_size_in = !empty($get_headline1_font_size_in) ? $get_headline1_font_size_in : "4.8";
    if (get_theme_mod('cynic_headline1_font_size')) {
        ?>h1 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline1_font_size'), 'font-size', $headline1_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline1_line_height')) {
        ?>h1 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline1_line_height'), 'line-height', $headline1_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline1_font_color')) {
        ?>h1 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline1_font_color'), 'color') ?>
        }
        <?php
    }

    $get_headline2_font_size_in = get_theme_mod('cynic_headline2_font_size_in');
    $headline2_font_size_in = !empty($get_headline2_font_size_in) ? $get_headline2_font_size_in : "3.6";
    if (get_theme_mod('cynic_headline2_font_size')) {
        ?>h2 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline2_font_size'), 'font-size', $headline2_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline2_line_height')) {
        ?>h2 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline2_line_height'), 'line-height', $headline2_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline2_font_color')) {
        ?>h2 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline2_font_color'), 'color') ?>
        }
        <?php
    }

    $get_headline3_font_size_in = get_theme_mod('cynic_headline3_font_size_in');
    $headline3_font_size_in = !empty($get_headline3_font_size_in) ? $get_headline3_font_size_in : "3";
    if (get_theme_mod('cynic_headline3_font_size')) {
        ?>h3 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline3_font_size'), 'font-size', $headline3_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline3_line_height')) {
        ?>h3 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline3_line_height'), 'line-height', $headline3_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline3_font_color')) {
        ?>h3 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline3_font_color'), 'color') ?>
        }
        <?php
    }

    $get_headline4_font_size_in = get_theme_mod('cynic_headline4_font_size_in');
    $headline4_font_size_in = !empty($get_headline4_font_size_in) ? $get_headline4_font_size_in : "2.4";
    if (get_theme_mod('cynic_headline4_font_size')) {
        ?>h4, .img-card h4 span {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4_font_size'), 'font-size', $headline4_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline4_line_height')) {
        ?>h4, .img-card h4 span {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4_line_height'), 'line-height', $headline4_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline4_font_color')) {
        ?>h4, .img-card h4 span {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4_font_color'), 'color') ?>
        }
        <?php
    }

    $get_headline5_font_size_in = get_theme_mod('cynic_headline5_font_size_in');
    $headline5_font_size_in = !empty($get_headline5_font_size_in) ? $get_headline5_font_size_in : "1.8";
    if (get_theme_mod('cynic_headline5_font_size')) {
        ?>h5 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5_font_size'), 'font-size', $headline5_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline5_line_height')) {
        ?>h5 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5_line_height'), 'line-height', $headline5_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline5_font_color')) {
        ?>h5 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5_font_color'), 'color') ?>
        }
        <?php
    }

    $get_headline6_font_size_in = get_theme_mod('cynic_headline6_font_size_in');
    $headline6_font_size_in = !empty($get_headline6_font_size_in) ? $get_headline6_font_size_in : "1.6";
    if (get_theme_mod('cynic_headline6_font_size')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6_font_size'), 'font-size', $headline6_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline6_line_height')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6_line_height'), 'line-height', $headline6_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline6_font_color')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6_font_color'), 'color') ?>
        }
        <?php
    }

    /*Body Font*/

    $get_body_1_font_size_in = get_theme_mod('cynic_body1_font_size_in');
    $body_1_font_size_in = !empty($get_body_1_font_size_in) ? $get_body_1_font_size_in : "rem";
    if (get_theme_mod('cynic_body1_font_size')) {
        ?>p {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1_font_size'), 'font-size', $body_1_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body1_line_height')) {
        ?>p {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1_line_height'), 'line-height', $body_1_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body1_font_color')) {
        ?>p, .facilities>div {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1_font_color'), 'color') ?>
        }
        <?php
    }

    $get_body_2_font_size_in = get_theme_mod('cynic_body2_font_size_in');
    $body_2_font_size_in = !empty($get_body_2_font_size_in) ? $get_body_2_font_size_in : "rem";
    if (get_theme_mod('cynic_body2_font_size')) {
        ?>p.larger-txt {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2_font_size'), 'font-size', $body_2_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body2_line_height')) {
        ?>p.larger-txt {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2_line_height'), 'line-height', $body_2_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body2_font_color')) {
        ?>p.larger-txt {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2_font_color'), 'color') ?>
        }
        <?php
    }

    $get_body_3_font_size_in = get_theme_mod('cynic_body3_font_size_in');
    $body_3_font_size_in = !empty($get_body_3_font_size_in) ? $get_body_3_font_size_in : "rem";
    if (get_theme_mod('cynic_body3_font_size')) {
        ?>p.smaller-txt, .img-card h4,
        .blog-info li, .blog-info a {
            <?php cynic_print_font_family(get_theme_mod('cynic_body3_font_size'), 'font-size', $body_3_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body3_line_height')) {
        ?>p.smaller-txt, .img-card h4,
        .blog-info li, .blog-info a {
            <?php cynic_print_font_family(get_theme_mod('cynic_body3_line_height'), 'line-height', $body_3_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body3_font_color')) {
        ?>p.smaller-txt, .img-card h4, .blog-info li, .blog-info a {
            <?php cynic_print_font_family(get_theme_mod('cynic_body3_font_color'), 'color') ?>
        }
        <?php
    }

    /*GLobal Colors*/
    if (get_theme_mod('cynic_primary_colors')) {
        ?>.pricing-block.active .price {
            <?php cynic_print_style(get_theme_mod('cynic_primary_colors'), 'color', 'color') ?>
        }
        .theme-bg-d{
            <?php cynic_print_style(get_theme_mod('cynic_primary_colors'), 'background-color', 'background-color') ?>
        }
        .feature-video-popup, .blog-video-popup .img-container::before{
        <?php cynic_print_style(get_theme_mod('cynic_primary_colors'), 'background', 'background') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_secondary_colors')) {
        ?>.price{
        <?php cynic_print_style(get_theme_mod('cynic_secondary_colors'), 'color', 'color') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_social_media_colors')) {
        ?>.social-icons li a{
        <?php cynic_print_style(get_theme_mod('cynic_social_media_colors'), 'color', 'color') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_social_media_hover_colors')) {
        ?>.team-modal .modal-body .social-icons a:hover,
        .page-footer .social-icons a:hover {
        <?php cynic_print_style(get_theme_mod('cynic_social_media_hover_colors'), 'color', 'color') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_line_colors')) {
        ?>.news-card .read-more, .team-modal .modal-body .social-icons {
            border-top: 1px solid <?php echo get_theme_mod('cynic_line_colors'); ?>;
        }
        .review-card .media, .nav-tabs{
            border-bottom: 1px solid <?php echo get_theme_mod('cynic_line_colors'); ?>;
        }
        <?php
    }
    /*Button Colors*/
    if (get_theme_mod('cynic_primary_btn_colors')) {
        ?>.custom-btn, input[type="submit"]{
        <?php cynic_print_style(get_theme_mod('cynic_primary_btn_colors'), 'background-color', 'background-color') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_secondary_btn_colors')) {
        ?>.custom-btn.secondary-btn{
        <?php cynic_print_style(get_theme_mod('cynic_secondary_btn_colors'), 'background-color', 'background-color') ?>
        }
        <?php
    }
    /*Navigation Color*/
    if (get_theme_mod('cynic_menu_colors')) {
        ?>.navbar-nav li a:not(.custom-btn){
        <?php cynic_print_style(get_theme_mod('cynic_menu_colors'), 'color', 'color') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_hover_colors')) {
        ?>.navbar-nav li a:not(.custom-btn)::before {
        <?php cynic_print_style(get_theme_mod('cynic_hover_colors'), 'background-color', 'background-color') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_hover_colors')) {
        ?>.navbar-nav .submenu li a:hover, .navbar-nav .submenu li a.active {
        <?php cynic_print_style(get_theme_mod('cynic_hover_colors'), 'color', 'color') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_menu_spacing') && get_theme_mod('cynic_menu_spacing') != "1.5") {
        $padding = "3.3rem " . get_theme_mod('cynic_menu_spacing') . "rem";
        $margin_left = get_theme_mod('cynic_menu_spacing') . "rem";
        ?>.navbar-nav li{
        <?php cynic_print_style($margin_left, 'margin-left', 'margin-left') ?>
        }
        <?php
    }
//    if (get_theme_mod('cynic_top_menu_bg_color') && get_theme_mod('cynic_top_menu_bg_color') != "#ffffff") {
//        ?><!--.navbar {-->
<!--        --><?php //cynic_print_style(get_theme_mod('cynic_top_menu_bg_color'), 'background', 'background') ?>
<!--        }-->
<!--        --><?php
//    }
    if (get_theme_mod('cynic_link_colors') && get_theme_mod('cynic_link_colors') != "#0a8aff") {
        ?>a, .nav-tabs .nav-link, .hyperlink, .hyperlink:hover,
        .img-card:hover h4 span, .news-card:hover .read-more {
        <?php cynic_print_style(get_theme_mod('cynic_link_colors'), 'color', 'color') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_link_hover_colors') && get_theme_mod('cynic_link_hover_colors') != "#fc7c56") {
        ?>.hyperlink::after, .nav-tabs .nav-link::after {
        <?php cynic_print_style(get_theme_mod('cynic_link_hover_colors'), 'background-color', 'background-color') ?>
        }
        .nav-tabs .nav-link:hover, .nav-tabs .nav-link.active, .nav-tabs .nav-link.btn-active {
        <?php cynic_print_style(get_theme_mod('cynic_link_hover_colors'), 'color', 'color') ?>
        background: transparent;
        }
        <?php
    }
    if (get_theme_mod('cynic_link_hover_colors') && get_theme_mod('cynic_link_hover_colors') != "#fc7c56") {
        ?>.contact-info a:not(.custom-btn):hover {
        <?php cynic_print_style(get_theme_mod('cynic_link_hover_colors'), 'color', 'color') ?>
        }
        <?php
    }
    if(get_theme_mod('cynic_box_color') && get_theme_mod('cynic_box_color') !="#ffffff"){
        ?>.img-card,
        .img-card h4,
        .img-card p,
        .img-card .read-more {
        <?php cynic_print_style(get_theme_mod('cynic_box_color'), 'background-color', 'background-color') ?>
        }
        <?php
    }
    if(get_theme_mod('cynic_box_shadow_color')){
        $shadows = get_theme_mod('cynic_box_shadow_color');
        $shadow_color = cynic_haxto_rgb($shadows);
        ?>.img-card:hover,
        .onepage-services .floating-service-wrapper {
            box-shadow: 0 5px 30px rgba(<?php echo esc_attr($shadow_color); ?>);
        }
        <?php
    }
    if(get_theme_mod('cynic_menu_text_color') && get_theme_mod('cynic_menu_text_color') != "#546182"){
        ?>.page-footer p, .page-footer a {
        <?php cynic_print_style(get_theme_mod('cynic_menu_text_color'), 'color', 'color') ?>
        }
        <?php
    }
    if(get_theme_mod('cynic_menu_text_hover_color') && get_theme_mod('cynic_menu_text_hover_color') != "#fc7c56"){
        ?>.page-footer a:hover {
        <?php cynic_print_style(get_theme_mod('cynic_menu_text_hover_color'), 'color', 'color') ?>
        }
        <?php
    }
    if(get_theme_mod('cynic_menu_title_color') && get_theme_mod('cynic_menu_title_color') != "#ffffff"){
        ?>.footer-nav-title {
        <?php cynic_print_style(get_theme_mod('cynic_menu_title_color'), 'color', 'color') ?>
        }
        <?php
    }
    if(get_theme_mod('cynic_footer_bottom_bg_color') && get_theme_mod('cynic_footer_bottom_bg_color') != "#171741"){
        ?>.page-footer.dark-footer-bg {
        <?php cynic_print_style(get_theme_mod('cynic_footer_bottom_bg_color'), 'background-color', 'background-color') ?>
        }
        <?php
    }


    $styleCss = ob_get_clean();
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $styleCss);
    return $stripped;
}