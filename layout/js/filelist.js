$(document).ready(function() {
	generateFilelist("..");
});

function generateFilelist(path) {
	console.log("Generating filelist for path: " + path);

	$.ajax({
		url: "ajax/fsoperations.php",
		dataType: "json",
		data: {
			operation: "getDirContent",
			dir: path
		},
		type: "GET",
		success: function(filesObject) {
			console.log(filesObject);

			var $filelist = $(".js-filelist");

			$filelist.html("");
			$filelist.attr("data-path", path);

			// Append .. element		
			$fileelement = $("<div />")
				.addClass("folder")
				.addClass("filelist-element")
				.addClass("js-unselectable")
				.attr("data-ico", "folder")
				.attr("data-isdir", "true")
				.attr("data-name", "..")
				.attr("data-filesize", "false")
				.append("<div class='filename'>..</div>")
				.append("<div class='filesize'></div>")
				.appendTo($filelist);

			// Append each element
			$.each(filesObject, function(i, fileObject) {
				var fileextension = fileObject.name.split(".");
				fileextension = fileextension[fileextension.length - 1];

				$fileelement = $("<div />")
					.addClass(fileObject.isdir ? "folder" : "file")
					.addClass("filelist-element")
					.attr("data-ico", fileObject.isdir ? "folder" : "file-" + fileextension)
					.attr("data-isdir", fileObject.isdir)
					.attr("data-name", fileObject.name)
					.attr("data-filesize", fileObject.isdir ? fileObject.filesize : "false")
					.append("<div class='filename'>" + fileObject.name + "</div>")
					.append("<div class='filesize'>" + fileObject.isdir ? fileObject.filesize : "" + "</div>")
					.appendTo($filelist);
			});

			$(".filelist-element").click(function() {
				var $this = $(this);
				var isdir = $this.data("isdir");
				var elementname = $this.data("name");

				selectFilelistElement($this);
			});

			$(".filelist-element").dblclick(function() {
				var $this = $(this);
				defaultAction($this);
			});
		},
		error: function(error) {
			alert("An error occured. See developers console for details");
			console.log("Error: " + error);
		}
	});
}

function selectFilelistElement($element) {
	if(!$element.hasClass("js-unselectable")) {
		$(".filelist-element.selected").removeClass("selected");
		$element.addClass("selected");
	}
}

function defaultAction($element) {
	var isdir = $element.data("isdir");
	var elementname = $element.data("name");

	if(isdir) {
		var path = $(".js-filelist").attr("data-path");
		generateFilelist(path + "/" + elementname);
		console.log(path + "/" + elementname);
	}
}