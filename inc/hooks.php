<?php
/**
 * Functions used as hook
 *
 * @package Epsilon
 */

// remove generator meta in <head>
remove_action('wp_head', 'wp_generator');

// hide admin bar in front end
function eps_disable_admin_bar( $show_admin_bar ) {
	global $epsilon_opt;

	if ( !empty( $epsilon_opt['disable_admin_bar'] ) ) {
		return false;
	}

	return $show_admin_bar;
}
add_filter( 'show_admin_bar', 'eps_disable_admin_bar', 10, 1 );

/*
 * This function use to send mails with html tags
 * https://codex.wordpress.org/Plugin_API/Filter_Reference/wp_mail_content_type
 *
 * If you use wp_mail and want to send the mail in HTML format then use
 * add_filter( 'wp_mail_content_type', 'set_html_content_type' ); before wp_mail and
 * remove_filter( 'wp_mail_content_type', 'set_html_content_type' ); after wp_mail
 */
function set_html_content_type() {
	return 'text/html';
}

// Password Form for Password Protected posts
function eps_pass_protected_form() {
    global $post;

    $input_id = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

	$form  = '<form class="form-inline" action="' . esc_url( wp_login_url() . '?action=postpass' ) . '" method="post">'
		   . '	<p>' . __( 'This content is password protected. To view it please enter your password below:', 'epsilon' ) . '</p>'
		   . '	<div class="form-group">'
		   . '		<label for="' . $input_id . '">' . __( 'Password:', 'epsilon' ) . '</label>'
		   . '		<div class="input-group">'
		   . '			<input type="password" class="form-control" id="' . $input_id . '" name="post_password">'
		   . '			<span class="input-group-btn">'
		   . '				<button class="btn btn-primary" type="submit" name="Submit">' . esc_attr__( 'Submit', 'epsilon' ) . '</button>'
		   . '			</span>'
		   . '		</div>'
		   . '	</div>'
		   . '</form>';


    return $form;
}
add_filter( 'the_password_form', 'eps_pass_protected_form' );
