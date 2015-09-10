<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Epsilon
 */

global $epsilon_opt;

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if ( !empty( $epsilon_opt['favicon']['id'] ) ): ?>
<link rel="icon" href="<?php echo get_image_url( $epsilon_opt['favicon']['id'] ); ?>">
<?php endif; ?>

<?php wp_head(); ?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php if ( !empty( $epsilon_opt['integration_css'] ) ): ?>
<style type="text/css">
	<?php echo $epsilon_opt['integration_css']; ?>
</style>
<?php endif; ?>

<?php if ( !empty( $epsilon_opt['integration_head'] ) ): ?>
<?php echo $epsilon_opt['integration_head']; ?>
<?php endif; ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

    <header id="site-header" role="banner">

		<nav class="navbar navbar-default" id="site-navigation" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php if ( !empty( $epsilon_opt['logo']['id'] ) ): ?>
					<a id="site-logo" class="navbar-brand" href="<?php echo site_url( '/' ); ?>">
						<img src="<?php echo get_image_url( $epsilon_opt['logo']['id'] ); ?>" alt="<?php echo bloginfo( 'name' ); ?>">
					</a><!-- #site-logo -->
					<?php else: ?>
					<a id="site-logo" class="navbar-brand no-logo-image" href="<?php echo site_url( '/' ); ?>"><?php echo bloginfo( 'name' ); ?></a><!-- #site-logo -->
					<?php endif; ?>
				</div>

				<div class="collapse navbar-collapse" id="primary-navbar-collapse">
					<?php
						// primary menu
						$defaults = array(
							'theme_location'	=> 'primary',
							'menu'				=> '',
							'container'			=> null,
							'menu_class'		=> 'nav navbar-nav',
							'menu_id'			=> 'primary-menu',
							'depth'				=> 2,
							'walker'			=> new wp_bootstrap_navwalker(),
							'fallback_cb'		=> 'wp_bootstrap_navwalker::fallback',
						);

						wp_nav_menu( $defaults );
					?>
				</div><!-- .navbar-collapse -->
			</div><!-- .container -->
		</nav><!-- #site-navigation -->

	</header><!-- #site-header -->

	<?php if ( is_front_page() ): ?>
		<?php if ( !empty( $epsilon_opt['banner_carousel'] ) && ( 'banner' === $epsilon_opt['banner_carousel'] ) && !empty( $epsilon_opt['banner_content'] ) ): ?>
		<div id="banner">
			<div class="container">
				<?php echo wpautop( $epsilon_opt['banner_content'], true ); ?>
			</div>
		</div><!-- #banner -->
		<?php elseif( !empty( $epsilon_opt['banner_carousel'] ) &&
					( 'carousel' === $epsilon_opt['banner_carousel'] ) && ( !empty( $epsilon_opt['carousel'] ) ) ):

			$carousel = $epsilon_opt['carousel'];
		?>
		<div id="header-carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php foreach( $carousel as $i => $slide ): ?>
				<li data-target="#header-carousel" data-slide-to="<?php echo $i; ?>" class="<?php if ( 0 == $i ) echo 'active'; ?>"></li>
				<?php endforeach; ?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php foreach( $carousel as $i => $slide ): ?>
				<div class="item <?php if ( 0 == $i ) echo 'active'; ?>">

					<?php if ( !empty( $slide['url'] ) ): ?>
					<a href="<?php echo $slide['url']; ?>">
					<?php endif; ?>

						<img src="<?php echo get_image_url( $slide['attachment_id'] ); ?>" alt="<?php if ( !empty( $slide['title'] ) ) echo $slide['title']; ?>">

					<?php if ( !empty( $slide['url'] ) ): ?>
					</a>
					<?php endif; ?>

					<?php if ( !empty( $slide['title'] ) ): ?>
					<div class="carousel-caption">
						<?php if ( !empty( $slide['url'] ) ): ?>
						<h3><a href="<?php echo $slide['url']; ?>"><?php echo $slide['title']; ?></a></h3>
						<?php else: ?>
						<h3><?php echo $slide['title']; ?></h3>
						<?php endif; ?>

						<?php if ( !empty( $slide['description'] ) ): ?>
						<p><?php echo $slide['description']; ?></p>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#header-carousel" role="button" data-slide="prev">
				<span class="fa fa-chevron-left icon-prev" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#header-carousel" role="button" data-slide="next">
				<span class="fa fa-chevron-right icon-next" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<?php endif; ?>
	<?php endif; ?>
