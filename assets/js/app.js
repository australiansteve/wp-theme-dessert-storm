jQuery(document).ready(function($) {

	$(document).foundation();


	setTimeout(function() {
		var spaceFooter = _.debounce(footerSpacing, 500);
		$(window).resize(spaceFooter);
		spaceFooter();
	}, 500);

});


function footerSpacing()
{
	var marginNeeded = jQuery(window).height() - jQuery("#page").outerHeight() - jQuery("footer").outerHeight();
	
	if (marginNeeded > 0)
	{
		jQuery("#spacer").css("margin-top", marginNeeded);
	}
}