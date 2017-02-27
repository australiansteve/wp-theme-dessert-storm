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

<?php
	$spaceSections = get_theme_mod('austeve_general_section_height', false);
	if (is_home() && $spaceSections)
	{

		$sections = get_theme_mod('austeve_general_sections', 0);

		$customSpacings = array();
		for ($s = 0; $s < $sections; $s++) 
		{
			$sectionName = get_theme_mod('dessertstorm_content_'.$s.'_name', null);
			if (!$sectionName)
			{
				$sectionName = $s;
			}
			$sectionId = strtolower(str_replace(' ', '-', $sectionName));

			//Custom spacing
			$customSpacings['section-'.$sectionId] = empty(get_theme_mod('dessertstorm_content_'.$s.'_spacing', '50')) ? '50' : get_theme_mod('dessertstorm_content_'.$s.'_spacing', '50');
		}

		error_log(print_r($customSpacings, true));
?>
	<script>

		var customSpacings = <?php echo json_encode($customSpacings); ?>;

		function sectionSpacing()
		{
			var windowHeight = Number(jQuery(window).height());

			jQuery("#primary.index .content-section").each(function() {
				var contentContainer = jQuery(this).find(".content-container");
				var sectionId = jQuery(this).attr("id");
				var contentHeight = contentContainer.height();

				if (contentHeight > 0)
				{
					var paddingTop = Number((windowHeight - contentHeight) * ( Number(customSpacings[sectionId]) / 100 ) );
					var paddingBottom = Number((windowHeight - contentHeight) - paddingTop);

					contentContainer.css( { "padding-top" : paddingTop + "px", "padding-bottom" : paddingBottom + "px"})
				}

			});
		}

		setTimeout(function() {
			var spaceSections = _.debounce(sectionSpacing, 300);
			jQuery(window).resize(spaceSections);
			spaceSections();
		}, 50);

	</script>
<?php
	}
?>
</body>
</html>
