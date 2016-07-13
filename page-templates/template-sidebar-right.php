<?php
/**
 * Template Name: Sidebar Right
 * The template for displaying a page with the sidebar on the left side.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="medium-8 columns">

		<div id="primary" class="content-area page">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns -->

	<div class="medium-4 columns">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>