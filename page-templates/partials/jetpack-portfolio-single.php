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

    <div class="single-project">

	    <div class="row">

		    <div class="small-12 columns">

				<div class="project-title">

		         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				</div>

			</div>

	    </div>

	    <div class="row">

		    <div class="small-12 large-4 columns">

				<div class="project-content">

		         	<?php the_content( ); ?>

				</div>

		    </div>

		    <div class="large-3 columns">
		    	&nbsp;
		    </div>

		    <div class="small-12 large-5 columns">

		    	<img src="<?php echo the_post_thumbnail_url();?>"/>
		    </div>

	    </div>

	</div>

</div>
