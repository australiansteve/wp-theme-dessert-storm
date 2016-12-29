<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dessertstorm
 */

get_header(); ?>

<div id="primary" class="content-area index">

	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php

		$sections = get_theme_mod('austeve_general_sections', 0);

		for ($s = 0; $s < $sections; $s++)
		{
			$sectionName = get_theme_mod('dessertstorm_content_'.$s.'_name', null);
			if (!$sectionName)
			{
				$sectionName = $s;
			}
			$sectionId = strtolower(str_replace(' ', '-', $sectionName));
			?>
			<div id="section-<?php echo $sectionId; ?>" class="row columns content-section section-<?php echo $s; ?>">
				<div class="content-background-div">
					<div class="content-background-image <?php echo (get_theme_mod('dessertstorm_content_'.$s.'_bgForSmall', true) == true ) ? '' : 'show-for-medium'; ?>">&nbsp;</div>
				</div>
				<div class="content-container">
				<?php 
					$section_style = get_theme_mod('dessertstorm_content_'.$s.'_style', 'none');

					if ( $section_style === 'page') {
						$id=get_theme_mod('dessertstorm_content_'.$s.'_page', 0); 
						$post = get_post($id); 
						$content = apply_filters('the_content', $post->post_content); 
						echo $content;  
					}
					else if ( $section_style === 'sidebar') {
						echo "<div class='row'>";
						dynamic_sidebar(get_theme_mod('dessertstorm_content_'.$s.'_sidebar', null)); 
						echo "</div>";
					}
					else if ( $section_style === 'none') {
						echo "<div class='row columns empty-content'>";
						echo "&nbsp;";
						echo "</div>";
					}
					else {
						echo 'Unknown'; 
					}
					?>
				</div>
			</div>
			<?php
		}
		?>

	<?php else : ?>

		<?php get_template_part( 'components/content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
