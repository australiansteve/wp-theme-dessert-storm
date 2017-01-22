<?php
/**
 * Template part for displaying the archive of projects.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package Dessertstorm
 */
?>
<div class="column">

	<div class="container project-archive-item">

		<a href="<?php echo get_permalink(); ?>">
		
		    <div class="project">

				<div class="bg-image" style="background-image:url( <?php echo the_post_thumbnail_url();?> )">
					
				</div>

				<div class="content">

		         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				</div>

			</div>

		</a>

	</div>

</div>
