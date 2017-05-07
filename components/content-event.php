<?php
/**
 * Template part for displaying single past or future event posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('austeve-single-event'); ?>>

	<div class="row columns">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</header><!-- .entry-header -->
	</div>

	<div class="row">
		<div class="small-12 medium-4 columns">
			<div class="event-thumbnail">
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
					<?php
						//if certain categories?
						$dates = get_field("dates");
						if ($dates)
						{
							echo "<div class='event-date'>";
							foreach($dates as $date)
							{
								echo $date['date']."<br/>";
							}
							echo "</div>";
						}
					?>
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<?php
						$venue = get_field("venue");
						if ($venue)
						{
							echo "<div class='event-venue'>";
							echo $venue;
							echo "</div>";
						}
					?>
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-## -->
