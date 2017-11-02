<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<div class="row align-middle">

			<div class="small-12 medium-6 columns">

				<?php
					// check if the post has a Post Thumbnail assigned to it.
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('medium_large', array('class' => 'post-image'));
					} 
				?>

			</div>

			<div class="small-12 medium-6 columns">
				<div class="entry-meta">
					<?php dessertstorm_posted_on(); ?> <?php dessertstorm_entry_tags(); ?>
				</div><!-- .entry-meta -->
				
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<div class="entry-excerpt">
					<?php the_excerpt( ); ?>					
				</div>

			</div>
		</div>
		
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="row align-center">

			<div class="column small-10 medium-8">

				<?php the_content(); ?>

			</div>
		</div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dessertstorm' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
