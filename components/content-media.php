<?php
/**
 * Template part for displaying media artcile posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('austeve-single-media'); ?>>

	<div class="row columns">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
	</div>

	<div class="row">
		<div class="small-12 medium-4 columns">
			<div class="media-thumbnail">
			<?php
				if ( has_post_thumbnail() ) {
				    the_post_thumbnail();
				}
			?>
			</div>
		</div>
		<div class="small-12 medium-8 columns">

			<div class="row">
				<div class="small-12 columns">
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<?php
						$pdf = get_field("pdf");
						if ($pdf)
						{
							echo "<div class='media-pdf'>";
							echo "<a class='pdf' target='_blank' href='".$pdf['url']."' title='Read the article'>Click here to read the article</a>";
							echo "</div>";
						}
					?>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-## -->
