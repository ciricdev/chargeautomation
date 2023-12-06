// Import JS files
import './accordion.js';

// Old jQuery for courasel

(function ($) {
	var owl = $("#owl-demo");
	owl.owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items: 3, //10 items above 1000px browser width
		itemsDesktop: [1000, 3], //5 items between 1000px and 901px
		itemsDesktopSmall: [900, 2], // 3 items betweem 900px and 601px
		itemsTablet: [600, 1], //2 items between 600 and 0;
		itemsMobile: [400, 1], // itemsMobile disabled - inherit from itemsTablet option

	});
	$(document).ready(function () {
		$(".flip-item").hover(function () {
			$(this).toggleClass("active");  //Toggle the active class to the area is hovered
		});
	});
})(jQuery);
