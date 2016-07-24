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
	console.log(jQuery(window).height()+ " " +  jQuery("#page").outerHeight() + " " + jQuery("footer").outerHeight());

	var marginNeeded = jQuery(window).height() - jQuery("#page").outerHeight() - jQuery("footer").outerHeight();
	console.log(marginNeeded);

	if (marginNeeded > 0)
	{
		jQuery("#spacer").css("margin-top", marginNeeded);
		console.log("done");
	}
}