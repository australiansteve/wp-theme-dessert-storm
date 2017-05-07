<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="small-12 columns">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						
						if (has_category( array( 'past-productions', 'upcoming-events' )))
						{
							get_template_part( 'components/content', 'event' ); 
						}
						else if (has_category( array( 'rondos-in-the-media' )))
						{
							get_template_part( 'components/content', 'media' ); 
						}
						else
						{
							get_template_part( 'components/content', 'single' ); 
						}

					?>

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'components/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
