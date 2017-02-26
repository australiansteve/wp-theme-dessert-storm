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

<?php
	$spaceSections = get_theme_mod('austeve_general_section_height', false);
	if (is_home() && $spaceSections)
	{
?>
	<script>
function sectionSpacing()
{
	var windowHeight = Number(jQuery(window).height());
	console.log("Window height: " + windowHeight);

	jQuery("#primary.index .content-section").each(function() {
		var rawHeight = jQuery(this).css("height")
		var sectionHeight = Number(rawHeight.substr(0, rawHeight.length - 2));
		console.log(jQuery(this).attr("id") + ": " + sectionHeight);

		if (sectionHeight > 0 && sectionHeight < windowHeight)
		{
			var contentPadding = (windowHeight - sectionHeight) / 2;
			console.log("Content padding top & bottom: " + contentPadding + "px");
			jQuery(this).find(".content-container").css( { "padding-top" : contentPadding + "px", "padding-bottom" : contentPadding + "px"})
		}

	});
}

setTimeout(function() {
	var spaceSections = _.debounce(sectionSpacing, 100);
	jQuery(window).resize(spaceSections);
	spaceSections();
}, 100);

	</script>

<?php

	}

?>

<?php wp_footer(); ?>
</body>
</html>
