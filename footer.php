<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Epsilon
 */

global $epsilon_opt;
?>
	<footer id="site-footer" role="contentinfo">

		<?php get_sidebar('footer'); ?>

		<?php if ( !empty( $epsilon_opt['footer_text'] ) || has_nav_menu( 'footer' ) ): ?>
		<div class="site-info">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 site-info-column">
						<?php echo $epsilon_opt['footer_text']; ?>
					</div>

					<?php if ( has_nav_menu( 'footer' ) ): ?>
					<div class="col-sm-6 site-info-column">
						<?php
							$args = array(
								'theme_location'  => 'footer',
								'menu'            => '',
								'container'       => null,
								'menu_class'      => 'list-inline pull-right-sm',
								'menu_id'         => 'footer-menu',
								'depth'           => 1,
							);

							wp_nav_menu( $args );
						?>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div><!-- .site-info -->
		<?php endif; ?>

	</footer><!-- #site-footer -->

<?php wp_footer(); ?>

<?php if ( !empty( $epsilon_opt['integration_js'] ) ): ?>
<script type="text/javascript">
	<?php echo $epsilon_opt['integration_js']; ?>
</script>
<?php endif; ?>

<?php if ( !empty( $epsilon_opt['integration_body'] ) ): ?>
<?php echo $epsilon_opt['integration_body']; ?>
<?php endif; ?>

</body>
</html>
