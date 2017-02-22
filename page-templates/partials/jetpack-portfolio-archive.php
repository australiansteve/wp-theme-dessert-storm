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

	    <div class="project">

			<a href="<?php echo get_permalink(); ?>">

	         	<?php the_title( '<p class="entry-title">', '</p>' ); ?>
	         	
			</a>

		</div>

	</div>

</div>
