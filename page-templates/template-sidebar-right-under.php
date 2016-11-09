<?php
/**
 * Template Name: Sidebar Right & Under
 * The template for displaying a page with the sidebar on the right side, and dynamic sidebar underneath the main content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="small-12 medium-8 columns">

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

	<div class="show-for-medium medium-4 columns">

		<?php get_sidebar(); ?>

	</div><!-- .columns -->

</div><!-- .row -->

<div class="row" id="down-under-sidebar"">

	<?php dynamic_sidebar('austeve_content_underneath'); ?> 

</div>

<?php get_footer(); ?>