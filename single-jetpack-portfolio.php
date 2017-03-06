<?php
/**
 * The template for displaying all single profiles.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dessertstorm
 */
?>

<?php get_header(); ?>

<div class="row"><!-- .row start -->

	<div class="small-12 columns"><!-- .col-sm-12 start -->

		<div id="primary" class="content-area no-padding">

			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						
	            		get_template_part('page-templates/partials/jetpack-portfolio', 'single');
						
					?>			

				<?php endwhile; ?>

			</div><!-- #content -->

		</div><!-- #primary -->

	</div><!-- .col-sm-12 end -->

</div><!-- .row end -->

<div class="row projects-sidebar"><!-- .row start -->

	<?php 
	dynamic_sidebar(get_theme_mod('dessertstorm_content_2_sidebar', null)); 
	?>

</div><!-- .row end -->

<?php get_footer(); ?>
