<?php
/**
 * Epsilon functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Epsilon
 */

/**
 * Theme Constants
 */

// uri
define( 'EPS_TMPLT_DIR', get_template_directory_uri() );
define( 'EPS_ASSETS_DIR', EPS_TMPLT_DIR . '/assets' );
define( 'EPS_CSS_DIR', EPS_ASSETS_DIR . '/css' );
define( 'EPS_JS_DIR', EPS_ASSETS_DIR . '/js' );
define( 'EPS_IMG_DIR', EPS_ASSETS_DIR . '/images' );

// paths
define( 'EPS_TMPLT_PATH' , get_template_directory() );
define( 'EPS_INC_PATH' , EPS_TMPLT_PATH . '/inc' );


if ( ! function_exists( 'eps_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eps_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Epsilon, use a find and replace
	 * to change 'epsilon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'epsilon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'epsilon' ),
		'footer'  => esc_html__( 'Footer Menu', 'epsilon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'eps_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // eps_setup
add_action( 'after_setup_theme', 'eps_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eps_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eps_content_width', 640 );
}
add_action( 'after_setup_theme', 'eps_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eps_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'epsilon' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'epsilon' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="col-sm-4 widget %2$s footer-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'eps_widgets_init' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once EPS_INC_PATH . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'eps_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function eps_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'               => 'Redux Framework', // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		),

		// array(
		// 	'name'               => 'CMB2', // The plugin name.
		// 	'slug'               => 'cmb2', // The plugin slug (typically the folder name).
		// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		// ),

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
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
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

/**
 * Redux Configs
 */
require EPS_INC_PATH . '/redux-config.php';

/**
 * Custom Meta Box Configs
 */
// require EPS_INC_PATH . '/cmb-config.php';

/**
 * Custom Post Types and Taxonomies
 */
// require EPS_INC_PATH . '/custom-post-types-and-taxonomies.php';

/**
 * Enqueue scripts and styles.
 */
require EPS_INC_PATH . '/enqueue-scripts.php';

/**
 * A custom WordPress nav walker class to fully implement the
 * Bootstrap 3.0+ navigation style
 *
 * https://github.com/twittem/wp-bootstrap-navwalker
 */
require EPS_INC_PATH . '/wp_bootstrap_navwalker.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require EPS_INC_PATH . '/custom-functions.php';

/**
 * Custom template tags for this theme.
 */
require EPS_INC_PATH . '/template-tags.php';

/**
 * Functions used as hook
 */
require EPS_INC_PATH . '/hooks.php';
