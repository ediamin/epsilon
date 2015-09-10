<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Epsilon
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// include the custom walker class
require_once EPS_INC_PATH . '/class-custom-comment-walker.php';
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'epsilon' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'epsilon' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'epsilon' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'epsilon' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> '56',
					'max_depth'  => 2,
					'walker'	 => new EPS_Comment_Walker(),
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'epsilon' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'epsilon' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'epsilon' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'epsilon' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$comments_args = array(
			'label_submit'			=>	'Submit Comment',
			'class_submit' 			=>	'btn btn-primary',
			'title_reply'			=>	'Leave a Comment',
			'logged_in_as'			=>	'<div class="col-md-12 margin-bottom-15 logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' =>  array(
				'author' =>
				'<div class="col-md-4">' .
					'<div class="input-group margin-bottom-15">' .
						'<span class="input-group-addon" id="author-input"><i class="fa fa-user"></i></span>' .
						'<input type="text" name="author" class="form-control" id="author" placeholder="' . __( 'Name', 'epsilon' ) . '" aria-describedby="author-input" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '>' .
					'</div>' .
				'</div>',

				'email' =>
				'<div class="col-md-4">' .
					'<div class="input-group margin-bottom-15">' .
						'<span class="input-group-addon" id="email-input"><i class="fa fa-envelope"></i></span>' .
						'<input type="text" name="email" class="form-control" id="email" placeholder="' . __( 'Email', 'epsilon' ) . '" aria-describedby="email-input" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '>' .
					'</div>' .
				'</div>',

				'url' =>
				'<div class="col-md-4">' .
					'<div class="input-group margin-bottom-15">' .
						'<span class="input-group-addon" id="url-input"><i class="fa fa-globe"></i></span>' .
						'<input type="url" name="url" class="form-control" id="url" placeholder="' . __( 'Website', 'epsilon' ) . '" aria-describedby="url-input" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30">' .
					'</div>' .
				'</div>',
			),

			'comment_field' =>
			'<div class="col-md-12 margin-bottom-15">' .
				'<textarea name="comment" class="form-control" id="comment" cols="30" rows="10" aria-required="true" placeholder="' . _x( 'Comment', 'epsilon' ) . '"></textarea>' .
			'</div>',
		);

		comment_form( $comments_args );
	?>

</div><!-- #comments -->
