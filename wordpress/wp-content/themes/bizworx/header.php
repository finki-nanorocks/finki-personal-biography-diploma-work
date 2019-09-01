<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bizworx
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
  
  <?php do_action('bizworx_before_site'); ?>
	
    <header id="masthead"  class="site-header" role="banner">
		<div class="head-wrap banner-background">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php if ( get_theme_mod('custom_logo') ) : 
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo_src = wp_get_attachment_image_src( $custom_logo_id , 'full' );?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr ( bloginfo('name') ); ?>"><img class="site-logo" src="<?php echo esc_url( $logo_src[0] ); ?>" /></a>
						<?php else : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h1>
							<h2 class="site-description"><?php esc_html( bloginfo( 'description' ) ); ?></h2>	        
						<?php endif; ?>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="btn-menu"></div>
						<nav id="site-navigation" class="site-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
    </header>
	
	<div class="bizworx-banner-area">
		<?php bizworx_header_background(); ?>
		<?php bizworx_header_video(); ?>
	</div>
	
	<div id="content" class="page-wrap">
		<div class="content-wrapper container">
		<div class="row">