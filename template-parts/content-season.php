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

			// check if the flexible content field has rows of data
			if( have_rows('cover') ):

			     // loop through the rows of data
			    while ( have_rows('cover') ) : the_row();

			        if( get_row_layout() == 'image' ):

			        	$image = get_sub_field('cover_image');

						if( !empty($image) ): 
		?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
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

	<div class="row small-up-2 medium-up-3 large-up-4">

		<?php 

			// check if the repeater field has rows of data
			if( have_rows('related_products') ):

			 	// loop through the rows of data
			    while ( have_rows('related_products') ) : the_row();
			    	$relatedProduct = get_sub_field('product');

			    	if ($relatedProduct) :
			    	?>
				    	<div class="column related-product">
					    	<?php
					        echo do_shortcode("[product id='".$relatedProduct."']");
					    	?>
				    	</div>
					<?php
					endif;

			    endwhile;

			else :

			    // no rows found

			endif;

		?>

	</div>

</article><!-- #post-## -->
