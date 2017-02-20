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

	<div class="col-sm-12"><!-- .col-sm-12 start -->

		<div id="primary" class="content-area">

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

<?php get_footer(); ?>
