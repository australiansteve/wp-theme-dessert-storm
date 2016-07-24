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
	
	<div data-sticky-container class="header">
		<div class="title-bar" data-sticky data-options="marginTop:0;" style="width:100%">
			<div class="title-bar-left">
				<h1 class="site-title">
					<a href="<?php esc_attr_e( home_url( '/' ) ); ?>" rel="home">
						<?php 
						if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
							the_custom_logo();
						}
						else {
							?>
							<h1>
								<?php
								bloginfo( 'name' );
								?>
							</h1>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php
						}
		 				?>
					</a>
				</h1>
			</div>
			<div class="title-bar-right show-for-medium-only" id="medium-menu-container">
				<ul class="dropdown menu align-right" data-dropdown-menu>
					<li>
						<a href="#">Menu</a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu' ) ); ?>
					</li>
				</ul>
			</div>
			<div class="title-bar-right show-for-large" id="large-menu-container">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
			</div>
		</div>
	</div>
    
	<div class="row columns show-for-small-only" id="small-menu-container">
		<ul class="vertical menu" data-accordion-menu>
			<li>
				<a href="#">Menu</a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>
			</li>
		</ul>
	</div>

	<div id="content" class="site-content">
