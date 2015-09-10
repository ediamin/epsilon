<?php
/**
 * Search Form
 *
 * @package Epsilon
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
	<div class="input-group">
		<input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'epsilon' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'epsilon' ); ?>" />
		<span class="input-group-btn">
			<button class="btn btn-primary" type="submit"><?php echo esc_attr_x( 'Search', 'submit button', 'epsilon' ); ?></button>
		</span>
	</div><!-- .input-group -->
</form>
