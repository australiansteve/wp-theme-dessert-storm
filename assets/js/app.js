jQuery(document).ready(function($) {

	$(document).foundation();


	setTimeout(function() {
		var spaceFooter = _.debounce(footerSpacing, 500);
		$(window).resize(spaceFooter);
		spaceFooter();
	}, 500);

	setTimeout(function() {
		$("#background-div.scrolling").each(function() {
			var backgroundHeight = $(this).css('height');
			console.log("backgroundHeight: " + backgroundHeight);

			//Set the first background image to be the same height so that it repeats vertically
			$(this).find("#bgImage1").css('height', backgroundHeight);
		});
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