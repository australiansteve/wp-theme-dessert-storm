<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Dessertstorm
 */
?>

<?php

	get_footer(); 

?>
		</div> <!-- #content -->

	</div> <!-- #page -->

	<div id="spacer">
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row columns">
		<?php
			$footerContent = get_theme_mod('dessertstorm_footer_content', '<a class="fa fa-copyright" href="http://weavercrawford.com"> '.date("Y").' Weaver Crawford Creative</a>')
		?>
			<p class="footer"><?php echo $footerContent; ?></p>
		</div>
	</footer><!-- #colophon -->

<?php
	$fixedBackground = get_theme_mod('austeve_background_fixed', 'fixed');
	if ($fixedBackground == 'scroll')
	{
		echo '</div><!-- #background-div -->';
	} 
?>

<?php wp_footer(); ?>
</body>
</html>
