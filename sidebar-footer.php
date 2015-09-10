<?php
/**
 * The footer widget area.
 *
 * @package Epsilon
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}
?>

<div id="footer-widgets" class="widget-area" role="complementary">
	<div class="container">
		<div class="row">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>
	</div>
</div><!-- #footer-widgets -->
