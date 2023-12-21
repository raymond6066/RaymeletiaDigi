<?php

/**
 * Inner Page Banner
 */

$wp_customize->add_section('cynic_theme_general_variations',
    array(
        'title' => __('General Colors', 'cynic'), //Visible title of section
        'priority' => 2, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize theme global color.', 'cynic'), //Descriptive tooltip
    )
);


// Font Icons Color
$wp_customize->add_setting('cynic_theme[font_icon_color]',
    array(
        'default' => '#4fbf53',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[font_icon_color]',
    array(
        'label'=>'Icons <hr class="hr2">',
        'description' => esc_html__('Font Icons Color', 'cynic'),
        'settings' => 'cynic_theme[font_icon_color]',
        'section' => 'cynic_theme_general_variations',
    )
));



 /**
  * ########### Inner Page Banner (Image) ##############
  */

$wp_customize->add_setting('cynic_theme[inner_page_banner_heading_color]',
    array(
        'default' => '#33afff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_banner_heading_color]',
    array(
        'label' => 'Inner Page Banner (Image) <hr class="hr2">',
        'description' => esc_html__('Banner Heading Color', 'cynic'),
        'settings' => 'cynic_theme[inner_page_banner_heading_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[inner_page_banner_text_color]',
    array(
        'default' => '#555555',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_banner_text_color]',
    array(
        'description' => esc_html__('Banner Sub Headline Color', 'cynic'),
        'settings' => 'cynic_theme[inner_page_banner_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


//Breadcrumb Hover Text Color
$wp_customize->add_setting('cynic_theme[breadcrumb_text_color]',
    array(
        'default' => '#555555',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[breadcrumb_text_color]',
    array(
        'label' => '<hr>',
        'description' => esc_html__('Breadcrumb Text Color', 'cynic'),
        'settings' => 'cynic_theme[breadcrumb_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));
//Anchor Breadcrumb Text Color
$wp_customize->add_setting('cynic_theme[breadcrumb_anchor_text_hover_color]',
    array(
        'default' => '#4fbf53',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[breadcrumb_anchor_text_hover_color]',
    array(
        'description' => esc_html__('Breadcrumb Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[breadcrumb_anchor_text_hover_color]',
        'section' => 'cynic_theme_general_variations',
    )
));



// Inner Banner gray bg images
$wp_customize->add_setting('cynic_theme[inner_page_banner_background_image]',
    array(

        'default' => CYNIC_THEME_URI.'/images/mainbg-top.png',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' =>'esc_url_raw'
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'cynic_theme[inner_page_banner_background_image]',
    array(
        'description' => esc_html__('Banner Background Image', 'cynic'),
        'settings' => 'cynic_theme[inner_page_banner_background_image]',
        'section' => 'cynic_theme_general_variations',
    )
));







/**
 * ########### Inner Page Banner (Solid) ##############
 */

$wp_customize->add_setting('cynic_theme[inner_page_solid_banner_heading_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_solid_banner_heading_color]',
    array(
        'label' => 'Inner Page Banner (Solid) <hr class="hr2">',
        'description' => esc_html__('Banner Heading Color', 'cynic'),
        'settings' => 'cynic_theme[inner_page_solid_banner_heading_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


//Breadcrumb Hover Text Color
$wp_customize->add_setting('cynic_theme[inner_page_solid_banner_breadcrumb_text_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_solid_banner_breadcrumb_text_color]',
    array(
        'label' => '<hr>',
        'description' => esc_html__('Breadcrumb Text Color', 'cynic'),
        'settings' => 'cynic_theme[inner_page_solid_banner_breadcrumb_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));
//Anchor Breadcrumb Text Color
$wp_customize->add_setting('cynic_theme[inner_page_solid_banner_breadcrumb_anchor_text_hover_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_solid_banner_breadcrumb_anchor_text_hover_color]',
    array(
        'description' => esc_html__('Breadcrumb Text Hover Color', 'cynic'),
        'settings' => 'cynic_theme[inner_page_solid_banner_breadcrumb_anchor_text_hover_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[inner_page_solid_banner_background_color_left]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_solid_banner_background_color_left]',
    array(
        'label' =>'<hr>',
        'description' => esc_html__('Banner Background Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[inner_page_solid_banner_background_color_left]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[inner_page_solid_banner_background_color_right]',
    array(
        'default' => '#39a8fe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[inner_page_solid_banner_background_color_right]',
    array(
        'description' => esc_html__('Banner Background Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[inner_page_solid_banner_background_color_right]',
        'section' => 'cynic_theme_general_variations',
    )
));



/**
 * ########### Section TEXT ##############
 */

// Section Heading color
$wp_customize->add_setting('cynic_theme[section_heading_color]',
    array(
        'default' => '#333333',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_heading_color]',
    array(
        'label' => 'Section Text<hr class="hr2">',
        'description' => esc_html__('Section Headline Color', 'cynic'),
        'settings' => 'cynic_theme[section_heading_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


// Section Heading span color
$wp_customize->add_setting('cynic_theme[section_heading_span_color]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_heading_span_color]',
    array(
        'description' => esc_html__('Section Headline Highlight Color', 'cynic'),
        'settings' => 'cynic_theme[section_heading_span_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


// Section Sub Heading color
$wp_customize->add_setting('cynic_theme[section_sub_heading_color]',
    array(
        'default' => '#888888',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_sub_heading_color]',
    array(
        'description' => esc_html__('Section Sub Headline Color', 'cynic'),
        'settings' => 'cynic_theme[section_sub_heading_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[section_vc_element_content_paragram_color]',
    array(
        'default' => '#555555',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_vc_element_content_paragram_color]',
    array(
        'description' => esc_html__('Section Body Text Color', 'cynic'),
        'settings' => 'cynic_theme[section_vc_element_content_paragram_color]',
        'section' => 'cynic_theme_general_variations',
    )
));



// Section Components of Search Engine Optimization
$wp_customize->add_setting('cynic_theme[section_inner_banner_blue_bg_text_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_inner_banner_blue_bg_text_color]',
    array(
        'description' => esc_html__('Section Banner Text Color', 'cynic'),
        'settings' => 'cynic_theme[section_inner_banner_blue_bg_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));



/**
 * ########### Section Image ##############
 */


// Section Image Overlay Color
$wp_customize->add_setting('cynic_theme[section_overlay_color_left]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_overlay_color_left]',
    array(
        'label' => 'Section Image <hr class="hr2">',
        'description' => esc_html__('Section Banner Image Overlay Color (Left)', 'cynic'),
        'settings' => 'cynic_theme[section_overlay_color_left]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[section_overlay_color_right]',
    array(
        'default' => '#39a8fe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_overlay_color_right]',
    array(
        'description' => esc_html__('Section Banner Image Overlay Color (Right)', 'cynic'),
        'settings' => 'cynic_theme[section_overlay_color_right]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[section_alpha_transparent]', array(
    'default' => '0.7',
    'transport' => 'refresh',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'cynic_theme[section_alpha_transparent]', array(
    'type' => 'range-value',
    'section' => 'cynic_theme_general_variations',
    'settings' => 'cynic_theme[section_alpha_transparent]',
    'label' => esc_html__('Overlay Alpha Transparency', 'cynic'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 1,
        'step' => 0.1,
        'suffix' => '', //optional suffix
    ),
)));

// Section gray Background Images Color
$wp_customize->add_setting('cynic_theme[section_background_image_color]',
    array(
        'default' => '#def2ff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_background_image_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Section Background Image Overlay Color', 'cynic'),
        'settings' => 'cynic_theme[section_background_image_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

// Section gray Background Images

$wp_customize->add_setting('cynic_theme[section_background_image]',
    array(

        'default' => CYNIC_THEME_URI.'/images/graybg-overlay.png',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' =>'esc_url_raw'
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'cynic_theme[section_background_image]',
    array(
        'description' => esc_html__('Section Background Image', 'cynic'),
        'settings' => 'cynic_theme[section_background_image]',
        'section' => 'cynic_theme_general_variations',
    )
));






/**
 * ########### Section Tab ##############
 */

$wp_customize->add_setting('cynic_theme[section_tab_text_color]',
    array(
        'default' => '#555555',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_text_color]',
    array(
        'label'=>'Section Tab <hr class="hr2">',
        'description' => esc_html__('Tab Text Color', 'cynic'),
        'settings' => 'cynic_theme[section_tab_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[section_tab_active_visited_text_color]',
    array(
        'default' => '#33afff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_active_visited_text_color]',
    array(
        'description' => esc_html__('Tab Active/Visited Text Color', 'cynic'),
        'settings' => 'cynic_theme[section_tab_active_visited_text_color]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[section_tab_bottom_border_line_active_color]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_bottom_border_line_active_color]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Tab Line Active Color', 'cynic'),
        'settings' => 'cynic_theme[section_tab_bottom_border_line_active_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

// Section Nav Tab Hover Botton Color
$wp_customize->add_setting('cynic_theme[section_tab_bottom_border_line_hover_color]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_bottom_border_line_hover_color]',
    array(
        'description' => esc_html__('Tab Line Hover Color', 'cynic'),
        'settings' => 'cynic_theme[section_tab_bottom_border_line_hover_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[section_tab_border_color_top]',
    array(
        'default' => '#5c81fa',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_border_color_top]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Tab Border Color (Top)', 'cynic'),
        'settings' => 'cynic_theme[section_tab_border_color_top]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[section_tab_border_color_bottom]',
    array(
        'default' => '#39a8fe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_border_color_bottom]',
    array(
        'description' => esc_html__('Tab Border Color (Bottom)', 'cynic'),
        'settings' => 'cynic_theme[section_tab_border_color_bottom]',
        'section' => 'cynic_theme_general_variations',
    )
));




// Section Nav Tab Hover background Color
$wp_customize->add_setting('cynic_theme[section_tab_hover_bg_color_top]',
    array(
        'default' => '#eef7fe',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_hover_bg_color_top]',
    array(
        'label'=>'<hr>',
        'description' => esc_html__('Tab Active Background Color (Top)', 'cynic'),
        'settings' => 'cynic_theme[section_tab_hover_bg_color_top]',
        'section' => 'cynic_theme_general_variations',
    )
));


$wp_customize->add_setting('cynic_theme[section_tab_hover_bg_color_bottom]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[section_tab_hover_bg_color_bottom]',
    array(
        'description' => esc_html__('Tab Active Background Color (Bottom)', 'cynic'),
        'settings' => 'cynic_theme[section_tab_hover_bg_color_bottom]',
        'section' => 'cynic_theme_general_variations',
    )
));




// body Background Color
$wp_customize->add_setting('cynic_theme[body_background_color]',
    array(
        'default' => '#ffffff',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_theme[body_background_color]',
    array(
        'label'=>'Background <hr>',
        'description' => esc_html__('Body Background Color', 'cynic'),
        'settings' => 'cynic_theme[body_background_color]',
        'section' => 'cynic_theme_general_variations',
    )
));

$wp_customize->add_setting('cynic_theme[body_background_image]',
    array(

        'default' => CYNIC_THEME_URI.'/images/mainbg-bottom.png',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' =>'esc_url_raw'
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'cynic_theme[body_background_image]',
    array(
        'description' => esc_html__('Body Background Image', 'cynic'),
        'settings' => 'cynic_theme[body_background_image]',
        'section' => 'cynic_theme_general_variations',
    )
));





















