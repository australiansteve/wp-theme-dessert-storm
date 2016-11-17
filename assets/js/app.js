jQuery(document).ready(function($) {

	$(document).foundation();

	var resizeScrollingBackground = _.debounce(scrollingBackground, 500);
	var spaceFooter = _.debounce(footerSpacing, 250);
	var resizeSpinner = _.debounce(spinBackground, 50);
	var resizePolaroids = _.debounce(polarize, 250);

	setTimeout(function() {		
		//resize background a few seconds after loading finishes in case image loading was slow		
		$(window).resize(resizeScrollingBackground);
		resizeScrollingBackground();
	}, 100);

	setTimeout(function() {
		$(window).resize(spaceFooter);
		spaceFooter();

		$(window).resize(resizeSpinner);
		resizeSpinner();

		$(window).resize(resizePolaroids);
		resizePolaroids();

		//display spinning background layer
		jQuery("#bgImage3").show();

	}, 300);


	setTimeout(function() {		
		//Resize background again because instagram images rotating adds height to the page
		resizeScrollingBackground();
	}, 3000);

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
		var bg2Height = jQuery("#bgImage2").outerHeight();
		var windowWidth = jQuery(window).width();

		//console.log("Existing: " + existingHeight);
		//console.log("BG2: " + bg2Height);
		//console.log("windowWidth: " + bg2Height);

		initialBackgroundHeight = (initialBackgroundHeight === undefined) ? existingHeight : initialBackgroundHeight;
		//If the viewport window changes height (landscape samsung S4) then we should actually grab the height of the 2nd background image rather than the 3rd
		if (bg2Height != initialBackgroundHeight)
		{
			initialBackgroundHeight = bg2Height;
		}

		//New height based on the proportions of the original image (800x540px)
		var spinningHeight = Math.floor((windowWidth / 800) * 540);

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

	//Half a second later resize the background again to avoid there being a white space behind the footer
	setTimeout(function() {
		scrollingBackground();
	}, 500);
}

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}