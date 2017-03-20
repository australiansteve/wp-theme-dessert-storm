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

				<?php
				//Get all project types
				$taxonomy = 'jetpack-portfolio-type';
				$terms = get_terms($taxonomy); // Get all terms of a taxonomy

				if ( $terms && !is_wp_error( $terms ) ) :
				
					foreach ( $terms as $term ) { ?>

						<h3 class='project-type-title'><?php echo $term->name; ?></h3>
						<?php 
						$shortcode = "[austeve_projects include_type='".$term->slug."']";
						echo do_shortcode($shortcode); ?>

			        <?php } 
			    endif;

				?>

			<?php else : ?>

				<?php get_template_part( 'page-templates/partials/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns end -->

</div><!-- .row end -->

<?php get_footer(); ?>
