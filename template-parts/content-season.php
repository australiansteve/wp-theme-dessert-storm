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
	<div class="row columns">
		<?php 

			$image = get_field('cover_photo');

			if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

		<?php endif; ?>

	</div>

	<div class="row small-up-2 medium-up-3 large-up-4">

		<?php 

			// check if the repeater field has rows of data
			if( have_rows('related_products') ):

			 	// loop through the rows of data
			    while ( have_rows('related_products') ) : the_row();

		    	?>
			    	<div class="column">
				    	<?php
				        // display a sub field value
				        //the_sub_field('product');

				        echo do_shortcode("[product id='".get_sub_field('product')."']");
				    	?>
			    	</div>
				<?php
			    endwhile;

			else :

			    // no rows found

			endif;

		?>

	</div>

</article><!-- #post-## -->
