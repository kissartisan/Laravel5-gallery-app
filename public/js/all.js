/* The quick brown fox jumps over the lazy dog */

/* Set the dropzone object parameters */
Dropzone.options.addImages = {
	maxFilesize: 2,
	acceptedFiles: 'image/*',
	success: function(file, response) {
		if (file.status == 'success') {
			handleDropzoneFileUpload.handleSuccess(response);
			console.log(file);
			console.log(response);
		} else {
			handleDropzoneFileUpload.handleError(response);
		}
	}
};

/* Handle automatic file upload */
var handleDropzoneFileUpload = {
	handleError: function(response) {
		console.log(response);
	},
	/* Add an image to the view if the reponse was success */
	handleSuccess: function(response) {
		var imageList = $('#gallery-images');
		var imageSrc = baseUrl + '/gallery/images/thumbs/' + response.file_name;
		$(imageList).append('<div class="col l3 m4 s6 center noPadding noMargin"><a href="' + imageSrc + '" data-lightbox="mygallery"><img src="' + imageSrc + '" alt="" /></a></div>');
	}
};

$(document).ready(function () {
	console.log('Document is ready!');
});
//# sourceMappingURL=all.js.map
