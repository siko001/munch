function previewImage(event) {
	var reader = new FileReader();
	reader.onload = function () {
		var output = document.getElementById('imagePreview');
		output.innerHTML = '<img src="' + reader.result + '" style="min-heigth:190px: min-width:160px;max-width:170px; max-heigth:200px">';
	};
	reader.readAsDataURL(event.target.files[0]);
}
