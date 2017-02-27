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
	$scrollSections = get_theme_mod('austeve_general_section_scroll', false);
	if (is_home())
	{

		if ($spaceSections)
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
		} //END if ($spaceSections)

		if ($scrollSections)
		{
		?>
	<script>

		function scrollIt(e) {
			var delta = e.originalEvent.deltaY;
			var windowHeight = Math.round(Number(jQuery(window).height()));
			var yPosition = Math.round(window.scrollY);
			var windowBottom = yPosition + windowHeight;

			//console.log("Current position: " + yPosition + ". Bottom " + windowBottom);
			//console.log("Window height: " + windowHeight);


			jQuery("#primary.index .content-section").each(function() {
				var sectionTop = Math.round(jQuery(this).offset().top);
				var sectionBottom = sectionTop + jQuery(this).height();
				var sectionHeight = sectionBottom - sectionTop;
				//console.log(jQuery(this).attr("id") + ": " + sectionTop + "; " + sectionBottom);
				//console.log("Section height" +  sectionHeight);

				if (delta > 0) 
				{
					//console.log('down');
					if ( windowBottom < sectionBottom || ( sectionHeight > (windowHeight + 1) && windowBottom < (sectionBottom + windowHeight * 0.2)))
					{
						//console.log("Bottom of section is above bottom of screen, OR tall section AND we've scrolled more than 20% past it");
						if ( yPosition < sectionTop )
						{
							//console.log("Top of section is not at top of screen - SCROLL");
							jQuery('html, body').animate({
							    scrollTop: jQuery(this).offset().top
							}, 1000);
						}
						//else
						//{
						//	console.log("Top of section is at or above top of screen - NO SCROLL");
						//}
						return false;
					}
				}
				else 
				{
					//console.log('up');
					if ( sectionTop < yPosition && sectionBottom > yPosition  )
					{
						if ( sectionHeight <= (windowHeight + 1) ) //windowHeight +1 to allow for rounding
						{
							jQuery('html, body').animate({
							    scrollTop: jQuery(this).offset().top
							}, 1000);
						}
						return false;
					}
				}

			});
		}

		var autoScroll = _.debounce(scrollIt, 300);
		jQuery(window).on('wheel', autoScroll);

	</script>
<?php
		} //END if ($scrollSections)
		
	} //END if (is_home())
?>
</body>
</html>
