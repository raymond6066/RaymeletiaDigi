<?php

add_action( 'tgmpa_register', 'cynic_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function cynic_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins_url = "http://axilthemes.com/";
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => esc_html__('Cynic Theme Features', 'cynic'), // The plugin name.
			'slug'               => 'cynic-features', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'source'             => $plugins_url . "themes/cynic/plugins/cynic-features.zip", // If set, overrides default API URL and points to an external URL.
		),
		array(
			'name'               => esc_html__('WPBakery Visual Composer', 'cynic'), // The plugin name.
			'slug'               => 'js_composer', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'source'             => $plugins_url . "themes/cynic/plugins/js_composer.zip", // If set, overrides default API URL and points to an external URL.
		),
		array(
			'name'               => esc_html__('Slider Revolution', 'cynic'), // The plugin name.
			'slug'               => 'revslider', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'source'             => $plugins_url . "themes/cynic/plugins/revslider.zip", // If set, overrides default API URL and points to an external URL.
		),
        array(
            'name'               => esc_html__('Meta Box Group', 'cynic'), // The plugin name.
            'slug'               => 'meta-box-group', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'source'             => $plugins_url . "themes/cynic/plugins/meta-box-group.zip", // If set, overrides default API URL and points to an external URL.
        ),
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => esc_html__('Redux Framework', 'cynic'),
			'slug'      => 'redux-framework',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('Meta Box', 'cynic'),
			'slug'      => 'meta-box',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('Contact Form 7', 'cynic'),
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('MailChimp for WordPress', 'cynic'),
			'slug'      => 'mailchimp-for-wp',
			'required'  => true,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'cynic',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	
	tgmpa( $plugins, $config );
	
}