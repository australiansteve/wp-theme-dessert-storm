<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row"><!-- .row start -->

	<div class="small-12 columns"><!-- .columns start -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<h3 class='project-type-title'>- Film & TV -</h3>
				<?php echo do_shortcode("[austeve_projects include_type='film-tv']"); ?>

				<h3 class='project-type-title'>- Content -</h3>
				<?php echo do_shortcode("[austeve_projects include_type='content-writing']"); ?>

				<h3 class='project-type-title'>- Print -</h3>
				<?php echo do_shortcode("[austeve_projects include_type='print']"); ?>

			<?php else : ?>

				<?php get_template_part( 'page-templates/partials/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns end -->

</div><!-- .row end -->

<?php get_footer(); ?>
