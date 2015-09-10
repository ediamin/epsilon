<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Epsilon
 */

/**
 * Image URL without any image tag
 *
 * @param string $image_id image id
 * @param string $size image size either a string keyword (thumbnail, medium, large or full)
 * 		  or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @return string image relative url
 */
if ( !function_exists( 'get_image_url' ) ):
function get_image_url( $image_id, $size = 'full' ) {
	$image_id = absint( $image_id );

	/**
	 * If image does not exists, then return nothing.
	 * You can set a default image instead for non-existing image
	 */
	$args = array(
		'p'	=> $image_id,
		'post_type' => 'attachment',
		'fields' => 'ids',

	);
	$attachment = new WP_Query( $args );

	if ( $attachment->have_posts() ) {
		$url_array = wp_get_attachment_image_src( $image_id, $size, true );
		$url = $url_array[0];

	} else {
		$url = null;
	}

	/* Restore original Post Data */
	wp_reset_postdata();

	return $url;
}
endif;

/*
 * custom pagination with bootstrap .pagination class
 * source: http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
 */
function bootstrap_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('« Prev'),
			'next_text'    => __('Next »'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination  = '<nav class="navigation posts-navigation text-center" role="navigation">';
		$pagination .= '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li>$page</li>";
		}

		$pagination .= '</ul></nav>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}

/**
 * Generate Bootstrap 3.0+ compatible alert box markup
 *
 * @return string HTML markup
 **/
if ( !function_exists( 'get_alert' ) ):
	function get_alert( $msg, $type = 'error', $dismissible = false ) {
		if ( empty( $msg ) ) return null;

		switch ( $type ) {
			case 'success':
				$class = 'success';
				$prefix = null;
				break;

			case 'info':
				$class = 'info';
				$prefix = null;
				break;

			case 'warning':
				$class = 'warning';
				$prefix = '<strong>Warning: </strong>';
				break;

			case 'danger':
			case 'error':
			default:
				$prefix = '<strong>Error: </strong>';
				$class = 'danger';
				break;
		}

		if ( $dismissible ) {
			$class .= ' alert-dismissible';
		}

		ob_start();
	?>
		<div class="alert alert-<?php echo $class ?>" role="alert">
			<?php if ( $dismissible ): ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php endif; ?>

			<?php echo $prefix . $msg; ?>

		</div>
	<?php
		$alert = ob_get_contents();
		ob_get_clean();

		return $alert;
	}
endif;
