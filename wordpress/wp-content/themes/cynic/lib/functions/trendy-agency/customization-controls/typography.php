<?php
/* Typography Settings */
$wp_customize->add_panel('typography', array(
    'title' => 'Typography',
    'description' => 'Typography',
    'priority' => 19,
));

$wp_customize->add_section('font',
    array(
        'title' => __('Font', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline-font',
    array(
        'default' => '{"font":"Fira Sans","regularweight":"regular","italicweight":"italic",
        "boldweight":"900","category":"sans-serif"}',
        'sanitize_callback' => 'skyrocket_google_font_sanitization',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Google_Font_Select_Custom_Control(
    $wp_customize,
    'cynic_headline-font',
    array(
        'label' => __('Headline Font'),
        'description' => esc_html__('Specify the headline font (Fira Sans)'),
        'section' => 'font',
        'settings' => 'cynic_headline-font',
        'input_attrs' => array(
            'font_count' => 'all',
            'orderby' => 'alpha',
        ),
    )
));

$wp_customize->add_setting('cynic_body-font',
    array(
        'default' => '{"font":"Hind Vadodara","regularweight":"regular","italicweight":"italic",
        "boldweight":"regular","category":"sans-serif"}',
        'sanitize_callback' => 'skyrocket_google_font_sanitization',
        'transport' => 'refresh',
    )
);

$wp_customize->add_control(new Skyrocket_Google_Font_Select_Custom_Control(
    $wp_customize,
    'cynic_body-font',
    array(
        'label' => __('Body Font'),
        'description' => esc_html__('Specify the body font(Hind Vadodara)'),
        'section' => 'font',
        'settings' => 'cynic_body-font',
        'input_attrs' => array(
            'font_count' => 'all',
            'orderby' => 'alpha',
        ),
    )
));

$wp_customize->add_section('headline1',
    array(
        'title' => __('Headline 1', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline1-font-size',
    array(
        'default' => 6,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control($wp_customize, 'cynic_headline1-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline1',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline1-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline1-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline1',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline1-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline1-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline1',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline1-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline1-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline1',
        'settings' => 'cynic_headline1-font-color',
    )
));


/* Headline 2 Settings */

$wp_customize->add_section('headline2',
    array(
        'title' => __('Headline 2', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline2-font-size',
    array(
        'default' => 4.8,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline2-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline2',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline2-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline2-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline2',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline2-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline2-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline2',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline2-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_heading2-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline2',
        'settings' => 'cynic_headline2-font-color',
    )
));

/* Headline 3 Settings */

$wp_customize->add_section('headline3',
    array(
        'title' => __('Headline 3', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline3-font-size',
    array(
        'default' => 3.6,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline3-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline3',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline3-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline3-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline3',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline3-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline3-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline3',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline3-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline3-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline3',
        'settings' => 'cynic_headline3-font-color',
    )
));

/* Headline 4 Settings */

$wp_customize->add_section('headline4',
    array(
        'title' => __('Headline 4', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline4-font-size',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline4-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline4',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline4-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline4-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline4',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline4-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline4-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline4',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline4-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline4-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline4',
        'settings' => 'cynic_headline4-font-color',
    )
));

/* Headline 5 Settings */

$wp_customize->add_section('headline5',
    array(
        'title' => __('Headline 5', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline5-font-size',
    array(
        'default' => 2.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline5-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline5',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline5-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline5-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline5',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline5-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline5-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline5',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline5-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline5-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline5',
        'settings' => 'cynic_headline5-font-color',
    )
));

/* Headline 6 Settings */

$wp_customize->add_section('headline6',
    array(
        'title' => __('Headline 6', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_headline6-font-size',
    array(
        'default' => 1.8,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline6-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'headline6',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline6-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_headline6-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'headline6',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_headline6-line-height',
    array(
        'default' => 1.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_headline6-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'headline6',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_headline6-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_headline6-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'headline6',
        'settings' => 'cynic_headline6-font-color',
    )
));

/* Body 1 Settings */

$wp_customize->add_section('body1',
    array(
        'title' => __('Body 1', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_body1-font-size',
    array(
        'default' => 2.4,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body1-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'body1',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body1-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_body1-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'body1',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_body1-line-height',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body1-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'body1',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body1-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_body1-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'body1',
        'settings' => 'cynic_body1-font-color',
    )
));

/* Body 2 Settings */

$wp_customize->add_section('body2',
    array(
        'title' => __('Body 2', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_body2-font-size',
    array(
        'default' => 1.8,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body2-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'body2',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body2-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_body2-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'body2',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_body2-line-height',
    array(
        'default' => 1.8,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body2-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'body2',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body2-font-color', array(
    'default' => '#69798d',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_body2-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'body2',
        'settings' => 'cynic_body2-font-color',
    )
));

/* Body 2 Settings */

$wp_customize->add_section('body3',
    array(
        'title' => __('Body 3', 'cynic'), //Visible title of section
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'panel' => 'typography',
    )
);

$wp_customize->add_setting('cynic_body3-font-size',
    array(
        'default' => 1.6,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body3-font-size',
    array(
        'label' => esc_html__('Font Size'),
        'section' => 'body3',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body3-font-size-in',
    array(
        'default' => 'rem',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);

$wp_customize->add_control(new Skyrocket_Text_Radio_Button_Custom_Control(
    $wp_customize,
    'cynic_body3-font-size-in',
    array(
        'label' => __('Font Size In', 'cynic'),
        'section' => 'body3',
        'choices' => array(
            'rem' => __('rem'), // Required. Setting for this particular radio button choice and the text to display
            'px' => __('px'), // Required. Setting for this particular radio button choice and the text to display
            '%' => __('%'),// Required. Setting for this particular radio button choice and the text to display
            'em' => __('em') // Required. Setting for this particular radio button choice and the text to display
        )
    )
));

$wp_customize->add_setting('cynic_body3-line-height',
    array(
        'default' => 2.8,
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_sanitize_integer'
    )
);

$wp_customize->add_control(new Skyrocket_Slider_Custom_Control(
    $wp_customize,
    'cynic_body3-line-height',
    array(
        'label' => esc_html__('Line Height'),
        'section' => 'body3',
        'input_attrs' => array(
            "min" => 1,
            "step" => 1,
            "max" => 100,
        ),
    )
));

$wp_customize->add_setting('cynic_body3-font-color', array(
    'default' => '#172b43',
    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color'
));


$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'cynic_body3-font-color',
    array(
        'description' => esc_html__('Font Color', 'cynic'),
        'section' => 'body3',
        'settings' => 'cynic_body3-font-color',
    )
));

