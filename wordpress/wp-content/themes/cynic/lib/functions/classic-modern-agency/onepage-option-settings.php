    <?php

    //1. Define a new section (if desired) to the Theme Customizer
    $wp_customize->add_section('cynic_theme_options', array(
        'title' => esc_html__('General Colors', 'cynic'), //Visible title of section
        'priority' => 35, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => esc_html__('Allows you to customize the theme.', 'cynic'), //Descriptive tooltip
            )
    );

    // Alpha Color Picker setting.
	$wp_customize->add_setting(
		'image_overlay_color',
		array(
			'default'     => 'rgba(255,255,255,0.9)',
			'type'        => 'theme_mod',
			'capability'  => 'edit_theme_options',
			'transport'   => 'refresh'
		)
	);

	// Alpha Color Picker control.
	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'alpha_color_control',
			array(
				'label'         => __( 'Image Overlay Color', 'cynic' ),
				'section'       => 'cynic_theme_options',
				'settings'      => 'image_overlay_color',
				'show_opacity'  => true, // Optional.
				'palette'	=> array(
					'rgba(0,0,0,0.5)', // Mix of color types = no problem
					'rgba(255,255,255,0.9)', // Different spacing = no problem
					'rgb(150, 50, 220, 0.8)', // RGB, RGBa, and hex values supported
					'rgba(50,50,50,0.8)',
				)
			)
		)
	);
    // headings text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[heading_textcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[heading_textcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Section Headings Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[heading_textcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //Sub headings text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[subheading_textcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[subheading_textcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Section Sub Headings Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[subheading_textcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // body text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[body_textcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[body_textcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Body Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[body_textcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // link color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[link_textcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[link_textcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Link Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[link_textcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // link hover color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[link_hover_textcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[link_hover_textcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Link Hover Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[link_hover_textcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // common active color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[common_active_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[common_active_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Link Active Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[common_active_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[slider_heading_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#ffffff', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[slider_heading_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Revolution Slider Heading Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[slider_heading_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[slider_sub_heading_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#c8c8c8', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //2. To change the Case study carousel body text color
    $wp_customize->add_setting('cynic_theme[case_study_carousel_heading_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#008ccb', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[case_study_carousel_heading_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Case Study Carousel Heading Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[case_study_carousel_heading_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. To change the Case study carousel body text color
    $wp_customize->add_setting('cynic_theme[case_study_carousel_body_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[case_study_carousel_body_text_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Case Study Carousel Body Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[case_study_carousel_body_text_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. To change Carousel link text and icon color
    $wp_customize->add_setting('cynic_theme[case_study_carousel_link_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#90c404', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
        $wp_customize, //Pass the $wp_customize object (required)
        'cynic_theme[case_study_carousel_link_color]', //Set a unique ID for the control
        array(
            'label' => esc_html__('Case Study Carousel Link Text Color', 'cynic'), //Admin-visible name of the control
            'settings' => 'cynic_theme[case_study_carousel_link_color]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
            'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
        )
    ));

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[slider_sub_heading_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Revolution Slider Subheading Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[slider_sub_heading_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));


    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[social_icon_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#c1c1c1', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[social_icon_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Social Icons Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[social_icon_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[social_icon_hv_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[social_icon_hv_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Social Icons Hover Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[social_icon_hv_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[featured_ribbon_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[featured_ribbon_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Featured Ribbon Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[featured_ribbon_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[global_sub_title]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#777777', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[global_sub_title]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Global Sub Title & Placeholder Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[global_sub_title]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_theme_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //1. Define a new section (if desired) to the Theme Customizer
    $wp_customize->add_section('cynic_header_colors', array(
        'title' => esc_html__('Header Colors', 'cynic'), //Visible title of section
        'priority' => 35, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => esc_html__('Allows you to customize the theme.', 'cynic'), //Descriptive tooltip
            )
    );
    // header background color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[header_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#fff', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[header_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Header Background Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[header_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_header_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    //header top background
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[header_top_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#f5f6f7', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[header_top_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Header Top Bar Background Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[header_top_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_header_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // Menu Parent Item Color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[menu_parent_linkcolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[menu_parent_linkcolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Menu Parent Item Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[menu_parent_linkcolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_header_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // Menu Parent Item Hover Color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[menu_parent_linkhovercolor]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#444444', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[menu_parent_linkhovercolor]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Menu Parent Item Hover Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[menu_parent_linkhovercolor]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_header_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // Menu Parent Item Hover Border Color

    //1. Define a new section (if desired) to the Theme Customizer
    $wp_customize->add_section('cynic_button_colors', array(
        'title' => esc_html__('Button Colors', 'cynic'), //Visible title of section
        'priority' => 35, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => esc_html__('Allows you to customize the theme.', 'cynic'), //Descriptive tooltip
            )
    );

    // button background color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[button_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    $wp_customize->add_setting('button_radius', array(
        'default' => '1',
        'transport' => 'refresh',
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Customizer_Range_Value_Control($wp_customize, 'button_radius', array(
        'type' => 'range-value',
        'section' => 'cynic_button_colors',
        'settings' => 'button_radius',
        'label' => esc_html__('Border Radius', 'cynic'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
            'step' => 1,
            'suffix' => 'px', //optional suffix
        ),
    )));

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[button_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Fill Button Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[button_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // button text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[button_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#ffffff', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[button_text_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Fill Button Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[button_text_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // button hover background color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[button_hv_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[button_hv_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Fill Button Hover Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[button_hv_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // button hover text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[button_hv_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[button_hv_text_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Fill Button Hover Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[button_hv_text_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));


    // no fill button border color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[tp_button_bdr_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[tp_button_bdr_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('No Fill Button Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[tp_button_bdr_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // no fill button text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[tp_button_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[tp_button_text_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('No Fill Button Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[tp_button_text_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // no fill button hover bg color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[tp_button_hv_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[tp_button_hv_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('No Fill Button Hover Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[tp_button_hv_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // no fill button hover text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[tp_button_hv_text_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#ffffff', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[tp_button_hv_text_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('No Fill Button Hover Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[tp_button_hv_text_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_button_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    //1. Define a new section (if desired) to the Theme Customizer
    $wp_customize->add_section('cynic_footer_colors', array(
        'title' => esc_html__('Footer Colors', 'cynic'), //Visible title of section
        'priority' => 35, //Determines what order this appears in
        'capability' => 'edit_theme_options', //Capability needed to tweak
        'description' => esc_html__('Allows you to customize the theme.', 'cynic'), //Descriptive tooltip
            )
    );


    // footer contact background color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[footer_contact_bg_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#0081c4', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[footer_contact_bg_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Contact Sidebar Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[footer_contact_bg_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_footer_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // footer text color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[footer_txt_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#9d9d9d', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[footer_txt_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Footer Text Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[footer_txt_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_footer_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));

    // footer link color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[footer_link_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#9d9d9d', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[footer_link_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Footer Link Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[footer_link_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_footer_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));
    // footer link hover color
    //2. Register new settings to the WP database...
    $wp_customize->add_setting('cynic_theme[footer_link_hover_color]', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
        'default' => '#53b778', //Default setting/value to save
        'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
        'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
        'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        'sanitize_callback' => 'sanitize_hex_color',
            )
    );

    //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
    $wp_customize->add_control(new WP_Customize_Color_Control(//Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'cynic_theme[footer_link_hover_color]', //Set a unique ID for the control
            array(
        'label' => esc_html__('Footer Link Hover Color', 'cynic'), //Admin-visible name of the control
        'settings' => 'cynic_theme[footer_link_hover_color]', //Which setting to load and manipulate (serialized is okay)
        'priority' => 10, //Determines the order this control appears in for the specified section
        'section' => 'cynic_footer_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            )
    ));