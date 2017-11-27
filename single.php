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
			<?php
				while ( have_posts() ) :

					the_post();

					if (has_category('season'))
					{
						get_template_part( 'template-parts/content', 'single-season' );
					}
					else
					{
						get_template_part( 'template-parts/content', 'single' );
					}

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; ?>

			</main>

		</div>

	</div>

</div>

<?php
get_footer();
