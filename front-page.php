<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="small-12 columns">

		<div id="primary" class="content-area front-page">

			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :

					the_post();

					get_template_part( 'template-parts/content', get_post_format() );

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
