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
<link href="https://fonts.googleapis.com/css?family=Cantata+One|Raleway:black|Roboto" rel="stylesheet">

<?php 
$sharing_image = get_theme_mod( 'dessertstorm_fb_image' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
if ($sharing_image)
{
	$image = $sharing_image;
	$image_size = getimagesize($image);
    $image_width = $image_size[0];
    $image_height = $image_size[1];
}
else 
{
	$image_raw = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$image = $image_raw[0];
    $image_width = $image_raw[1];
    $image_height = $image_raw[2];
}

//Formulate description
$description = get_bloginfo( 'description' );
if (strlen($description) > 0)
{
	$description .= ". ";
}
$description .= get_theme_mod( 'dessertstorm_fb_description' );

?>
<meta property="fb:app_id" content="" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo home_url(); ?>" />
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
<meta property="og:title" content="<?php bloginfo( 'name' ); ?>" />
<meta property="og:description" content="<?php echo $description; ?>" /> 
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:image:width" content="<?php echo $image_width; ?>">
<meta property="og:image:height" content="<?php echo $image_height; ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php echo file_get_contents( get_template_directory() . '/assets/dist/sprite/sprite.svg' ); 


	$fixedBackground = get_theme_mod('austeve_background_fixed', 'fixed');
	$backgrounds = get_theme_mod('austeve_backgrounds', 0);
	$onlyforhome = get_theme_mod('austeve_background_homeonly', false);
	$pageClasses = is_home() ? "homepage" : "";

	if ($fixedBackground == 'fixed') 
	{
	?>


	<div id="background-div" class="fixed">
	<?php
	for ($b = 0; $b < $backgrounds; $b++) {
		if (!$onlyforhome || is_home())
		{
			echo '<div id="bgImage'.($b+1).'" class="bgImage">&nbsp;</div>';
		}
	}
	?>
	</div>
	
	<div id="page" class="<?php echo $pageClasses; ?>">

<?php 
	}
	else {
		//Scrolling
		?>

	<div id="background-div" class="scrolling">
		<?php
	for ($b = 0; $b < $backgrounds; $b++) {
		if (!$onlyforhome || is_home())
		{
			echo '<div id="bgImage'.($b+1).'" class="bgImage">&nbsp;</div>';
		}	
	}
	?>

		<div id="page" class="<?php echo $pageClasses; ?>">
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

			
				<div class="title-bar-right show-for-medium-only primary-navigation" id="medium-menu-container">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
				</div>
				<div class="title-bar-right show-for-large primary-navigation" id="large-menu-container">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
				</div>
			</div>
		</div>
	    
		<div class="row columns show-for-small-only primary-navigation" id="small-menu-container">
			<ul class="vertical menu" data-accordion-menu>
				<li>
					<a href="#">Menu</a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>
				</li>
			</ul>
		</div>
<?php 
	} /* End if ($menuLayout == 'top-bar-right') */
	else if ($menuLayout == 'topbar-left') 
	{

?>				
		<div class="header">
			<div class="title-bar show-for-medium" data-options="marginTop:0;" style="width:100%">
  				<div class="title-bar-left primary-navigation">
					<ul class="dropdown menu primary-navigation" data-dropdown-menu>
						<li>
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
						</li>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'walker' => new AUSteve_Foundation_Dropdown_Nav_Menu() ) ); ?>
					</ul>
				
				</div>
			</div>
	    
			<div class="row columns show-for-small-only primary-navigation" id="small-menu-container">
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

				<ul class="vertical menu" data-accordion-menu>
					<li>
						<a href="#">Menu</a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>
					</li>
				</ul>
			</div>
		</div>
<?php 
	} /* End if ($menuLayout == 'top-bar-left') */
	else if ($menuLayout == 'centered-single')
	{
?>
		<div class="row header centered-layout">
			<div class="small-12 columns">
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
		<div class="row menu-bar centered-layout show-for-medium">
			<div class="small-12 columns">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
			</div>
		</div>

		<div class="row columns show-for-small-only primary-navigation" id="small-menu-container">
			<ul class="vertical menu" data-accordion-menu>
				<li>
					<a href="#">Menu</a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>
				</li>
			</ul>
		</div>
<?php 
	} /* End if ($menuLayout == 'centered-single') */
	else if ($menuLayout == 'centered-single-above')
	{
?>
		<div class="row menu-bar centered-layout show-for-medium">
			<div class="small-12 columns">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); ?>
			</div>
		</div>

		<div class="row columns show-for-small-only primary-navigation" id="small-menu-container">
			<ul class="vertical menu" data-accordion-menu>
				<li>
					<a href="#">Menu</a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>
				</li>
			</ul>
		</div>
		<div class="row header centered-layout">
			<div class="small-12 columns">
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
<?php 
	} /* End if ($menuLayout == 'centered-single-above') */
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
