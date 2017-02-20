<?php
/**
 * Template part for displaying single projects.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package Dessertstorm
 */
?>

<div class="container">

    <div class="project">

		<div class="project-image">
			<img src="<?php echo the_post_thumbnail_url();?>"/>			
		</div>

		<div class="project-title">

         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		</div>

		<div class="project-content">

         	<?php the_content( ); ?>

		</div>

	</div>

</div>
