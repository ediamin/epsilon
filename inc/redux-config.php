<?php
/**
* ReduxFramework Config File
*
* @package Epsilon
*/

if ( ! class_exists( 'Redux' ) ) {
	return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "epsilon_opt";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
	'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-admin-generic',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => 'dashicons-admin-generic',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => 'epsilon-options',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 *
 * ---> START SECTIONS
 *
 */

// Global Settings
Redux::setSection( $opt_name, array(
	'title'     => __( 'Global Settings', 'epsilon' ),
	'icon'      => 'el-icon-globe',
	'fields'    => array(
		array(
			'id'        => 'logo',
			'type'      => 'media',
			'title'     => __( 'Site Logo', 'epsilon' ),
			'mode'      => false,
		),
		array(
			'id'        => 'favicon',
			'type'      => 'media',
			'title'     => __( 'Favicon', 'epsilon' ),
			'mode'      => false,
		),
		array(
			'id'       => 'footer_text',
			'type'     => 'editor',
			'title'    => __( 'Footer Text', 'epsilon' ),
			'subtitle' => __( 'This text will apear in footer', 'epsilon' ),
			'default'  => '<a href="https://wordpress.org/">Proudly powered by WordPress</a> <span class="sep"> | </span> Theme: Epsilon by <a href="http://ediamin.com/" rel="designer">Edi Amin</a>',
		),
		array(
			'id'       => 'disable_admin_bar',
			'type'     => 'switch',
			'title'    => __( 'Admin Bar in front-end', 'epsilon' ),
			'subtitle' => __( 'Enable/Disable WordPress Admin Bar for all users in the front-end.', 'epsilon' ),
			'default'  => false,
			'on'	   => 'Disable',
			'off'	   => 'Enable',
		),
		array(
			'id'       => 'dev_mode',
			'type'     => 'switch',
			'title'    => __( 'Dev Mode', 'epsilon' ),
			'subtitle' => __( 'Theme development Mode. Turn it Off in production.', 'epsilon' ),
			'default'  => true,
		),
	)
) );

// Banner/Carousel
Redux::setSection( $opt_name, array(
	'title'     => __( 'Banner/Carousel', 'epsilon' ),
	'icon'      => 'el-icon-screen',
	'fields'    => array(
		array(
			'id'       => 'banner_carousel',
			'type'     => 'button_set',
			'title'    => __( 'Banner or Carousel', 'epsilon' ),
			'subtitle' => __( 'Use a Banner or a Carousel', 'epsilon' ),
			'options'  => array(
				'banner' => 'Banner',
				'carousel' => 'Carousel',
				'none' => 'None'
			),
			'default'  => 'banner'
		),
		array(
			'id'       => 'banner_content',
			'type'     => 'editor',
			'title'    => 'Banner Content',
			'required' => array( 'banner_carousel', '=', 'banner' ),
			'default'  => '<div class="text-center"><h1>Epsilon</h1><h3>A starter theme for WordPress based on _s</h3></div>',
			'args'     => array(
				'textarea_rows'	=> 15
			)
		),
		array(
			'id'          => 'carousel',
			'type'        => 'slides',
			'title'       => __( 'Carousel Slides', 'epsilon' ),
			'subtitle'    => __( 'Generates a bootstrap carousel', 'epsilon' ),
			'placeholder' => array(
				'title'       => __( 'Title', 'epsilon' ),
				'description' => __( 'Description', 'epsilon' ),
				'url'         => __( 'URL', 'epsilon' ),
			),
			'required' => array( 'banner_carousel', '=', 'carousel' ),
		),
	)
) );

// Social Links
Redux::setSection( $opt_name, array(
	'title'     => __( 'Social Links', 'epsilon' ),
	'desc'      => __( 'Insert full url of your social links', 'epsilon' ),
	'icon'      => 'el-icon-twitter',
	'fields'    => array(
		array(
			'id'       => 'social_active',
			'type'     => 'sortable',
			'mode'     => 'checkbox', // checkbox or text
			'title'    => __( 'Active Links', 'epsilon' ),
			'subtitle' => __( 'Add your links in text boxes below, then check it here. You can leave your links in boxes but switch off from here.', 'epsilon' ),
			'desc'	   => __( 'You can use <i class="el el-icon-move icon-large"></i> icon to sort the position of the social icons', 'epsilon' ),

			//Must provide key => value pairs for multi checkbox options
			'options'  => array(
				'facebook' => 'Facebook',
				'twitter' => 'Twitter',
				'google-plus' => 'Google+',
				'linkedin' => 'LinkedIn',
				'youtube' => 'Youtube',
				'flickr' => 'Flickr',
				'pinterest' => 'Pinterest',
				'behance' => 'Behance',
				'dribbble' => 'Dribbble',
				'envelope' => 'Email',
			),

			//See how default has changed? you also don't need to specify opts that are 0.
			'default' => array(
				'facebook' => 0,
				'twitter' => 0,
				'google-plus' => 0,
				'linkedin' => 0,
				'youtube' => 0,
				'flickr' => 0,
				'pinterest' => 0,
				'behance' => 0,
				'dribbble' => 0,
				'envelope' => 0,
			),
		),
		array(
			'id'      => 'facebook_link',
			'type'    => 'text',
			'title'   => __( 'Facebook', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'twitter_link',
			'type'    => 'text',
			'title'   => __( 'Twitter', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'google-plus_link',
			'type'    => 'text',
			'title'   => __( 'Google+', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'linkedin_link',
			'type'    => 'text',
			'title'   => __( 'LinkedIn', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'youtube_link',
			'type'    => 'text',
			'title'   => __( 'Youtube', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'flickr_link',
			'type'    => 'text',
			'title'   => __( 'Flickr', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'pinterest_link',
			'type'    => 'text',
			'title'   => __( 'Pinterest', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'behance_link',
			'type'    => 'text',
			'title'   => __( 'Behance', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'dribbble_link',
			'type'    => 'text',
			'title'   => __( 'Dribbble', 'epsilon' ),
			'default' => '#',
		),
		array(
			'id'      => 'envelope_link',
			'type'    => 'text',
			'title'   => __( 'Email', 'epsilon' ),
			'default' => '#',
		),
	)
) );

// Theme Integration
Redux::setSection( $opt_name, array(
	'title'     => __( 'Integration', 'epsilon' ),
	'desc'      => __( 'These options will place in unformatted and unescaped plain text.', 'epsilon' ),
	'icon'      => 'el-icon-puzzle',
	'fields'    => array(
		array(
			'id'       => 'integration_css',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom CSS Code', 'epsilon' ),
			'mode'     => 'css',
			'theme'    => 'monokai',
			'desc'     => 'This code will place in &lt;head> tag inside a &lt;style> tag',
			'options'  => array(
				'fontSize' => 16,
			),
		),
		array(
			'id'       => 'integration_js',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom Javascript Code', 'epsilon' ),
			'mode'     => 'javascript',
			'theme'    => 'monokai',
			'desc'     => 'This code will place just before closing &lt;body> tag inside a &lt;script> tag',
			'options'  => array(
				'fontSize' => 16,
			),
		),
		array(
			'id'       => 'integration_head',
			'type'     => 'textarea',
			'title'    => __( 'Code before &lt;/head> tag', 'epsilon' ),
			'description' => __( 'This code will be added before the &lt;/head> tag.', 'epsilon' ),
		),
		array(
			'id'       => 'integration_body',
			'type'     => 'textarea',
			'title'    => __( 'Code before &lt;/body> tag', 'epsilon' ),
			'description' => __( 'This code will be added before the &lt;/body> tag.', 'epsilon' ),
		),
	)
) );

/*
 * <--- END SECTIONS
 */
