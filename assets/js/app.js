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


	$('.project').on("mouseover touchstart", function(){
	    jQuery(this).find("div.content").show();
	  
	});

	$('.project').on("mouseout touchend", function(){
	    jQuery(this).find("div.content").hide();
	});

	setTimeout(function() {
		var roundButtons = _.debounce(buttonRounding, 300);
		$(window).resize(roundButtons);
		roundButtons();
	}, 600);

});


function footerSpacing()
{
	var marginNeeded = jQuery(window).height() - jQuery("#page").outerHeight() - jQuery("footer").outerHeight();
	
	if (marginNeeded > 0)
	{
		jQuery("#spacer").css("margin-top", marginNeeded);
	}
}


function buttonRounding()
{
	jQuery(".round-button").each(function() {
		jQuery(this).css('height', jQuery(this).css('width'));
	});
}