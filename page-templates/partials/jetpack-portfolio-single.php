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

		    <div class="small-12 large-7 columns">

				<div class="row columns">

					<div class="project-title">

			         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

					</div>

			    </div>

		        <?php 
		        $subtitle = get_field( 'subtitle' );
		        if ( $subtitle ) { ?>
				<div class="row columns">

					<div class="subtitle">

			         	<?php echo $subtitle; ?>

					</div>

				</div>
		        <?php } ?>

		        <?php if (get_field( 'client' )) { ?>
				<div class="row columns">

					<div class="client">

			         	<?php echo get_field( 'client' ); ?>

					</div>

				</div>
		        <?php } ?>

				<div class="row">

					<div class="small-12 medium-8 columns">

						<div class="project-content">

				         	<?php the_content( ); ?>

						</div>

				    </div>

			    </div>

		        <?php 
		        $pdf = get_field( 'pdf_version' );
		        $pdf_link_text = get_field('pdf_link_text'); 
		        if ( $pdf ) { 
		        	//Backwards compatibility
		        	if(!$pdf_link_text) { $pdf_link_text = 'View full article'; }
				?>
				<div class="row columns">

					<div class="pdf">

			         	<a href="<?php echo $pdf; ?>" target='_blank' title='<?php echo $pdf_link_text; ?>'><?php echo $pdf_link_text; ?></a>

					</div>

				</div>
		        <?php } ?>

		    </div>

		    <div class="small-12 large-5 columns">

				<div class="project-images">

				<?php 
					if (has_post_thumbnail()) { 
						$image = get_post( get_post_thumbnail_id() );
				?>

					<img src="<?php echo the_post_thumbnail_url();?>" title="<?php echo $image->post_title; ?>" alt="<?php echo get_field('_wp_attachment_image_alt', $image->ID); ?>" />
		    		<em class='caption'><?php echo $image->post_excerpt; ?></em>

	    		<?php } ?>

		    	</div>

		    </div>

	    </div>

	</div>

</div>
