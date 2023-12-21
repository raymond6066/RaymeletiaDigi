<?php

function cynic_print_style($array, $index = '', $prop = '', $important = '') {
    if (isset($array[$index])) {
        print "{$prop}:{$array[$index]}{$important};\n";
    }
}

function cynic_print_font_family($array, $index = '', $prop = '', $important = '', $default = 'sans-serif') {
    if (isset($array[$index])) {
        print "{$prop}:{$array[$index]},{$default}{$important};\n";
    }
}

function cynic_get_custom_styles() {
    $cynic = get_theme_mod('cynic_theme');
    $cynic_options = cynic_options();
    ob_start();
    if (isset($cynic_options['cynic_body_font'])) {
        ?>
        body,p{
        <?php cynic_print_font_family($cynic_options['cynic_body_font'], 'font-family', 'font-family') ?>
        <?php cynic_print_style($cynic_options['cynic_body_font'], 'font-size', 'font-size') ?>
    }
    <?php
}if (isset($cynic_options['cynic_headings_font'])) {
    ?>
    h1, h2, h3, h4, h5, h6, .box-green-border .service-title,
    .page-template-template-modernpage .team-members .member_details h3{
    <?php cynic_print_font_family($cynic_options['cynic_headings_font'], 'font-family', 'font-family') ?>
}
<?php
}if (isset($cynic_options['cynic_menu_font'])) {
    ?>
    .main-menu ul.navbar-nav li a,
    .nav ul li a
    {
        <?php cynic_print_font_family($cynic_options['cynic_menu_font'], 'font-family', 'font-family') ?>
        <?php cynic_print_style($cynic_options['cynic_menu_font'], 'font-size', 'font-size') ?>
    }
    <?php
}
?>

body, .box-green-border p, .port-modal-content p.gray-text, 
.modal-content li,.potfolio-modal .modal-content .list-with-arrow li::before, 
.modal-content li:before,
.get-privacy-terms .modal-content p {
<?php cynic_print_style($cynic, 'body_textcolor', 'color')?>
}

h3, .page-template-template-modernpage h3{
<?php cynic_print_style($cynic, 'subheading_textcolor', 'color')?>
}
<?php if(isset($cynic['subheading_textcolor']) && !empty($cynic['subheading_textcolor'])) { ?>
    .page-template-default .common-form-section form{
    border-top: 3px solid <?php echo esc_attr($cynic['subheading_textcolor']); ?>
}
<?php } ?>
.owl-prev i, .owl-next i,.tparrows::before,.page-template-template-modernpage.multipage-agency .tparrows::before,
.blog-description a:first-child,
.search-results .content h3, .search-results .content a,
a, .pricing-plans .pricing .price , a:not(.btn) span, .box-green-border a, .box-green-border h3, .box-green-border .service-title, 
.services .box-green-border .service-overlay ul li a, 
.services .box-green-border .service-overlay ul li a i,
.page-template-template-modernpage .box-content-with-img .box-content-text h3 a,
.port-modal-content .regular-text a{
<?php cynic_print_style($cynic, 'link_textcolor', 'color') ?>
}
.owl-prev:hover i, .owl-next:hover i,.tparrows:hover::before,
.search-results .content a:hover,
.blog-description a:first-child:hover,
.page-template-template-modernpage.multipage-agency .tparrows:hover::before,
header ul.header-right a:hover span,
.box-content-with-img .box-content-text h3 a:hover,
.box-green-border:hover a, .box-green-border a:focus, .box-green-border:hover span,
a:hover,header .contact-info ul li a:hover,header .contact-info ul li a:hover span,
.services .box-green-border:hover a .service-title,
.services .box-green-border .service-overlay ul li a:hover, 
.services .box-green-border .service-overlay ul li a:hover i,
.page-template-template-modernpage header .contact-info ul li a:hover span,
.page-template-template-modernpage .services .box-green-border .service-overlay ul li a:hover,
.page-template-template-modernpage .services .box-green-border .service-overlay ul li a:hover i,
.page-template-template-modernpage .box-content-with-img .box-content-text h3 a:hover,
.page-template-template-modernpage .box-content-with-img:hover .box-content-text h3 a,
.page-template-template-modernpage a:hover,
.multipage-agency .blog-item-title a:hover,
.multipage-agency .widget li a:hover,
.multipage-agency .widget li:hover a::before,
.multipage-agency .widget li:hover span a::before,
.multipage-agency footer .light-ash-bg ul li.recentcomments a:first-child:hover, 
.multipage-agency .widget li.recentcomments span a:hover,
.multipage-agency .blog-item-data a:hover,
.data-features .box-green-border:hover a span,
.data-features .box-green-border:hover a .service-title,
.page-template-template-modernpage .team-members .member_details h3 .member_intro:hover,
.team_members .member_details h3 .member_intro:hover,
.page-template-template-modernpage .box-green-border:hover a span, 
.page-template-template-modernpage .box-green-border:hover span,
.page-template-template-modernpage .main-menu .navbar-nav>li>a:not(.btn):hover,
.page-template-template-modernpage .main-menu .navbar-nav>li.active>a:not(.btn),
.main-menu .navbar-nav li>.dropdown-menu li.active>a,
.main-menu .navbar-nav li>.dropdown-menu li.active>a span
{
    <?php cynic_print_style($cynic, 'link_hover_textcolor', 'color') ?>
}
.page-template-template-modernpage .box-green-border::after,
.page-template-template-modernpage .portfolio .text-content::after, 
.page-template-template-modernpage .team-members .content::after,
.page-template-template-modernpage .box-content-with-img:not(.is-featured)::after
{
    border-bottom: 2px solid <?php echo esc_attr($cynic['link_hover_textcolor']); ?>
}

.page-template-template-modernpage.multipage-agency .services .box-green-border .service-overlay ul li a, 
.page-template-template-modernpage.multipage-agency .services .box-green-border .service-overlay ul li a i{
<?php cynic_print_style($cynic, 'link_textcolor', 'color', '!important') ?>
}
.page-template-template-modernpage.multipage-agency .services .box-green-border .service-overlay ul li a:hover, 
.page-template-template-modernpage.multipage-agency .services .box-green-border .service-overlay ul li a:hover i{
<?php cynic_print_style($cynic, 'link_hover_textcolor', 'color', '!important') ?>
}

.page-template-template-modernpage .pro-controls .filter:hover
{
    <?php 
    cynic_print_style($cynic, 'link_hover_textcolor', 'border-color');
    cynic_print_style($cynic, 'link_hover_textcolor', 'color');
    ?>
}
.main-menu{
<?php cynic_print_style($cynic, 'header_bg_color', 'background-color') ?>
}
header{
<?php cynic_print_style($cynic, 'header_top_bg_color', 'background-color') ?>
}

/* color & active color */
<?php if(isset($cynic['common_active_color']) && $cynic['common_active_color']!="#53b778"){ ?>
    .about-box:hover h3 a,
    .success-number .no_count.b-clor,
    .page-template-template-modernpage .success-number .no_count.b-clor,
    .pro-controls .filter.active:focus, .pro-controls .filter.active:hover, .pro-controls .filter.active, .pro-controls .filter:hover, .pro-controls .filter:focus,
    .process-model li.active a, .process-model li.active a:hover, .process-model li.active a:focus, .process-model li.visited a, .process-model li.visited a:hover, .process-model li.visited a:focus,
    .contact-info-box span,.score-table ul li:before,
    .hosting-features .content>i,.hosting-plans .price-lebel .price,
    .hosting-plans .price-lebel sup, .hosting-pricing .pricing-inner .price span
    {
        <?php 
        if($cynic['common_active_color']!="#53b778"){
            cynic_print_style($cynic, 'common_active_color', 'color');
        }
        ?>
    }
    article.blog-item.sticky{
        border-left: 2px solid <?php echo esc_attr($cynic['common_active_color']); ?>
    }
<?php } ?>
    
<?php if(isset($cynic['common_active_color']) && $cynic['common_active_color']!="#53b778"){ ?>
    .start-project .content,
    .search-results .content,
    .search-results-banner input,
    .box-green-border,
    .widget-title,
    #carousel-bounding-box .thumb-list .selected img,
    .pro-controls .filter.active:focus, .pro-controls .filter.active:hover, .pro-controls .filter.active, .pro-controls .filter:hover, .pro-controls .filter:focus,
    .process-model li.active span, .process-model li.visited span,
    form .customised-formgroup input:focus, form .customised-formgroup textarea:focus
    {
        <?php 
        if($cynic['common_active_color']!="#53b778"){
            cynic_print_style($cynic, 'common_active_color', 'border-color');
        }
        ?>
    }
    <?php } ?>

    .search-results-banner input:hover, 
    .search-results-banner input:focus{
    border-bottom: 2px solid <?php echo esc_attr($cynic['button_bg_color']) ?>;
}
.about-box:hover .round-icon-wrapper,
.process-model li.visited::after,
.hosting-pricing .plan-title.essential::before,
.featured-ecommerce-webistes .content .img_container span
{
    <?php cynic_print_style($cynic, 'common_active_color', 'background-color') ?>
}

.banner-txt h1 {
<?php cynic_print_style($cynic, 'page_banner_heading_color', 'color') ?>
}
.banner-txt p {
<?php cynic_print_style($cynic, 'page_banner_text_color', 'color') ?>
}

/* headings */
.b-clor, .pricing-plans .pricing .price span, 
.page-template-template-modernpage h2, 
.page-template-template-modernpage .box-green-border span,
.page-template-template-modernpage .pricing-plans .pricing .price [class^="flaticon-"]::before,
.page-template-template-modernpage .pricing-plans .pricing .price span,
.page-template-template-modernpage .to-top span.icon-chevron-up,
.multipage-agency .blog-item-title a,
.multipage-agency .bg-white h2.blog-item-title,
.multipage-agency .blog-item-title,
.page-template-template-modernpage .box-green-border a span,
.page-template-template-modernpage .box-green-border span
{
    <?php cynic_print_style($cynic, 'heading_textcolor', 'color') ?>
}
.page-template-template-modernpage .contact-form-wrapper .contact-information{
<?php cynic_print_style($cynic, 'footer_contact_bg_color', 'background') ?>
}
.page-template-template-modernpage .contact-form-wrapper .contact-information .social-icons li a i{
<?php cynic_print_style($cynic, 'footer_contact_bg_color', 'color') ?>
}
.page-template-template-modernpage .box-green-border,
.page-template-template-modernpage .team-members .content,
.page-template-template-modernpage .portfolio .text-content,
.page-template-template-modernpage .common-form-section form,
.page-template-template-modernpage .blogs .box-content-with-img {
<?php cynic_print_style($cynic, 'heading_textcolor', 'border-color') ?>
}
.page-template-template-modernpage form .customised-formgroup input:focus,
.page-template-template-modernpage form .customised-formgroup textarea:focus {
<?php cynic_print_style($cynic, 'button_bg_color', 'border-color') ?>
}
<?php if (isset($cynic_options['cynic_menu']) && $cynic_options['cynic_menu'] == 0) { ?>
    /*Mega menu css*/
    .main-menu .navbar-nav>li>a:not(.btn),.main-menu .navbar-nav>li>a:not(.btn):focus{ 
    <?php cynic_print_style($cynic, 'menu_parent_linkcolor', 'color') ?>
}
#menu-main-menu .dropdown > a:hover, 
.main-menu .navbar-nav>li a:not(.btn):hover, 
.main-menu .navbar-nav>li.active>a:not(.btn),
.page-template-template-modernpage .main-menu .navbar-nav>li.active>a:not(.btn),
.page-template-template-modernpage .main-menu .navbar-nav>li a:not(.btn):hover,
.page-template-template-modernpage .main-menu .navbar-nav>li.active>a,
.page-template-template-modernpage.multipage-agency .main-menu .navbar-nav>li a:not(.btn):hover {
<?php 
cynic_print_style($cynic, 'menu_parent_linkhovercolor', 'color');
if( isset($cynic['menu_parent_linkhoverbdrcolor']) && $cynic['menu_parent_linkhoverbdrcolor']!="#ffffff"){
    cynic_print_style($cynic, 'menu_parent_linkhoverbdrcolor', 'border-color', '!important');
}else{
    cynic_print_style($cynic, 'common_active_color', 'border-color'); 
}
?>
}
<?php if(isset($cynic['menu_parent_linkhovercolor']) && $cynic['menu_parent_linkhovercolor']!="#606060"){ ?>
    .page-template-template-modernpage .main-menu .navbar-nav>li>a:not(.btn):hover{
    <?php 
    if($cynic['menu_parent_linkhovercolor']!="#444444"){
        cynic_print_style($cynic, 'menu_parent_linkhovercolor', 'color');
    }
    ?>
}
<?php } ?>
.main-menu .navbar-nav li>.dropdown-menu .megamenu li.active a {
<?php 
if(isset($cynic['menu_parent_linkhoverbdrcolor']) && $cynic['menu_parent_linkhoverbdrcolor']!="#53b778"){
    cynic_print_style($cynic, 'menu_parent_linkhoverbdrcolor', 'color');
}else{
    cynic_print_style($cynic, 'common_active_color', 'color'); 
}
?>
}

.page-template-template-modernpage:not(.multipage-agency) .main-menu .navbar-nav>li.active>a:not(.btn),
.page-template-template-modernpage .pro-controls .filter.active,
.page-template-template-modernpage .pro-controls .filter.active:hover,
.process-model li.active a,
.process-model li.visited a,
.process-model li.visited a:focus,
.process-model li.active a:focus,
.process-model li.active span, .process-model li.visited span {
<?php 
cynic_print_style($cynic, 'common_active_color', 'color'); 
cynic_print_style($cynic, 'common_active_color', 'border-color'); 
?>

}
.main-menu .navbar-nav li>.dropdown-menu .megamenu .dropdown-submenu li.active a, .main-menu .navbar-nav li>.dropdown-menu .megamenu .dropdown-submenu li.active a span{
<?php
if(isset($cynic['menu_parent_linkhoverbdrcolor']) && $cynic['menu_parent_linkhoverbdrcolor']!="#53b778"){
    cynic_print_style($cynic, 'menu_parent_linkhoverbdrcolor', 'color');
}else{
    cynic_print_style($cynic, 'common_active_color', 'color'); 
}
?>
}
.main-menu .navbar-nav li .megamenu {
<?php cynic_print_style($cynic, 'submenu_bg_color', 'background-color') ?>
}
.main-menu .navbar-nav li>.dropdown-menu .megamenu .dropdown-submenu li a, 
.main-menu .navbar-nav li>.dropdown-menu .megamenu li a, 
.main-menu .navbar-nav li>.dropdown-megamenu li a span{
<?php cynic_print_style($cynic, 'submenu_linkcolor', 'color') ?>
}
.main-menu .navbar-nav li>.dropdown-menu .megamenu .dropdown-submenu li a:hover, 
.main-menu .navbar-nav li>.dropdown-menu .megamenu li a:hover, 
.main-menu .navbar-nav li>.dropdown-megamenu li a:hover span{
<?php cynic_print_style($cynic, 'submenu_linkhovercolor', 'color', '!important') ?>
}
.main-menu .navbar-nav li>.dropdown-megamenu .megamenu > .dropdown > .dropdown-toggle,
.multipage-agency .main-menu .navbar-nav li>.dropdown-megamenu .megamenu>li>a,
.multipage-agency .main-menu .navbar-nav li>.dropdown-megamenu .megamenu>li>a:hover {
<?php cynic_print_style($cynic, 'submenu_heading_color', 'color', '!important') ?>
}
<?php } else { ?>
    /* Normal menu */
    .main-menu .navbar-nav > li > a, .main-menu div.navbar-nav ul > li > a{
    <?php cynic_print_style($cynic, 'menu_parent_linkcolor', 'color') ?>
}
.main-menu .navbar-nav > li > a:focus, .main-menu div.navbar-nav ul > li > a:focus,
.main-menu .navbar-nav > li > a:hover, .main-menu div.navbar-nav ul > li > a:hover{
<?php cynic_print_style($cynic, 'menu_parent_linkhovercolor', 'color') ?>
}
.main-menu .navbar-nav a:hover, .main-menu .navbar-nav a:focus, .main-menu .navbar-nav a:hover, .main-menu .navbar-nav a:active, .main-menu .navbar-nav a.active, .main-menu .navbar-nav li.current-menu-item > a{
<?php cynic_print_style($cynic, 'menu_parent_linkhoverbdrcolor', 'border-color') ?>
}
.main-menu .navbar-nav li ul.children, .main-menu .navbar-nav li > .dropdown-menu{
<?php cynic_print_style($cynic, 'submenu_bg_color', 'background-color') ?>
}
.main-menu .navbar-nav li > .dropdown-menu li a span,
.main-menu .navbar-nav li ul.children li a, .main-menu .navbar-nav li ul.dropdown-menu li a{
<?php cynic_print_style($cynic, 'submenu_linkcolor', 'color') ?>
}
.main-menu .navbar-nav li > .dropdown-menu li a:hover span,
.main-menu .navbar-nav li ul.children li a:hover, 
.main-menu .navbar-nav li ul.dropdown-menu li a:hover{
<?php cynic_print_style($cynic, 'submenu_linkhovercolor', 'color') ?>
}
.main-menu .navbar-nav li.active a {
<?php cynic_print_style($cynic, 'common_active_color', 'border-color'); ?>
}
<?php if(isset($cynic['menu_parent_linkhoverbdrcolor']) && !empty($cynic['menu_parent_linkhoverbdrcolor'])) { ?>
    .page-template-template-modernpage.multipage-agency .main-menu .navbar-nav>li>a:not(.btn):hover,
    .page-template-template-modernpage.multipage-agency .main-menu .navbar-nav>li.active>a:not(.btn){
    border-bottom: 2px solid <?php echo esc_attr($cynic['menu_parent_linkhoverbdrcolor']) . " !important"; ?>
}
<?php } ?>
<?php } ?>


/* button */
.btn.btn-fill.full-width,
.main-menu .navbar-nav a.header-feature-modal.proDetModal,
.btn.btn-fill,.btn.btn-fill:focus, .page-template-template-modernpage .btn.btn-primary,
.multipage-agency .comment-reply-link,
.blog-item-body .post-password-form input[type^="submit"] {
border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
-webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
<?php cynic_print_style($cynic, 'button_bg_color', 'background-color') ?>
<?php 
if(isset($cynic['button_text_color']) && !empty($cynic['button_text_color'])){
    cynic_print_style($cynic, 'button_text_color', 'color');    
}else{ ?>
    color:#ffffff;
    <?php } ?>
    <?php cynic_print_style($cynic, 'button_bg_color', 'border-color') ?>
}
/* Border radius for global */
.page-template-template-modernpage .pro-item-img,
.page-template-template-modernpage .por-overlay, 
.page-template-template-modernpage .team-members .content .img_container, 
.page-template-template-modernpage .pricing-plans .pricing,
.page-template-template-modernpage .blogs .box-content-with-img img, 
.page-template-template-modernpage .blogModal .modal-content, 
.page-template-template-modernpage .blog-details-content img, 
.page-template-template-modernpage .modal-content, 
.page-template-template-modernpage #carousel-bounding-box .carousel-inner>.item, 
.page-template-template-modernpage .potfolio-modal .thumb-list img,
.page-template-template-modernpage .testimonial .content,
.page-template-template-modernpage #more-case-studies .box-content-with-img,
.page-template-template-modernpage .pagination .page-numbers,
.page-template-template-modernpage .dis-table,
.multipage-agency .case-study-box .box-content-with-img,
.multipage-agency .about-content img,
.multipage-agency .about-box,
.multipage-agency .team_members .content .img_container,
.multipage-agency .awards-and-recognitions .awards_list .img_container,
.multipage-agency .available-positions .content,
.multipage-agency .faqs-content .panel-group .panel,
.multipage-agency .widget_text img, 
.multipage-agency .blog-media img,
.multipage-agency .search-form .search-field,
.multipage-agency .contact-info-box,
.multipage-agency .tab-content iframe,
.multipage-agency .design-process-content,
.multipage-agency .featured-ecommerce-webistes .content .img_container img,
.multipage-agency .featured-ecommerce-webistes .content .before_after,
.multipage-agency .content-management-system .content,
.multipage-agency .featured-ecommerce-webistes .content .img_container .overlay,
.multipage-agency .concepts .flex-wrapper .img-container img,
.multipage-agency .start-project .content,
.multipage-agency .hosting-pricing .content,
.multipage-agency .hosting-features .content,
.multipage-agency .hosting-plans .content,
.multipage-agency .pagination .page-numbers,
.page-template-template-modernpage .modal-body .img_container img
{
    border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
    -webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
}

.rev_btn_fill, .rev_btn_fill span{
<?php cynic_print_style($cynic, 'button_text_color', 'color','!important') ?>
<?php cynic_print_style($cynic, 'button_bg_color', 'border-color', '!important') ?>
}
.rev_btn_fill{
border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
-webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
<?php cynic_print_style($cynic, 'button_bg_color', 'background-color', '!important') ?>
}
.search-results-banner .form-group button {
<?php cynic_print_style($cynic, 'button_hv_bg_color', 'color') ?>
}
.contact-info-box span,
.under-construction .under-construction-message i,
.modal-content li:before {
<?php cynic_print_style($cynic, 'button_bg_color', 'color') ?>
}
.search-results-banner .form-group button:hover, 
.search-results-banner .form-group button:focus{
<?php cynic_print_style($cynic, 'button_hv_bg_color', 'background') ?>
}
.rev_btn_fill:hover,
.rev_btn_fill:hover span{
background-color: transparent !important;
<?php cynic_print_style($cynic, 'button_hv_bg_color', 'border-color', '!important') ?>
<?php cynic_print_style($cynic, 'button_hv_text_color', 'color', '!important') ?>
}
.btn.btn-fill.full-width:hover,
.main-menu .navbar-nav a.header-feature-modal.proDetModal:hover,
.btn.btn-fill:hover,
.page-template-template-modernpage .menu-btn.active .btn.btn-fill,
.page-template-template-modernpage .btn.btn-primary:hover,
.multipage-agency .comment-reply-link:hover,
.blog-item-body .post-password-form input[type^="submit"]:hover
{
    background-color: transparent;
    <?php cynic_print_style($cynic, 'button_hv_bg_color', 'border-color') ?>
    <?php cynic_print_style($cynic, 'button_hv_text_color', 'color') ?>
}
.btn.green-text,
.btn.btn-nofill.green-text,
.btn.btn-nofill,
.portfolio .text-inner .btn.btn-nofill,
.error-404 .error_message a{
border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
-webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
<?php 
if(isset($cynic['tp_button_text_color']) && $cynic['tp_button_text_color']!="#53b778"){
    cynic_print_style($cynic, 'tp_button_text_color', 'color'); 
}
cynic_print_style($cynic, 'tp_button_bdr_color', 'border-color');
?>
}
.rev_btn_nofill,
.rev_btn_nofill:focus{
border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
-webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
<?php 
if(isset($cynic['tp_button_text_color']) && $cynic['tp_button_text_color']!="#53b778"){
    cynic_print_style($cynic, 'tp_button_text_color', 'color' , '!important' ); 
}
cynic_print_style($cynic, 'tp_button_bdr_color', 'border-color' , '!important') ;
?>
}
.rev_btn_nofill:hover{
<?php 
cynic_print_style($cynic, 'tp_button_hv_bg_color', 'background-color' , '!important');
if(isset($cynic['tp_button_hv_text_color']) && !empty($cynic['tp_button_hv_text_color'])){
    cynic_print_style($cynic, 'tp_button_hv_text_color', 'color' , '!important') ;
} else { ?>
    color: #ffffff !important;
    <?php
}
cynic_print_style($cynic, 'tp_button_hv_bg_color', 'border-color' , '!important') ;
?>
}
.btn.btn-nofill.green-text:hover,
.featured-ecommerce-webistes .content .before_after:hover,
.btn.btn-nofill:hover,
.portfolio .text-inner .btn.btn-nofill:hover{
<?php 
cynic_print_style($cynic, 'tp_button_hv_bg_color', 'background-color');
if(isset($cynic['tp_button_hv_text_color']) && $cynic['tp_button_hv_text_color']!="#ffffff"){
    cynic_print_style($cynic, 'tp_button_hv_text_color', 'color');
}else{ ?>
    color:#ffffff;
    <?php
}
cynic_print_style($cynic, 'tp_button_hv_bg_color', 'border-color');
?>
}

.tp-caption.Cynicbigtitle, .Cynicbigtitle , .page-template-template-modernpage .tp-caption.Cynicbigtitle{
<?php 
cynic_print_style($cynic, 'slider_heading_color', 'color');
?>
}
.tp-caption.CynicSubtitle, .CynicSubtitle, .page-template-template-modernpage .tp-caption.CynicSubtitle {
<?php 
cynic_print_style($cynic, 'slider_sub_heading_color', 'color');
?>
}

/* footer */

footer .grey-dark-bg{
<?php cynic_print_style($cynic, 'footer_top_bg_color', 'background-color') ?>
}
footer .light-ash-bg{
<?php cynic_print_style($cynic, 'footer_txt_color', 'color') ?>
<?php cynic_print_style($cynic, 'footer_bg_color', 'background-color') ?>
}
footer h4.regular-text{
<?php cynic_print_style($cynic, 'footer_heading_color', 'color', '!important') ?>
}
footer .widget_nav_menu ul li a, footer .light-ash-bg ul a{
<?php cynic_print_style($cynic, 'footer_link_color', 'color') ?>
}
footer .light-ash-bg ul a:hover,
.page-template-template-modernpage footer p a:hover{
<?php cynic_print_style($cynic, 'footer_link_hover_color', 'color') ?>
}

.page-template-template-modernpage footer p{
<?php cynic_print_style($cynic, 'footer_txt_color', 'color') ?>
}
.page-template-template-modernpage footer p a{
<?php cynic_print_style($cynic, 'footer_link_color', 'color') ?>
}

/* social icons */

footer .light-ash-bg ul.social-links li a, ul.social-links li a,
.team-modal-content .social_icons li a{
<?php (isset($cynic['social_icon_color']) && !empty($cynic['social_icon_color'])) ? cynic_print_style($cynic, 'social_icon_color', 'background-color') : "" ?>
}
.page-template-template-modernpage footer .light-ash-bg ul.social-links li a:hover, footer .light-ash-bg ul.social-links li a:focus, 
footer .light-ash-bg ul.social-links li a:active, .page-template-template-modernpage ul.social-links li a:hover, ul.social-links li a:focus, ul.social-links li a:active,
.team_members .member_details .social_icons li a:hover, .team-modal-content .social_icons li a:hover {
<?php (isset($cynic['social_icon_hv_color']) && !empty($cynic['social_icon_hv_color'])) ? cynic_print_style($cynic, 'social_icon_hv_color', 'background-color') : "" ?>
}


.page-template-template-modernpage header .social_icons li [class^="icon-"] {
<?php (isset($cynic['social_icon_color']) && !empty($cynic['social_icon_color'])) ? cynic_print_style($cynic, 'social_icon_color', 'color') : "" ?>
}
.page-template-template-modernpage header .social_icons li a:hover [class^="icon-"] {
<?php (isset($cynic['social_icon_hv_color']) && !empty($cynic['social_icon_hv_color'])) ? cynic_print_style($cynic, 'social_icon_hv_color', 'color') : "" ?>
}

.page-template-template-modernpage .port-cat-con .por-overley, 
.page-template-template-modernpage .featured-img-wrapper .por-overley,
.page-template-template-modernpage .team_members .content .img_container .por-overlay{
    background-color: <?php echo get_theme_mod( 'image_overlay_color')?>;
}

<?php if(isset($cynic['tp_button_hv_text_color']) && !empty($cynic['footer_cptborder_color'])){ ?>
    .multipage-agency .footer-bottom p{
        border-top: 1px solid <?php echo esc_attr($cynic['footer_cptborder_color']); ?>;
    }
<?php } ?>

.page-template-template-modernpage .case-studies-carousel .carousel-caption h2{
    <?php cynic_print_style($cynic, 'case_study_carousel_heading_color', 'color') ?>  
}

.page-template-template-modernpage .case-studies-carousel .carousel-caption p{
    <?php cynic_print_style($cynic, 'case_study_carousel_body_text_color', 'color') ?>
}

.page-template-template-modernpage .case-studies-carousel .carousel-caption a span {
    <?php cynic_print_style($cynic, 'case_study_carousel_link_color', 'color'); ?> 
}

/* Global sub title color */
.page-template-template-modernpage .team-members .member_details h3,
.page-template-template-modernpage .box-content-with-img .box-content-text .gray-text,
.page-template-template-modernpage .blogModal .getguoteModal-dialog.potfolio-modal p.gray-text,
.page-template-template-modernpage .team-modal-content p.gray-text,
.page-template-template-modernpage .port-modal-content p.gray-text,
.page-template-template-modernpage .portfolio .text-content h3 span,
.customise-form .customised-formgroup input,.customise-form .customised-formgroup textarea,
.contact-form .customised-formgroup input,
.contact-form .customised-formgroup textarea,
form .customised-formgroup span,
.page-template-template-modernpage header .contact-info ul li a span,
.pro-controls .filter {
<?php cynic_print_style($cynic, 'global_sub_title', 'color') ?>
}

<?php if (isset($cynic_options['cynic_top_bar']) && $cynic_options['cynic_top_bar']=='1') { ?>
    body.logged-in:not(.home) {
        padding-top: 144px;
    }
    .show-header {
        top: 0;
    }
    @media screen and (max-width: 767px) {
        #wpadminbar{
            display:none;
        }
        body.logged-in:not(.home) {
            padding-top: 87px !important;
        }
    }
<?php } ?>

::-webkit-input-placeholder {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

:-moz-placeholder {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

::-moz-placeholder {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

:-ms-input-placeholder {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

::-ms-input-placeholder {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

:placeholder-shown {
<?php cynic_print_style($cynic, 'global_sub_title', 'color','!important') ?>
}

/* Global sub title color */

.is-featured::after{
<?php cynic_print_style($cynic, 'featured_ribbon_color', 'background'); ?>
}

.multipage-agency footer .grey-dark-bg h2 {
<?php cynic_print_style($cynic, 'newsletter_heading', 'color'); ?>
}
.multipage-agency footer .customise-form .customised-formgroup {
border: solid 1px <?php echo esc_attr($cynic['newsletter_input_border']) ?>;
border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px" ?>;
-webkit-border-radius: <?php echo get_theme_mod( 'button_radius', '0' )."px"?>;
}

@media (max-width: 767px) {
.page-template-template-modernpage:not(.multipage-agency) .main-menu .navbar-nav>li>a:not(.btn):hover,
.page-template-template-modernpage:not(.multipage-agency) .main-menu .navbar-nav>li.active>a:not(.btn){
    <?php 
    if(isset($cynic['menu_parent_linkhovercolor']) && $cynic['menu_parent_linkhovercolor']!="#444444"){
        cynic_print_style($cynic, 'menu_parent_linkhovercolor', 'background', '!important');
    }
    ?>
}
    body:not(.multipage-agency) .main-menu .btn.btn-fill:hover, 
    body:not(.multipage-agency) .main-menu .btn.btn-fill:focus,
    body:not(.multipage-agency) .main-menu .navbar-nav>li:hover span{
        <?php 
        cynic_print_style($cynic, 'tp_button_hv_bg_color', 'color' , '!important') ;
        cynic_print_style($cynic, 'tp_button_hv_bg_color', 'border-color' , '!important') ;
        ?>
    }
}

<?php
if (isset($cynic_options['cynic_custom_css']) && $cynic_options['cynic_custom_css']) {
    print $cynic_options['cynic_custom_css'];
}
return ob_get_clean();
}