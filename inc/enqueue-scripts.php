<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Epsilon
 */

function eps_scripts() {
	global $epsilon_opt;

	/*
	 * When we are in dev mode, we should load the assets from server or
	 * localhost, otherwise load them from CDN when in production.
	 * Loading assets from localhost helps a lot, when you have no internet.
	 *
	 * wp_enqueue_style( $handle, $src, $deps, $ver, $media );
	 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	 */
	if ( !empty( $epsilon_opt['dev_mode'] ) ) {

		// fonts
		wp_enqueue_style( 'google-fonts', EPS_CSS_DIR . '/google-fonts.css', null, null );
		wp_enqueue_style( 'font-awesome', EPS_CSS_DIR . '/font-awesome.min.css' , null, '4.4.0' );

		// css
		wp_enqueue_style( 'bootstrap', EPS_CSS_DIR . '/bootstrap.min.css' , null, '3.3.5' );
		wp_enqueue_style( 'main-css', get_stylesheet_uri() , array( 'bootstrap' ), time() );

		// javascripts
		wp_enqueue_script( 'bootstrap', EPS_JS_DIR . '/bootstrap.min.js', array( 'jquery' ), '3.3.5', true );
		wp_enqueue_script( 'main-js', EPS_JS_DIR . '/script.js', array( 'jquery', 'bootstrap' ) , time(), true );

	} else {

		// fonts
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' , null, null );
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' , null, '4.4.0' );

		// css
		wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' , null, null );
		wp_enqueue_style( 'main-css', get_stylesheet_uri() , array( 'bootstrap' ), null );

		// javascripts
		wp_enqueue_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'main-js', EPS_JS_DIR . '/script.js', array( 'jquery', 'bootstrap' ) , null, true );
	}

	/*
	 * WP core assets overrides/removal.
	 */
	// remove emoji
	// remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	// remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// remove core jquery and include back
	// wp_deregister_script( 'jquery' );
	// if ( !empty( $epsilon_opt['dev_mode'] ) ) {
	// 	wp_enqueue_script( 'jquery', EPS_JS_DIR . '/jquery-2.1.4.min.js', null, '2.1.4', true );
	// } else {
	// 	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', null, '2.1.4', true );
	// }

}
add_action( 'wp_enqueue_scripts', 'eps_scripts' );
