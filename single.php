<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="small-12 columns">

		<div id="primary" class="content-area single">
			<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php 

				if (has_category( array( 'past-productions', 'upcoming-events' )))
				{
					get_template_part( 'components/content', 'event' ); 
				}
				else
				{
					get_template_part( 'components/content', 'single' ); 

					the_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				}

				?>

			<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
