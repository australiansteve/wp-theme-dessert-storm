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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php dessertstorm_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
		<!-- pagination -->
	    <div class='row pagination'>
		    <div class='small-12 medium-6 columns small-text-center medium-text-left page-link newer-posts'>
				<?php next_post_link('<strong>%link</strong>', '<i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous post: %title'); ?>
		    </div>
		    <div class='small-12 medium-6 columns small-text-center medium-text-right page-link older-posts'>
				<?php previous_post_link('<strong>%link</strong>', 'Next post: %title <i class="fa fa-angle-double-right" aria-hidden="true"></i>'); ?>
		    </div>
	    </div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php dessertstorm_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
