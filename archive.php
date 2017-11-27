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
				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					// the_archive_description( '<div class="taxonomy-description">', '</div>' );	
					?>
					</header>

					<?php
					while ( have_posts() ) :

						the_post();

						if (has_category('season'))
						{
							get_template_part( 'template-parts/content', 'archive-season' );
						}
						else
						{
							get_template_part( 'template-parts/content', get_post_format() );
						}

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main>

		</div>

	</div>

</div>

<?php
get_footer();
