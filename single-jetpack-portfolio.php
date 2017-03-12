<?php
/**
 * The template for displaying all single profiles.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dessertstorm
 */
?>

<?php get_header(); ?>

<div class="row"><!-- .row start -->

	<div class="small-12 columns"><!-- .col-sm-12 start -->

		<div id="primary" class="content-area no-padding">

			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						
	            		get_template_part('page-templates/partials/jetpack-portfolio', 'single');
						
					?>			

				<?php endwhile; ?>

				<!-- Navigation -->
				<div class="row">

					<div class="small-12 columns">
				
						<div id="project-navigation">
						
							<a href="<?php echo get_option('home');?>" title='Home'><?php echo bloginfo('name'); ?></a> > 
							<?php
								$categories = get_the_terms( $post->ID, 'jetpack-portfolio-type' );
								if ( ! empty( $categories ) ) {
								    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								}
							?>
							> <?php echo get_the_title(); ?>

						</div>

					</div>

				</div>

			</div><!-- #content -->

		</div><!-- #primary -->

	</div><!-- .col-sm-12 end -->

</div><!-- .row end -->

<div class="row projects-sidebar"><!-- .row start -->

	<?php 
	dynamic_sidebar(get_theme_mod('dessertstorm_content_2_sidebar', null)); 
	?>

</div><!-- .row end -->

<?php get_footer(); ?>
