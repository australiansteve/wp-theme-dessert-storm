<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dessertstorm
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php echo file_get_contents( get_template_directory() . '/assets/dist/sprite/sprite.svg' ); ?>


	<div id="background-div">
		<div id="bgImage">&nbsp;</div>
	</div>
	
	<header id="masthead" class="" role="banner">
		<section class="row column">
			<h1 class="site-title">
				<a href="<?php esc_attr_e( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</section>
		<nav id="site-navigation" class="top-bar show-for-medium" data-topbar role="navigation">
			<section class="top-bar-section row column">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</section>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
