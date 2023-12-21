<?php
/***
 * ### Menu Color Includes below color settings :
 * ### Top Menu Color
 * ### Primary Menu Color
 * ### Footer Menu Color
 */

$wp_customize->add_section('cynic_theme_menu_color_variations',
    array(
        'title' => __('Menu Colors', 'cynic'), //Visible title of section
        'priority' => 1, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => __('Allows you to customize header section.', 'cynic'), //Descriptive tooltip
    )
);


/**
 *
 * ### Top Menu Color Setting:
 *
 */

if (cynic_top_menu_EnableDisable()) {

// Header Top Menu Background Color
    $wp_customize->add_setting('cynic_theme[header_top_menu_parent_item_color]',
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
        'cynic_theme[header_top_menu_parent_item_color]',
        array(
            'label' => 'Top Menu: <hr class="hr2">',
            'description' => esc_html__('Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_parent_item_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_parent_item_text_hover_color]',
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
        'cynic_theme[header_top_menu_parent_item_text_hover_color]',
        array(
            'description' => esc_html__('Menu Text Hover/Active Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_parent_item_text_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_top_menu_parent_item_font_size]', array(
        'default' => '38',
        'transport' => 'refresh',
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize,
        'cynic_theme[header_top_menu_parent_item_font_size]', array(
            'type' => 'range-value',
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_parent_item_font_size]',
            'label' => esc_html__('Menu Font Size', 'cynic'),
            'input_attrs' => array(
                'min' => 8,
                'max' => 200,
                'step' => 1,
                'suffix' => 'px', //optional suffix
            ),
        )));

    //Sub Menu

    $wp_customize->add_setting('cynic_theme[header_top_menu_child_item_color]',
        array(
            'default' => '#212529',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_top_menu_child_item_color]',
        array(
            'description' => esc_html__('Sub Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_child_item_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_child_item_text_hover_color]',
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
        'cynic_theme[header_top_menu_child_item_text_hover_color]',
        array(
            'description' => esc_html__('Sub Menu Text Hover/Active Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_child_item_text_hover_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_child_item_font_size]', array(
        'default' => '24',
        'transport' => 'refresh',
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize,
        'cynic_theme[header_top_menu_child_item_font_size]', array(
            'type' => 'range-value',
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_child_item_font_size]',
            'label' => esc_html__('Sub Menu Font Size', 'cynic'),
            'input_attrs' => array(
                'min' => 8,
                'max' => 200,
                'step' => 1,
                'suffix' => 'px', //optional suffix
            ),
        )));

    $wp_customize->add_setting('cynic_theme[header_top_menu_close_icon_color]',
        array(
            'default' => '#979797',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_top_menu_close_icon_color]',
        array(
            'description' => esc_html__('Close Icon Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_close_icon_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_close_icon_hover_color]',
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
        'cynic_theme[header_top_menu_close_icon_hover_color]',
        array(
            'description' => esc_html__('Close Icon Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_close_icon_hover_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_right_border_color]',
        array(
            'default' => '#eeeeee',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_top_menu_right_border_color]',
        array(
            'description' => esc_html__('Menu Right Border Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_right_border_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_top_menu_right_scroller_bar_color]',
        array(
            'default' => '#fafafa',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_top_menu_right_scroller_bar_color]',
        array(
            'description' => esc_html__('Menu Scroller Bar Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_top_menu_right_scroller_bar_color]',
        )
    ));

    /**
     *
     * ### Classic Menu Color:
     *
     */


// Classic Menu Parent Item Color
    $wp_customize->add_setting('cynic_theme[header_classic_menu_parent_item_color]',
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
        'cynic_theme[header_classic_menu_parent_item_color]',
        array(
            'label' => 'Classic Menu: <hr class="hr2">',
            'description' => esc_html__('Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_parent_item_color]',
        )
    ));

// Classic Menu Parent Item Hover Color

    $wp_customize->add_setting('cynic_theme[header_classic_menu_parent_item_text_hover_color]',
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
        'cynic_theme[header_classic_menu_parent_item_text_hover_color]',
        array(
            'description' => esc_html__('Menu Text Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_parent_item_text_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_classic_menu_parent_item_line_hover_color]',
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
        'cynic_theme[header_classic_menu_parent_item_line_hover_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Menu Hover Upper Line Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_parent_item_line_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_classic_menu_parent_item_bg_hover_color]',
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_parent_item_bg_hover_color]',
        array(
            'description' => esc_html__('Menu Active Background Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_parent_item_bg_hover_color]',
        )
    ));

// Header Main Menu Background Color
    $wp_customize->add_setting('cynic_theme[header_classic_menu_background_color_left]',
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_background_color_left]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Menu Background Color (Left)', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_background_color_left]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_classic_menu_background_color_right]',
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_background_color_right]',
        array(
            'description' => esc_html__('Menu Background Color (Right)', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_background_color_right]',
        )
    ));


// Header Sub-menu

    $wp_customize->add_setting('cynic_theme[header_classic_menu_sub_item_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_classic_menu_sub_item_color]',
        array(
            'label' => 'Classic Sub Menu: <hr class="hr2">',
            'description' => esc_html__('Sub Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_sub_item_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_classic_menu_child_item_hover_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_classic_menu_child_item_hover_color]',
        array(
            'description' => esc_html__('Sub Menu Text Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_child_item_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_classic_menu_sub_item_border_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '#f6f6f6',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_sub_item_border_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Sub Menu Separator Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_sub_item_border_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_classic_menu_child_item_hover_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_child_item_hover_bg_color]',
        array(
            'description' => esc_html__('Sub Menu Active Background Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_child_item_hover_bg_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_classic_menu_sub_item_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_classic_menu_sub_item_bg_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Sub Menu Background Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_classic_menu_sub_item_bg_color]',
        )
    ));

} else {
    /**
     *
     * ### Modern Menu Color:
     *
     */


// Main Menu Parent Item Color
    $wp_customize->add_setting('cynic_theme[header_main_menu_parent_item_color]',
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
        'cynic_theme[header_main_menu_parent_item_color]',
        array(
            'label' => 'Main Menu: <hr class="hr2">',
            'description' => esc_html__('Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_parent_item_color]',
        )
    ));

// Main Menu Parent Item Hover Color

    $wp_customize->add_setting('cynic_theme[header_main_menu_parent_item_text_hover_color]',
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
        'cynic_theme[header_main_menu_parent_item_text_hover_color]',
        array(
            'description' => esc_html__('Menu Text Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_parent_item_text_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_main_menu_parent_item_line_hover_color]',
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
        'cynic_theme[header_main_menu_parent_item_line_hover_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Menu Hover Line Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_parent_item_line_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_main_menu_parent_item_bg_hover_color]',
        array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_main_menu_parent_item_bg_hover_color]',
        array(
            'description' => esc_html__('Menu Active Background Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_parent_item_bg_hover_color]',
        )
    ));

// Header Main Menu Background Color
    $wp_customize->add_setting('cynic_theme[header_main_menu_background_color_left]',
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
        'cynic_theme[header_main_menu_background_color_left]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Menu Background Color (Left)', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_background_color_left]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_main_menu_background_color_right]',
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
        'cynic_theme[header_main_menu_background_color_right]',
        array(
            'description' => esc_html__('Menu Background Color (Right)', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_background_color_right]',
        )
    ));


// Header Sub-menu

    $wp_customize->add_setting('cynic_theme[header_main_menu_sub_item_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_main_menu_sub_item_color]',
        array(
            'label' => 'Sub Menu: <hr class="hr2">',
            'description' => esc_html__('Sub Menu Text Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_sub_item_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_main_menu_child_item_hover_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_main_menu_child_item_hover_color]',
        array(
            'description' => esc_html__('Sub Menu Text Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_child_item_hover_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_main_menu_sub_item_border_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default' => '#f6f6f6',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'cynic_theme[header_main_menu_sub_item_border_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Sub Menu Separator Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_sub_item_border_color]',
        )
    ));


    $wp_customize->add_setting('cynic_theme[header_main_menu_child_item_hover_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_main_menu_child_item_hover_bg_color]',
        array(
            'description' => esc_html__('Sub Menu Active Background Hover Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_child_item_hover_bg_color]',
        )
    ));

    $wp_customize->add_setting('cynic_theme[header_main_menu_sub_item_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
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
        'cynic_theme[header_main_menu_sub_item_bg_color]',
        array(
            'label' => '<hr>',
            'description' => esc_html__('Sub Menu Background Color', 'cynic'),
            'section' => 'cynic_theme_menu_color_variations',
            'settings' => 'cynic_theme[header_main_menu_sub_item_bg_color]',
        )
    ));
}