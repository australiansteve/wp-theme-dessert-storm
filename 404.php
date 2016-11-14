<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div class="row">

	<div class="small-12 columns"><!-- .columns start -->

		<div id="primary" class="content-area" >
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found" style="background: #FFF; text-align: center; padding: 1rem 0.5rem">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'dessertstorm' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">

						<a href="<?php echo site_url(); ?>"><img class="aligncenter wp-image-4" src="http://fiveanddimesj.com/wp-content/uploads/2016/08/logo-300x300.jpg" alt="Five &amp; Dime, Saint John" width="200" height="200" /></a>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns -->

</div><!-- .row -->

<?php get_footer(); ?>
