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

<?php echo file_get_contents( get_template_directory() . '/assets/dist/sprite/sprite.svg' ); 


	$fixedBackground = get_theme_mod('austeve_background_fixed', 'fixed');
	$backgrounds = get_theme_mod('austeve_backgrounds', 0);

	if ($fixedBackground == 'fixed') 
	{
	?>


	<div id="background-div" class="fixed">
	<?php
	for ($b = 0; $b < $backgrounds; $b++) {
		echo '<div id="bgImage'.($b+1).'" class="bgImage">&nbsp;</div>';
	}
	?>
	</div>
	
	<div id="page">

<?php 
	}
	else {
		//Scrolling
		?>

	<div id="background-div" class="scrolling">
		<?php
	for ($b = 0; $b < $backgrounds; $b++) {
		echo '<div id="bgImage'.($b+1).'" class="bgImage">&nbsp;</div>';
	}
	?>

		<div id="page">
		<?php
	}

	$menuLayout = get_theme_mod('austeve_menu_layout', 'topbar-right');

	if ($menuLayout == 'topbar-right') 
	{

?>				
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

				<div class="title-bar-right show-for-medium" id="medium-menu-container">

					<div class="secondary-navigation">
						<ul class="vertical medium-horizontal menu">

						<?php if(is_user_logged_in()): ?>

							<?php if(current_user_can('mepr-active','rule: '.MEPR_REGISTERED_RULE)): ?>
								<?php 
								 	$args = array (
									 	'theme_location' 	=> 'logged-in-registered',
									 	'container' 		=> '',
									 	'menu_class' 		=> '',
									 	'menu_id' 			=> '',
									 	'items_wrap' 		=> '%3$s'
								 	);
									wp_nav_menu( $args );
								?>
							<?php else: ?>

							<?php 
							 	$args = array (
								 	'theme_location' 	=> 'logged-in-account',
								 	'container' 		=> '',
								 	'menu_class' 		=> '',
								 	'menu_id' 			=> '',
								 	'items_wrap' 		=> '%3$s'
							 	);
								wp_nav_menu( $args );
							?>	
							<?php endif; ?>							

						<?php else: ?>	

							<?php 
							 	$args = array (
								 	'theme_location' 	=> 'logged-out-account',
								 	'container' 		=> '',
								 	'menu_class' 		=> '',
								 	'menu_id' 			=> '',
								 	'items_wrap' 		=> '%3$s'
							 	);
								wp_nav_menu( $args );
							?>

						<?php endif; ?>	

						
						</ul> 
					</div>

					<div class="primary-navigation">				
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
					</div>
				</div>

			</div>
		</div>
	    
		<div class="row columns show-for-small-only primary-navigation" id="small-menu-container">
			<ul class="vertical menu" data-accordion-menu>
				<li>
					<a href="#">Menu</a>
					<ul class="vertical menu">

						<?php
						 	$args = array (
							 	'theme_location' 	=> 'primary',
							 	'container' 		=> false,
							 	'menu_class' 		=> '',
							 	'menu_id' 			=> '',
							 	'items_wrap' 		=> '%3$s'
						 	);
							wp_nav_menu( $args );
						?>
					</ul>
					<ul class="vertical medium-horizontal menu show-for-small-only">
						<?php 
						 	$args = array (
							 	'theme_location' 	=> is_user_logged_in() ? 'logged-in-account': 'logged-out-account',
							 	'container' 		=> '',
							 	'menu_class' 		=> '',
							 	'menu_id' 			=> '',
							 	'items_wrap' 		=> '%3$s'
						 	);
							wp_nav_menu( $args );
						?>
					</ul> 

				</li>
			</ul>
		</div>
<?php 
	} /* End if ($menuLayout == 'top-bar-right') */
	else if ($menuLayout == 'none')
	{
?>
		<div class="header">
			<div class="title-bar">
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
			</div>
		</div>
<?php		
	}
?>

		<div id="content" class="site-content">
