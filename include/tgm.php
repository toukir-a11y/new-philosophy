<?php

require_once get_theme_file_path ('/libary/class-tgm-plugin-activation.php');


function acf_register_required_plugins() {

	$plugins = array(
		
		array(
			'name'      => 'ACF',
			'slug'      => 'advanced-custom-fields',
			'required'  => false,
		),	
		
		
		array(
			'name'      => 'attachments',
			'slug'      => 'attachments',
			'required'  => false,
		),		
	);
	


	$config = array(
		'id'           => 'philosophy',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'acf_register_required_plugins' );

