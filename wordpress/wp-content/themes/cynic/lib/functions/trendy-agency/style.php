<?php

function cynic_print_style($array, $index = '', $prop = '', $important = '')
{
    if (isset($array[$index])) {
        print "{$prop}:{$array[$index]}{$important};\n";
    }
}


function cynic_print_font_family($array, $prop = '', $fontIn = '', $important = '')
{
    if (isset($array) && isset($prop)) {
        print "{$prop}:{$array}{$fontIn}{$important};\n";
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

function generate_gradient($from_color, $from_color_default, $to_color, $to_color_default)

{
    $attributes = "";
    if ($from_color) {
        $attributes .= ", " . $from_color . "";
    } else {
        $attributes .= ", " . $from_color_default . "";
    }
    if ($to_color) {
        $attributes .= ", " . $to_color . "";
    } else {
        $attributes .= ", " . $to_color_default . "";
    }
    $gradients = "background-image: linear-gradient(45deg" . $attributes . ")";
    return $gradients;
}

function cynic_is_check_val($index, $default = true)
{
    $customizerValue = $default;

    $options = get_theme_mod(trim('' . $index . ''));
    if ($options && $options == 1) {
        $customizerValue = $options;
    } else {
        $customizerValue = $options;
    }

    $customizerValue;

    return $customizerValue;

}

function cynic_get_custom_styles()
{
    ob_start();
    ?>@charset "UTF-8";

    /* -- Body and Heading fonts, color, size -- */
    <?php

    if (get_theme_mod('cynic_body-font')) {
        $bodyFonts = get_theme_mod('cynic_body-font');
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
    $get_headline1_font_size_in = get_theme_mod('cynic_headline1-font-size-in');
    $headline1_font_size_in = !empty($get_headline1_font_size_in) ? $get_headline1_font_size_in : "rem";
    if (get_theme_mod('cynic_headline1-font-size')) {
        ?>h1 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline1-font-size'), 'font-size', $headline1_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline1-line-height')) {
        ?>h1 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline1-line-height'), 'line-height') ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_headline1-font-color')) {
        ?>h1 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline1-font-color'), 'color') ?>
        }
        <?php
    }
    $get_headline2_font_size_in = get_theme_mod('cynic_headline2-font-size-in');
    $headline2_font_size_in = !empty($get_headline2_font_size_in) ? $get_headline2_font_size_in : "rem";
    if (get_theme_mod('cynic_headline2-font-size')) {
        ?>h2 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline2-font-size'), 'font-size', $headline2_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline2-line-height')) {
        ?>h2 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline2-line-height'), 'line-height') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline2-font-color')) {
        ?>h2 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline2-font-color'), 'color') ?>
        }
        <?php
    }
    $get_headline3_font_size_in = get_theme_mod('cynic_headline3-font-size-in');
    $headline3_font_size_in = !empty($get_headline3_font_size_in) ? $get_headline3_font_size_in : "rem";
    if (get_theme_mod('cynic_headline3-font-size')) {
        ?>h3 {
            <?php cynic_print_font_family(get_theme_mod('cynic_headline3-font-size'), 'font-size', $headline3_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline3-line-height')) {
        ?>h3 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline3-line-height'), 'line-height') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline3-font-color')) {
        ?>h3, .contact-wrapper h3 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline3-font-color'), 'color') ?>
        }
        <?php
    }
    $get_headline4_font_size_in = get_theme_mod('cynic_headline4-font-size-in');
    $headline4_font_size_in = !empty($get_headline4_font_size_in) ? $get_headline4_font_size_in : "rem";
    if (get_theme_mod('cynic_headline4-font-size')) {
        ?>h4 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4-font-size'), 'font-size', $headline4_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline4-line-height')) {
        ?>h4 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4-line-height'), 'line-height') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline4-font-color')) {
        ?>h4 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline4-font-color'), 'color') ?>
        }
        <?php
    }
    $get_headline5_font_size_in = get_theme_mod('cynic_headline5-font-size-in');
    $headline5_font_size_in = !empty($get_headline5_font_size_in) ? $get_headline5_font_size_in : "rem";
    if (get_theme_mod('cynic_headline5-font-size')) {
        ?>h5 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5-font-size'), 'font-size', $headline5_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline5-line-height')) {
        ?>h5 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5-line-height'), 'line-height') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline5-font-color')) {
        ?>h5,.common-slider .item h5 a {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline5-font-color'), 'color') ?>
        }
        <?php
    }
    $get_headline6_font_size_in = get_theme_mod('cynic_headline6-font-size-in');
    $headline6_font_size_in = !empty($get_headline6_font_size_in) ? $get_headline6_font_size_in : "rem";
    if (get_theme_mod('cynic_headline6-font-size')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6-font-size'), 'font-size', $headline6_font_size_in) ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline6-line-height')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6-line-height'), 'line-height') ?>
        }
        <?php
    }
    if (get_theme_mod('cynic_headline6-font-color')) {
        ?>h6 {
        <?php cynic_print_font_family(get_theme_mod('cynic_headline6-font-color'), 'color') ?>
        }
        <?php
    }
    /* Body Settings */
    $get_body_1_font_size_in = get_theme_mod('cynic_body1-font-size-in');
    $body_1_font_size_in = !empty($get_body_1_font_size_in) ? $get_body_1_font_size_in : "rem";
    if (get_theme_mod('cynic_body1-font-size')) {
        ?>.section-subheading {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1-font-size'), 'font-size', $body_1_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body1-line-height')) {
        ?>.section-subheading {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1-line-height'), 'line-height', $body_1_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body1-font-color')) {
        ?>.section-subheading {
        <?php cynic_print_font_family(get_theme_mod('cynic_body1-font-color'), 'color') ?>
        }
        <?php
    }
    $get_body_2_font_size_in = get_theme_mod('cynic_body2-font-size-in');
    $body_2_font_size_in = !empty($get_body_2_font_size_in) ? $get_body_2_font_size_in : "rem";
    if (get_theme_mod('cynic_body2-font-size')) {
        ?>body, p, input, textarea {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-size'), 'font-size', $body_2_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body2-line-height')) {
        ?>body, p {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-line-height'), 'line-height', $body_2_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body2-font-color')) {
        ?>body, p, input, textarea {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        ::-webkit-input-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        :-ms-input-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        ::-ms-input-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }

        ::-webkit-textarea-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        :-ms-textarea-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        ::-ms-textarea-placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        ::placeholder {
        <?php cynic_print_font_family(get_theme_mod('cynic_body2-font-color'), 'color') ?>
        }
        <?php
    }
    $get_body_3_font_size_in = get_theme_mod('cynic_body3-font-size-in');
    $body_3_font_size_in = !empty($get_body_3_font_size_in) ? $get_body_3_font_size_in : "rem";
    if (get_theme_mod('cynic_body3-font-size')) {
        ?>.content-block__sub-title, .modal .modal-content h1 span,
        .modal .modal-content h3 span,
        .single-portfolio-content h3 span,
        .modal .modal-content h4 span {
        <?php cynic_print_font_family(get_theme_mod('cynic_body3-font-size'), 'font-size', $body_3_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body3-line-height')) {
        ?>.content-block__sub-title, .modal .modal-content h1 span,
        .modal .modal-content h3 span, .single-portfolio-content h3 span,
        .modal .modal-content h4 span {
        <?php cynic_print_font_family(get_theme_mod('cynic_body3-line-height'), 'line-height', $body_3_font_size_in) ?>
        }
        <?php
    }

    if (get_theme_mod('cynic_body3-font-color')) {
        ?>.content-block__sub-title, .modal .modal-content h1 span,
        .modal .modal-content h3 span, .single-portfolio-content h3 span,
        .modal .modal-content h4 span,
        .footer-content p, .footer-content p a{
        <?php cynic_print_font_family(get_theme_mod('cynic_body3-font-color'), 'color') ?>
        }
        <?php
    }

    /* -- colors -- dynamic -- */
    if (get_theme_mod('cynic_primary-colors-to') != "#ff7cb0") { ?>
        .featured-item .img-container::after,
        .featured-item .img-container::before,
        .blog-details .featured-item figure::before, 
        .blog-details .featured-item figure::after {
        border-top-color: <?php echo get_theme_mod('cynic_primary-colors-to'); ?>;
        }
        blockquote{
            border-color: <?php echo get_theme_mod('cynic_primary-colors-to'); ?>;
        }
        .navbar-nav .custom-dropdown-menu {
            border-top: 2px solid <?php echo get_theme_mod('cynic_primary-colors-to'); ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_primary-colors-to') != "#ff7cb0") { ?>
        input:hover, input:focus, textarea:hover, textarea:focus {
        border-color: <?php echo get_theme_mod('cynic_primary-colors-to'); ?> ;
        }
        <?php
    } ?>

    <?php
    if (get_theme_mod('cynic_primary-colors-from') || get_theme_mod('cynic_primary-colors-to')) {
        $primary_color_from = get_theme_mod('cynic_primary-colors-from');
        $primary_color_to = get_theme_mod('cynic_primary-colors-to');

        $primary_color_from = (isset($primary_color_from)) ? $primary_color_from : "#e9a17b";
        $primary_color_to = (isset($primary_color_to)) ? $primary_color_to : "#ff7cb0"; ?>
        .icon-container.grad-style-cd-light::after, .txt-grad-cd,
        .icon-container.grad-style-cd-light::after,
        .navbar-toggler span,
        .banner::before,
        .banner::after,
        .body-bg-style-2.inner-page::before,
        .featured-item::before,
        .content-block::before, .about-us .grad-style-cd, .small-agency-case-study::before,
        .body-bg-style-2.inner-page::before {
            background-image: linear-gradient(45deg, <?php echo $primary_color_from ?>, <?php echo $primary_color_to ?>);
        }
        .featured-item .carousel-inner::after, .featured-item .carousel-inner::before{
            border-top: 15px solid <?php echo $primary_color_to ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_secondary-colors-from') || get_theme_mod('cynic_secondary-colors-to')) {
        $secondary_color_from = get_theme_mod('cynic_secondary-colors-from');
        $secondary_color_to = get_theme_mod('cynic_secondary-colors-to');

        $secondary_color_from = (isset($secondary_color_from)) ? $secondary_color_from : "#f18cff";
        $secondary_color_to = (isset($secondary_color_to)) ? $secondary_color_to : "#af46fc"; ?>
        .icon-container.grad-style-ab-light::after, .txt-grad-ab,
        .body-bg-style-1.inner-page::before {
        background-image: linear-gradient(45deg, <?php echo $secondary_color_from ?>, <?php echo $secondary_color_to ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_tertiary-colors-from') || get_theme_mod('cynic_tertiary-colors-to')) {
        $tertiary_color_from = get_theme_mod('cynic_tertiary-colors-from');
        $tertiary_color_to = get_theme_mod('cynic_tertiary-colors-to');

        $tertiary_color_from = (isset($tertiary_color_from)) ? $tertiary_color_from : "#9a9fff";
        $tertiary_color_to = (isset($tertiary_color_to)) ? $tertiary_color_to : "#6245fe"; ?>
        .icon-container.grad-style-ef-light::after, .txt-grad-ef, .small-agency-case-study::after,
        .body-bg-style-3.inner-page::before {
            background-image: linear-gradient(45deg, <?php echo $tertiary_color_from ?>, <?php echo $tertiary_color_to ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_primary-btn-colors-from') || get_theme_mod('cynic_primary-btn-colors-to')) {
        $primary_btn_color_from = get_theme_mod('cynic_primary-btn-colors-from');
        $primary_btn_color_to = get_theme_mod('cynic_primary-btn-colors-to');

        $primary_btn_color_from = (isset($primary_btn_color_from)) ? $primary_btn_color_from : "#e9a17b";
        $primary_btn_color_to = (isset($primary_btn_color_to)) ? $primary_btn_color_to : "#ff7cb0"; ?>
        .grad-style-cd, .featured-content-block.video-popup .img-container::before,
        .news-content-block .blog-video-popup::before, .pricing-block:hover .custom-btn.grad-style-ef,
        .pricing-block:hover .icon-container.grad-style-ab-light::after,
        .pricing-block:hover .icon-container.grad-style-cd-light::after,
        .pricing-block:hover .icon-container.grad-style-ef-light::after,
        .pricing-block:hover .txt-grad-ef {
        background-image: linear-gradient(45deg, <?php echo $primary_btn_color_from ?>, <?php echo $primary_btn_color_to ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_primary-btn-colors-from-hover') || get_theme_mod('cynic_primary-btn-colors-to-hover')) {
        $primary_btn_color_from_hover = get_theme_mod('cynic_primary-btn-colors-from-hover');
        $primary_btn_color_to_hover = get_theme_mod('cynic_primary-btn-colors-to-hover');

        $primary_btn_color_from_hover = (isset($primary_btn_color_from_hover)) ? $primary_btn_color_from_hover : "#e9a17b";
        $primary_btn_color_to_hover = (isset($primary_btn_color_to_hover)) ? $primary_btn_color_to_hover : "#ff7cb0"; ?>
        .custom-btn.grad-style-cd:hover {
        background-image: linear-gradient(45deg, <?php echo $primary_btn_color_from_hover ?>, <?php echo $primary_btn_color_to_hover ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_secondary-btn-colors-from') || get_theme_mod('cynic_secondary-btn-colors-to')) {
        $secondary_btn_color_from = get_theme_mod('cynic_secondary-btn-colors-from');
        $secondary_btn_color_to = get_theme_mod('cynic_secondary-btn-colors-to');

        $secondary_btn_color_from = (isset($secondary_btn_color_from)) ? $secondary_btn_color_from : "#9a9fff";
        $secondary_btn_color_to = (isset($secondary_btn_color_to)) ? $secondary_btn_color_to : "#6245fe"; ?>
        .custom-btn.grad-style-ef, .case-study.grad-style-ef {
        background-image: linear-gradient(45deg, <?php echo $secondary_btn_color_from ?>, <?php echo $secondary_btn_color_to ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_secondary-btn-colors-from-hover') || get_theme_mod('cynic_secondary-btn-colors-to-hover')) {
        $secondary_btn_color_from_hover = get_theme_mod('cynic_secondary-btn-colors-from-hover');
        $secondary_btn_color_to_hover = get_theme_mod('cynic_secondary-btn-colors-to-hover');

        $secondary_btn_color_from_hover = (isset($secondary_btn_color_from_hover)) ? $secondary_btn_color_from_hover : "#9a9fff";
        $secondary_btn_color_to_hover = (isset($secondary_btn_color_to_hover)) ? $secondary_btn_color_to_hover : "#6245fe"; ?>
        .custom-btn.grad-style-ef:hover {
            background-image: linear-gradient(45deg, <?php echo $secondary_btn_color_from_hover ?>, <?php echo $secondary_btn_color_to_hover ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_tertiary-btn-colors-from') || get_theme_mod('cynic_tertiary-btn-colors-to')) {
        $tertiary_btn_color_from = get_theme_mod('cynic_tertiary-btn-colors-from');
        $tertiary_btn_color_to = get_theme_mod('cynic_tertiary-btn-colors-to');

        $tertiary_btn_color_from = (isset($tertiary_btn_color_from)) ? $tertiary_btn_color_from : "#f18cff";
        $tertiary_btn_color_to = (isset($tertiary_btn_color_to)) ? $tertiary_btn_color_to : "#af46fc"; ?>
        .custom-btn.grad-style-ab, .case-study .video-play-btn {
        background-image: linear-gradient(45deg, <?php echo $tertiary_btn_color_from ?>, <?php echo $tertiary_btn_color_to ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_tertiary-btn-colors-from-hover') || get_theme_mod('cynic_tertiary-btn-colors-to-hover')) {
        $tertiary_btn_color_from_hover = get_theme_mod('cynic_tertiary-btn-colors-from-hover');
        $tertiary_btn_color_to_hover = get_theme_mod('cynic_tertiary-btn-colors-to-hover');

        $tertiary_btn_color_from_hover = (isset($tertiary_btn_color_from_hover)) ? $tertiary_btn_color_from_hover : "#f18cff";
        $tertiary_btn_color_to_hover = (isset($tertiary_btn_color_to_hover)) ? $tertiary_btn_color_to_hover : "#af46fc"; ?>
        .custom-btn.grad-style-ab:hover, .case-study .video-play-btn:hover {
        background-image: linear-gradient(45deg, <?php echo $tertiary_btn_color_from_hover ?>, <?php echo $tertiary_btn_color_to_hover ?>);
        }
        <?php
    }
    if (get_theme_mod('cynic_global-line-colors') != "#edf7ff") {
        ?>.facilities>div, .team-modal .modal-content h4 { border-bottom : 2px solid <?php echo esc_attr(get_theme_mod('cynic_global-line-colors')) ?>; }
        <?php
    }
    if (get_theme_mod('cynic_global-line-colors') != "#edf7ff") {
        ?>.scroreboard-wrapper [class*="col-"]:nth-of-type(odd) .scoreboard-content::after { background: <?php echo esc_attr(get_theme_mod('cynic_global-line-colors')) ?>; }
        <?php
    }
    if (get_theme_mod('cynic_link-colors') != "#69798d") {
        ?>
            .filter-button, .nav-tabs .nav-link,
            .text-only-btn,
            .blog-details h2 span a,
            .author-details .media-body h5 a{ 
                color : <?php echo esc_attr(get_theme_mod('cynic_link-colors')) ?>;
             }
        <?php
    }
    ?>


    .filter-button:hover,
    .nav-tabs .nav-link:hover i,
    .nav-tabs .nav-link:hover span {
        <?php echo generate_gradient(get_theme_mod('cynic_link-hover-colors-from'), '#9a9fff', get_theme_mod('cynic_link-hover-colors-to'), '#6245fe'); ?>;
    }
    <?php if (get_theme_mod('cynic_link-hover-colors-to') != "#6245fe") {?>
        .footer-content p a:hover,
        .text-only-btn:hover,
        .blog-details h2 span a:hover,
        .author-details .media-body h5 a:hover {
            color: <?php echo esc_attr(get_theme_mod('cynic_link-hover-colors-to')) ?>;
        }
        <?php
    } if (!get_theme_mod('cynic_active_sticky')) { ?>
        .navbar {
            position: absolute;
        }
        <?php
    } ?>

    .filter-button.is-checked,
    .nav-tabs .nav-link.active i,
    .nav-tabs .nav-link.active span,
    .nav-tabs .visited .nav-link i,
    .nav-tabs .visited .nav-link span{
    <?php echo generate_gradient(get_theme_mod('cynic_link-active-colors-from'), '#9a9fff', get_theme_mod('cynic_link-active-colors-to'), '#6245fe'); ?>;
    }

    <?php
    $linkActiveColorsTo = cynic_printcustomizerstyles('', 'link-active-colors-to', '#6245fe');
    if ($linkActiveColorsTo) {
        ?>.video-play-btn { color : <?php echo esc_attr($linkActiveColorsTo) ?>; }
        <?php
    } ?>

    <?php
    if (get_theme_mod('cynic_menu-spacing') != '3') { ?>
        .navbar-nav > .nav-item {
        margin-left: <?php echo get_theme_mod('cynic_menu-spacing') . "rem" ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_menu-colors') != '#69798d') { ?>
        .typo-color-c {
        color: <?php echo get_theme_mod('cynic_menu-colors') ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_menu-hover-colors') != '#172b43') { ?>
        .navbar-nav .nav-item .nav-link:not(.custom-btn):hover {
        color: <?php echo get_theme_mod('cynic_hover-colors') ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_menu-active-colors') != '#172b43') { ?>
        .navbar-nav .nav-item .nav-link:not(.custom-btn).active,
        .navbar-nav .nav-item.current-menu-item .nav-link:not(.custom-btn),
        .navbar-nav .nav-item.current-menu-ancestor > .nav-link  {
            color: <?php echo get_theme_mod('cynic_active-colors') ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_bg-color') != '#ffffff') { ?>
        body, .clients, .light-grey-grad, .light-grey-bg {
            background-color: <?php echo get_theme_mod('cynic_bg-color') ?>;
        }
        .light-grey-grad {
            background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo get_theme_mod('cynic_bg-color') ?>), to(<?php echo get_theme_mod('cynic_bg-color') ?>));
        }
        <?php
    }
    if (get_theme_mod('cynic_box-color') != '#ffffff') { ?>
        .content-block, .content-block::before,
        .featured-content-block h5, .news-slider .item h5 {
        background: <?php echo esc_attr(get_theme_mod('cynic_box-color')) ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_box-shadow-color') != '#ffffff') {
        $_colors = get_theme_mod('cynic_box-shadow-color');
        $box_colors = haxtoRGB($_colors); ?>
        .content-block::before,
        .contact-wrapper {
        box-shadow: 0 5px 35px rgb(<?php echo esc_attr($box_colors) ?>);
        }
        <?php
    }
    /*Footer Menu Settings */
    if (get_theme_mod('cynic_headline-color') != '#ffffff') { ?>
        .grey-bg h1, .grey-bg h2,
        .grey-bg h3, .grey-bg h4,
        .grey-bg h5, .grey-bg h6,
        .grey-bg p {
        color: <?php echo esc_attr(get_theme_mod('cynic_headline-color')) ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_menu-text-color')) { ?>
        .contact-info .address a, .contact-info .address span,
        .small-agency-footer .footer-nav-wrapper .footer-nav li a {
        color: <?php echo esc_attr(get_theme_mod('cynic_menu-text-color')) ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_menu-text-hover-color') != '#ff7cb0') { ?>
        .contact-info .address a:hover, .small-agency-footer .footer-nav-wrapper .footer-nav li a:hover,
        .small-agency-footer .footer-nav-wrapper .footer-nav li.current-menu-item a {
            color: <?php echo esc_attr(get_theme_mod('cynic_menu-text-hover-color')) ?>;
        }
        <?php
    }
    /* Social Media Icon */
    if (get_theme_mod('cynic_social-media-color') != '#a6d1ed') { ?>
        .social-icons a {
            background: <?php echo esc_attr(get_theme_mod('cynic_social-media-color')) ?>;
        }
        <?php
    }
    /* Footer Background Colors */
    if (get_theme_mod('cynic_footer-main-bg-color') != '#172b43') { ?>
        .grey-bg {
        background: <?php echo esc_attr(get_theme_mod('cynic_footer-main-bg-color')) ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_footer-bottom-bg-color') != '#ffffff') { ?>
        .page-footer, .small-agency-footer .footer-bottom {
        background: <?php echo esc_attr(get_theme_mod('cynic_footer-bottom-bg-color')) ?>;
        }
        <?php
    }
    /*Case Study Settings */
    if (get_theme_mod('cynic_cs-headline-color') != '#ffffff') { ?>
        .case-study h2 {
        color: <?php echo esc_attr(get_theme_mod('cynic_cs-headline-color')) ?>;
        }
        <?php
    }
    if (get_theme_mod('cynic_cs-body-text-color') != '#ffffff') { ?>
        .case-study p {
        color: <?php echo esc_attr(get_theme_mod('cynic_cs-body-text-color')) ?>;
        }
        <?php
    }

    if (get_theme_mod('cynic_global-modal-colors') != '#fef4f5') { ?>
        .modal {
        background: <?php echo esc_attr(get_theme_mod('cynic_global-modal-colors')) ?>;
        }
        <?php
    }

    if (get_theme_mod('cynic_top-menu-bg-colors') != '#ffffff') { ?>
        .navbar.scrolled {
            background: <?php echo esc_attr(get_theme_mod('cynic_top-menu-bg-colors')) ?>;
        }
        <?php
    } ?>
    
    /* -- IE hacks -- */
    @media screen and (min-width: 0\0) {
        <?php
        if (get_theme_mod('cynic_primary-colors-to')) {
            $primary_color_to = get_theme_mod('cynic_primary-colors-to');
            $primary_color_to = (isset($primary_color_to)) ? $primary_color_to : "#ff7cb0"; ?>
            .txt-grad-cd,
            .pricing-block:hover .price {
                color: <?php echo $primary_color_to ?>;
                background: transparent;
            }
            <?php
        } ?>

        <?php
        if (get_theme_mod('cynic_tertiary-colors-to')) {
            $tertiary_color_to = get_theme_mod('cynic_tertiary-colors-to');
            $tertiary_color_to = (isset($tertiary_color_to)) ? $tertiary_color_to : "#af46fc"; ?>
            .txt-grad-ef,
            .common-list-items li i,
            .nav-tabs .nav-link:hover i,
            .nav-tabs .nav-link:hover span,
            .nav-tabs .nav-link.active i,
            .nav-tabs .nav-link.active span,
            .nav-tabs .nav-item:not(:last-child) .nav-link:hover::after,
            .nav-tabs .nav-item:not(:last-child) .nav-link.active::after,
            .nav-tabs .visited .nav-link i,
            .nav-tabs .visited .nav-link span,
            .nav-tabs .visited .nav-link::after,
            .common-list-items li i,
            .service-tab-nav .nav-link:hover i,
            .service-tab-nav .nav-link:hover span,
            .service-tab-nav .nav-link.active i,
            .service-tab-nav .nav-link.active span,
            .service-tab-nav .nav-item:not(:last-child) .nav-link:hover::after,
            .service-tab-nav .nav-item:not(:last-child) .nav-link.active::after,
            .service-tab-nav .visited .nav-link::after,
            .filter-button:hover,
            .filter-button.is-checked{
                color: <?php echo $tertiary_color_to ?>;
                background: transparent;
            }
            <?php
        } ?>

        <?php
        if (get_theme_mod('cynic_secondary-colors-to')) {
            $secondary_color_to = get_theme_mod('cynic_secondary-colors-to');
            $secondary_color_to = (isset($secondary_color_to)) ? $secondary_color_to : "#6245fe"; ?>
            .txt-grad-ab {
                color: <?php echo $secondary_color_to ?>;
                background: transparent;
            }
            <?php
        } ?>


    }
    <?php
    $styleCss = ob_get_clean();
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $styleCss);
    return $stripped;
}