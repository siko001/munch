// to get current year
function getYear() {
	var currentDate = new Date();
	var currentYear = currentDate.getFullYear();
	document.querySelector('#displayYear').innerHTML = currentYear;
}

getYear();

// isotope js
$(window).on('load', function () {
	$('.filters_menu li').click(function () {
		$('.filters_menu li').removeClass('active');
		$(this).addClass('active');

		var data = $(this).attr('data-filter');
		$grid.isotope({
			filter: data,
		});
	});

	var $grid = $('.grid').isotope({
		itemSelector: '.all',
		percentPosition: false,
		masonry: {
			columnWidth: '.all',
		},
	});
});

// nice select
$(document).ready(function () {
	$('select').niceSelect();
});

/** google_map js **/
function myMap() {
	var mapProp = {
		center: new google.maps.LatLng(35.922322, 14.451789), // Updated coordinates for Malta
		zoom: 18, // Adjust the zoom level as needed
	};
	var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
}

$('.client_owl-carousel').owlCarousel({
	loop: true,
	margin: 0,
	dots: false,
	nav: true,
	navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
	autoplay: true,
	autoplayHoverPause: true,
	responsive: {
		0: {
			items: 1,
		},
		768: {
			items: 2,
		},
		1000: {
			items: 3,
		},
	},
});

//set limit on the number in form element
const inputField = document.getElementById('myInput');

if (inputField) {
	inputField.addEventListener('input', function () {
		const inputValue = inputField.value;
		const maxLength = 6; // Set the desired limit
		if (inputValue.length > maxLength) {
			inputField.value = inputValue.slice(0, maxLength);
		}
	});
}
//to display limit of the text area
function updateCharCount(textarea) {
	var maxLength = parseInt(textarea.getAttribute('maxlength'));
	var currentLength = textarea.value.length;
	var charsLeft = maxLength - currentLength;
	var charCountElement = document.getElementById('charCount');
	charCountElement.textContent = charsLeft + '/120	';
	textarea.style.position = 'relative';
	textarea.style.paddingBottom = charCountElement.offsetHeight + 'px';
}

//error for the auto-selected disabled field
document.addEventListener('DOMContentLoaded', function () {
	const form = document.querySelector('form');

	// Add an event listener to the form submit event
	form.addEventListener('submit', function (event) {
		const categorySelect = document.querySelector('select[name="category"]');

		// Check if the disabled option is selected
		if (categorySelect.value === '') {
			event.preventDefault(); // Prevent form submission
			// Remove any existing error messages
			const existingErrorMessages = document.querySelectorAll('.error');
			existingErrorMessages.forEach(function (errorMessage) {
				errorMessage.remove();
			});
			// Create an error message
			const errorMessage = document.createElement('div');
			errorMessage.classList.add('error');
			errorMessage.textContent = 'Please select a category';
			// Append the error message after the category select element
			categorySelect.parentNode.insertBefore(errorMessage, categorySelect.nextSibling);
		}
	});
});
