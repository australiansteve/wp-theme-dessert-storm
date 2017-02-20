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

	         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

			</div>

		</a>

	</div>

</div>
