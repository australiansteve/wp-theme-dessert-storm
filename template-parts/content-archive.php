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

						echo "<a href='".get_permalink()."'>";
						the_post_thumbnail('medium_large', array('class' => 'post-image'));
						echo "</a>";
					} 
				?>

			</div>

			<div class="small-12 medium-6 columns">
				<div class="entry-meta">
					<?php dessertstorm_posted_on(); ?> <?php dessertstorm_entry_tags(); ?>
				</div><!-- .entry-meta -->
				
				<a href='<?php echo get_permalink()?>'>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</a>

				<div class="entry-excerpt">
					<a href='<?php echo get_permalink()?>'>
						<?php the_excerpt( ); ?>			
					</a>
				</div>

			</div>
		</div>
		
	</header><!-- .entry-header -->

</article><!-- #post-## -->

	</header><!-- .entry-header -->
	
</article><!-- #post-## -->
