function openWindow(windowname) {
	//var windowname = $element.data("window");

	$.ajax({
		url: "ajax/window." + windowname + ".php",
		dataType: "html",
		type: "GET",
		success: function(windowElement) {
			var $windowElement = $(windowElement);
			var $windowContainer = $(".container-windows");
			var windowType = $windowElement.attr("data-windowType");

			closeWindows();
			console.log($windowContainer);

			if(windowType == "sidebar-left") {
				var windowSize = $windowElement.attr("data-windowSize");
				$windowElement
					.appendTo($windowContainer)
					.removeClass("hidden")
			        .removeClass("slideOutToRight")
			        .addClass("slideInFromRight");
			}

			// js events
			$windowElement.find(".js-closewindow").click(function() {
				closeWindows(); // todo: only close specific window
			});
		},
		error: function(error) {
			alert("An error occured. See developers console for details");
			console.log("Error: " + error);
		}
	});
}

function closeWindows() {
	$(".window[data-windowtype=sidebar-left]")
        .removeClass("slideInFromRight")
        .addClass("slideOutToRight");
}

$(document).ready(function() {
	$(".js-open-window").click(function() {
		openWindow($(this).data("window"));
	});
});