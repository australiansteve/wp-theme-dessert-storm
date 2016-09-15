jQuery(document).ready(function($) {

	$(document).foundation();


	setTimeout(function() {
		var spaceFooter = _.debounce(footerSpacing, 250);
		$(window).resize(spaceFooter);
		spaceFooter();

		var resizeSpinner = _.debounce(spinBackground, 250);
		$(window).resize(resizeSpinner);
		resizeSpinner();

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

var initialBackgroundHeight;

function spinBackground()
{
	jQuery("#bgImage3").each(function() {
		
		//Get the height & width of the background image initially. This will vary by screen size
		var existingHeight = jQuery(this).outerHeight();
		var windowWidth = jQuery(window).width();

		initialBackgroundHeight = (initialBackgroundHeight === undefined) ? existingHeight : initialBackgroundHeight;

		//New height based on the proportions of the original image (1200x810px)
		var spinningHeight = Math.floor((windowWidth / 1200) * 810);

		//Only update the height if the new height is smaller than the original
		if (spinningHeight < initialBackgroundHeight)
		{
			//console.log('New height ' + spinningHeight + 'px');
			jQuery(this).css('height', spinningHeight + 'px');
		}
		else if (spinningHeight >= initialBackgroundHeight)
		{
			//console.log('Revert to initial height ' + initialBackgroundHeight + 'px');
			jQuery(this).css('height', initialBackgroundHeight + 'px');
		}

		//Always set the width
		jQuery(this).css('width', spinningHeight + 'px');

		//Change the background size to cover, rather than contain. This will make it expand to the sizes we just set
		jQuery(this).css('background-size', 'cover');

		//Add the spinning animations
		jQuery(this).css('-webkit-animation-name', 'spin');
		jQuery(this).css('-moz-animation-name', 'spin');
		jQuery(this).css('-ms-animation-name', 'spin');
		jQuery(this).css('animation-name', 'spin');
	});
}