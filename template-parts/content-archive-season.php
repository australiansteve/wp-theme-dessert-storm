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

					// check if the flexible content field has rows of data
					if( have_rows('cover') ):

					     // loop through the rows of data
					    while ( have_rows('cover') ) : the_row();

					        if( get_row_layout() == 'image' ):

					        	$image = get_sub_field('cover_image');

								if( !empty($image) ): 
				?>
									<a href='<?php echo get_permalink()?>'>
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									</a>
				<?php 
								endif;

					        elseif( get_row_layout() == 'video' ): 

					        	$videoUrl = get_sub_field('cover_video');

					        endif;

					    endwhile;

					else :

					    // no layouts found

					endif;

				?>

			</div>

			<div class="small-12 medium-6 columns">
								
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
