(function ($) {
	$(document).ready(function () {
		$(".dm-topmenu li").hover(
			function () {
				$(this).addClass("hover");
			}, function () {
				$(this).removeClass("hover");
			});
	});
}(jQuery));