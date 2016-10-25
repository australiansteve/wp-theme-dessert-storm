jQuery(document).ready(function($) {

	$(document).foundation();

	setTimeout(function() {
		var spaceFooter = _.debounce(footerSpacing, 250);
		$(window).resize(spaceFooter);
		spaceFooter();

		var resizeSpinner = _.debounce(spinBackground, 250);
		$(window).resize(resizeSpinner);
		resizeSpinner();

		var resizePolaroids = _.debounce(polarize, 250);
		$(window).resize(resizePolaroids);
		resizePolaroids();

	}, 300);

	setTimeout(function() {		
		//resize background a few seconds after loading finishes in case image loading was slow
		var resizeScrollingBackground = _.debounce(scrollingBackground, 750);
		$(window).resize(resizeScrollingBackground);
		resizeScrollingBackground();
	}, 1000);

});


function scrollingBackground()
{
	jQuery("#background-div.scrolling").each(function() {
		var backgroundHeight = jQuery(this).css('height');
		console.log("backgroundHeight: " + backgroundHeight);

		//Set the first background image to be the same height so that it repeats vertically
		jQuery(this).find("#bgImage1").css('height', backgroundHeight);
	});
}

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

function polarize()
{
	jQuery(".sbi_photo_wrap").each(function() {
		
		//Set padding of each wrapper to be in poaloid proportions
		jQuery(this).css('padding', '6.06% 7.14% 21.21% 7.14%');

		//Set the height of each image to match the width now that the dimensions have changed due to padding
		jQuery(this).find('.sbi_photo').each( function() {
			//set height = width
			jQuery(this).css('height', jQuery(this).css('width'));
		});
		
		//Randomize the angle of each image
		var angle = getRandomInt(-20, 20);
		jQuery(this).css('-webkit-transform', 'rotate(' + angle +'deg)');
		jQuery(this).css('-moz-transform', 'rotate(' + angle +'deg)');
		jQuery(this).css('-ms-transform', 'rotate(' + angle +'deg)');
		jQuery(this).css('-o-transform', 'rotate(' + angle +'deg)');
		jQuery(this).css('transform', 'rotate(' + angle +'deg)');

	});
}

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}