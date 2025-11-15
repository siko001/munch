function edit(id, button, data) {
	let toEdit = document.getElementById(id);
	let toDisplay = toEdit.innerText;
	let inputField = document.createElement('input');
	inputField.classList.add('edit-input', 'yeah', 'email');
	inputField.id = 'emailchange';
	inputField.type = 'text';
	inputField.value = toDisplay;
	toEdit.textContent = '';
	toEdit.appendChild(inputField);
	inputField.focus();
	let editBtn = button;
	let parentDiv = editBtn.parentNode;

	let confirmBtn = document.createElement('button');
	let cancelBtn = document.createElement('button');
	editBtn.remove();
	confirmBtn.classList.add('round', 'procced', 'fa', 'fa-check');
	cancelBtn.classList.add('round', 'cancel', 'fa', 'fa-times');
	confirmBtn.style.color = 'green';
	cancelBtn.style.color = 'red';
	parentDiv.appendChild(cancelBtn);
	parentDiv.appendChild(confirmBtn);

	confirmBtn.onclick = () => {
		save(confirmBtn, cancelBtn, editBtn, parentDiv, toEdit, inputField, data);
	};
	cancelBtn.onclick = () => {
		cancel(confirmBtn, cancelBtn, editBtn, parentDiv, toEdit, toDisplay);
	};
}

function handleButtonClick(button) {
	let id = button.getAttribute('data-id');
	let data = button.getAttribute('data');
	edit(id, button, data);
}
var emailTimeout;

function save(confirmBtn, cancelBtn, editBtn, parentDiv, toEdit, inputField, data) {
	confirmBtn.remove();
	cancelBtn.remove();
	parentDiv.appendChild(editBtn);
	var inputValue = inputField.value;

	switch (data) {
		case 'name':
			inputValue = capitalizeWords(inputValue);
			checkName(inputField);
			break;
		case 'phone':
			checkPhone(inputField);
			break;
		case 'address':
			checkAddress(inputField);
			break;
		case 'zip':
			checkZip(inputField);
			break;
		case 'city':
			checkCity(inputField);
			break;
		case 'email':
			clearTimeout(emailTimeout);

			if (inputValue.trim() !== '') {
				// Check if the input value matches the email format
				var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				if (emailRegex.test(inputValue)) {
					setEmailNotice('Checking email...', 'checking');

					emailTimeout = setTimeout(function () {
						if (inputValue.endsWith('@munchmunch.com')) {
							// Staff email
							validateEmail(inputValue, '/registeremailstaff');
						} else {
							// User email
							validateEmail(inputValue, '/registeremailuser');
						}
					}, 500);
				} else {
					setEmailNotice('Invalid email format', 'invalid');
				}
			} else {
				setEmailNotice('', 'empty');
			}
			break;
	}

	toEdit.innerText = inputValue;

	// Update the existing hidden input field value
	let hiddenField = document.getElementById(data + 'FieldInput');
	hiddenField.value = inputValue;
}

function cancel(confirmBtn, cancelBtn, editBtn, parentDiv, toEdit, toDisplay) {
	confirmBtn.remove();
	cancelBtn.remove();
	parentDiv.appendChild(editBtn);
	toEdit.innerText = toDisplay;
}

function validateEmail(email, url) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		},
	});

	$.ajax({
		url: url,
		method: 'POST',
		data: {
			email: email,
		},
		success: function (response) {
			handleEmailValidationResponse(response);
		},
		error: function (response) {
			handleEmailValidationResponse(response);
		},
	});
}

function handleEmailValidationResponse(response) {
	if (response.available) {
		setEmailNotice('Email is available!', 'available');
	} else {
		setEmailNotice('Email already registered!', 'invalid');
	}
}

function setEmailNotice(message, className) {
	var noticeElement = $('.email-notice');
	noticeElement
		.html('<p class="' + className + '">' + message + '</p>')
		.removeClass('unavailable available invalid empty checking')
		.addClass(className);
}

$(document).ready(function () {
	$('#emailField').on('change', function () {
		var email = $(this).val();
		setEmailNotice('', 'empty');
	});

	$('#checkEmailBtn').on('click', function () {
		var email = $('#emailField').val();
		if (email.trim() !== '') {
			setEmailNotice('Checking email...', 'checking');
			clearTimeout(emailTimeout); // Clear the previous timeout if it exists
			emailTimeout = setTimeout(function () {
				validateEmail(email, '/registeremailuser');
			}, 400);
		} else {
			setEmailNotice('', 'empty');
		}
	});
});

function checkName(inputField) {
	var name = inputField.value;
	var nameNotice = $('.name-notice');
	var nameRegex = /^[A-Za-z\s]+$/;
	var minLength = 4;
	if (!nameRegex.test(name)) {
		nameNotice.html('<p class="error">Name cannot contain numbers</p>');
	} else if (name.length < minLength) {
		nameNotice.html('<p class="error">Minimum 4 characters</p>');
	} else {
		nameNotice.empty();
	}
}
function capitalizeWords(str) {
	// Split the string into an array of words
	var words = str.split(' ');
	// Capitalize the first letter of each word
	for (var i = 0; i < words.length; i++) {
		var word = words[i];
		words[i] = word.charAt(0).toUpperCase() + word.slice(1);
	}
	// Join the capitalized words back into a string
	var capitalizedStr = words.join(' ');
	return capitalizedStr;
}

function checkPhone(inputField) {
	var number = inputField.value;
	var phoneNotice = $('.phone-notice');
	var regex = /^(\+|00)?([0-9]+)$/;

	if (number === '') {
		phoneNotice.html('<p class="error">Cannot Be empty, minimum 8 numbers</p>');
	} else if (number.length < 8) {
		phoneNotice.html('<p class="error">Minimum 8 numbers</p>');
	} else if (!regex.test(number)) {
		phoneNotice.html('<p class="error">Phone number should contain only numbers or a + in front</p>');
	} else {
		phoneNotice.text('');
	}
}

function checkAddress(inputField) {
	var address = inputField.value;
	var addressNotice = $('.address-notice');

	if (address === '') {
		addressNotice.html('<p class="error">Address cannot be empty!</p>');
	}
}

function checkZip(inputField) {
	var zip = inputField.value;
	var zipNotice = $('.zip-notice');
	var zipRegex = /^[A-Za-z]{3}\s?\d{4}$/;
	if (zip.length == '') {
		zipNotice.html('<p class="error">Please enter a ZIP code</p>');
	} else if (!zipRegex.test(zip)) {
		zipNotice.html('<p class="error">Invalid zip code format</p>');
	} else {
		zipNotice.empty();
	}
}

function checkCity(inputField) {
	var city = inputField.value;
	var cityNotice = $('.city-notice');
	if (city.length == '') {
		cityNotice.html("<p class='error'>Please enter a City!</p>");
	} else if (city.length < 3) {
		cityNotice.html("<p class='error'>Minimum 3 chars!</p>");
	} else {
		cityNotice.empty();
	}
}

// auto email domain for login
window.onload = function () {
	var emailFields = document.querySelectorAll('#emailloginstaff, #emailstaff, #emailchange');

	emailFields.forEach(function (emailField) {
		var inputValue = emailField.value;
		var domain = '@munchmunch.com';

		if (!inputValue.endsWith(domain)) {
			var username = inputValue.substring(0, inputValue.indexOf('@'));
			emailField.value = username + domain;
		}

		emailField.addEventListener('input', function () {
			var inputValue = emailField.value;

			if (!inputValue.endsWith(domain)) {
				var username = inputValue.substring(0, inputValue.indexOf('@'));
				emailField.value = username + domain;
			}
		});

		emailField.addEventListener('keydown', function (event) {
			var inputValue = emailField.value;
			var atSymbolIndex = inputValue.indexOf('@');
			var cursorPosition = emailField.selectionStart;

			// Allow editing before the @ symbol
			if (cursorPosition > atSymbolIndex) {
				// Prevent modifications to the email domain
				if (event.key !== 'Backspace' && event.key !== 'Delete') {
					event.preventDefault();
				} else {
					// Move the cursor to the end of the email domain
					emailField.selectionStart = inputValue.length - domain.length;
					emailField.selectionEnd = inputValue.length - domain.length;
				}
			}
		});
	});
};

function redirectTo(url) {
	window.location.href = url;
}
document.addEventListener('DOMContentLoaded', function () {
	var categorySelect = document.getElementById('category-select');
	var productCategory = categorySelect ? categorySelect.getAttribute('data-product-category') : null;

	if (categorySelect) {
		// Function to dynamically update the options based on the selected category
		function updateCategoryOptions(selectedCategory) {
			var categoryOptions = {
				pasta: ['pizza', 'salad', 'side', 'burger'],
				pizza: ['pasta', 'salad', 'side', 'burger'],
				salad: ['pizza', 'pasta', 'side', 'burger'],
				burger: ['pizza', 'salad', 'pasta', 'side'],
				side: ['pizza', 'salad', 'pasta', 'burger'],
				// Add cases for the remaining categories
			};

			// Clear the existing options
			categorySelect.innerHTML = '';

			// Add the selected category option
			categorySelect.add(new Option(selectedCategory, selectedCategory));

			// Add the remaining category options
			categoryOptions[selectedCategory].forEach(function (category) {
				categorySelect.add(new Option(category, category));
			});
		}

		// Call the updateCategoryOptions function on page load
		if (productCategory !== null) {
			updateCategoryOptions(productCategory);
		}

		categorySelect.addEventListener('change', function () {
			var selectedValue = this.value;
			console.log('Selected value:', selectedValue);
		});
	}
});

//FUCNTION TO ARRANGE ASCENDING OR DESCENDING ORDER
document.addEventListener('DOMContentLoaded', function () {
	var columnHeadings = document.querySelectorAll('.column-heading');

	for (var i = 0; i < columnHeadings.length; i++) {
		columnHeadings[i].addEventListener('click', function (e) {
			e.preventDefault();

			var column = this.getAttribute('data-column');
			var isAscending = this.classList.contains('asc');

			// Reset all sort arrows
			var sortArrows = document.querySelectorAll('.sort-arrow');
			for (var j = 0; j < sortArrows.length; j++) {
				sortArrows[j].classList.remove('up', 'down');
				sortArrows[j].style.visibility = 'hidden'; // Hide all arrows initially
			}

			if (!isAscending) {
				this.classList.remove('desc');
				this.classList.add('asc');
			} else {
				this.classList.remove('asc');
				this.classList.add('desc');
			}

			// Set sort arrow for the clicked column
			var sortArrow = this.querySelector('.sort-arrow');
			sortArrow.style.visibility = 'visible'; // Show the arrow for the clicked column
			sortArrow.classList.add(isAscending ? 'up' : 'down');

			// Get the table body and rows
			var tableBody = document.querySelector('tbody');
			var rows = Array.from(tableBody.querySelectorAll('tr'));

			// Perform sorting logic based on the 'column' and 'isAscending' values
			rows.sort(function (a, b) {
				var valueA = a.querySelector('td:nth-child(' + (getColumnIndex(column) + 1) + ')').innerText;
				var valueB = b.querySelector('td:nth-child(' + (getColumnIndex(column) + 1) + ')').innerText;

				if (isAscending) {
					return valueA.localeCompare(valueB);
				} else {
					return valueB.localeCompare(valueA);
				}
			});

			// Remove existing table rows
			rows.forEach(function (row) {
				tableBody.removeChild(row);
			});

			// Re-insert sorted table rows
			rows.forEach(function (row) {
				tableBody.appendChild(row);
			});
		});
	}

	function getColumnIndex(columnName) {
		var headings = Array.from(document.querySelectorAll('th'));
		return headings.findIndex(function (heading) {
			return heading.querySelector('.column-heading').getAttribute('data-column') === columnName;
		});
	}
});
document.addEventListener('DOMContentLoaded', function () {
	var openOverlayLinks = document.querySelectorAll('.open-overlay');
	var overlay = document.getElementById('overlay');
	var overlayContent = document.getElementById('overlay-content');

	if (overlay && overlayContent) {
		for (var i = 0; i < openOverlayLinks.length; i++) {
			openOverlayLinks[i].addEventListener('click', function (e) {
				e.preventDefault();
				var routeId = this.getAttribute('data-route-id');
				var userRole = this.getAttribute('data-user-role');
				var data = this.getAttribute('data-button-for');

				if (window.location.pathname.includes('/staff')) {
					fetch('/staff/' + routeId)
						.then(function (response) {
							return response.json();
						})
						.then(function (staff) {
							// Update the overlay content with the staff details
							overlayContent.innerHTML = generateOverlayContentStaff(userRole, staff, data);
							overlay.style.display = 'block';
						})
						.catch(function (error) {
							console.log(error);
						});
				} else if (window.location.pathname.includes('/users')) {
					fetch('/users/' + routeId)
						.then(function (response) {
							return response.json();
						})
						.then(function (user) {
							// Update the overlay content with the user details
							overlayContent.innerHTML = generateOverlayContentUsers(userRole, user, data);
							overlay.style.display = 'block';
						})
						.catch(function (error) {
							console.log(error);
						});
				} else if (window.location.pathname.includes('/bookings')) {
					var status = this.getAttribute('data-status');
					fetch('/bookings/' + routeId)
						.then(function (response) {
							return response.json();
						})
						.then(function (reservation) {
							overlayContent.innerHTML = generateOverlayContentReservations(userRole, reservation, data, status);
							overlay.style.display = 'block';
						})
						.catch(function (error) {
							console.log(error);
						});
				} else if (window.location.pathname.includes('/reservations')) {
					var status = this.getAttribute('data-status');
					fetch('/bookingsUser/' + routeId)
						.then(function (response) {
							return response.json();
						})
						.then(function (reservation) {
							overlayContent.innerHTML = generateOverlayContentReservationsUser(userRole, reservation, data, status);
							overlay.style.display = 'block';
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			});
		}

		overlay.addEventListener('click', function (e) {
			if (e.target === this) {
				this.style.display = 'none';
			}
		});
	}
});

function generateOverlayContentStaff(userRole, staff, data) {
	if (userRole === 'Manager' && data === 'activeStaff') {
		var buttons = `
		<br>
      <a href="/update/staff/${staff.id}" class="btn btn-primary mx-3 mb-4">Update Info</a>
	      <a href="/deactivate/staff/${staff.id}" class="btn btn-warning mx-3 mb-4">Deactivate Account</a>
      <a href="/delete/staff/${staff.id}" class="btn btn-danger mx-3 mb-4">Delete Member</a>
    `;
	} else if (userRole === 'Manager') {
		var buttons = `
		<br>
      <a href="/update/staff/${staff.id}" class="btn btn-primary mx-3 mb-4">Update Info</a>
	      <a href="/activate/staff/${staff.id}" class="btn btn-success mx-3 mb-4">Activate Account</a>
      <a href="/delete/staff/${staff.id}" class="btn btn-danger mx-3 mb-4">Delete Member</a>
    `;
	} else {
		var buttons = '<br>';
	}

	if (data === 'activeStaff') {
		return `
    <img class="profile-picture-js" src="/images/default.jpg" alt="staff_profile_Picture"/>
    <hr style="width:25%;">
    <p>ID: ${staff.id}</p>
    <hr style="width:50%;">
    <p>Name: ${staff.name}</p>
    <p>Position: ${staff.Role}</p>
    <hr style="width:75%;">
    <p>Number: ${staff.phone}</p>
    <p>Email: ${staff.email}</p>
	    <hr>
    ${buttons}
  `;
	}
	if (data === 'inactiveStaff') {
		return `
    <img class="profile-picture-js" src="/images/default.jpg" alt="staff_profile_Picture"/>
    <hr style="width:25%;">
    <p>ID: ${staff.id}</p>
    <hr style="width:50%;">
    <p>Name: ${staff.name}</p>
    <p>Position: ${staff.Role}</p>
    <hr style="width:75%;">
    <p>Number: ${staff.phone}</p>
    <p>Email: ${staff.email}</p>
	    <hr>
    ${buttons}
  `;
	} else {
		return '<h3 class=" mx-5 px-5 mt-5 mb-5 pt-5 pb-5 ">NOTHING TO SEE HERE</h3>';
	}
}

function generateOverlayContentUsers(userRole, user, data) {
	if (userRole === 'Manager' && data === 'activeUsers') {
		var buttons = `
		<br>
        <a href="/update/user/${user.id}" class="btn btn-primary mx-3 mb-4">Update Info</a>
		<a href="/deactivate/user/${user.id}" class="btn btn-warning mx-3 mb-4">Deactivate Account</a>
        <a href="/delete/user/${user.id}" class="btn btn-danger mx-3 mb-4">Delete Account</a>
    `;
	} else if (userRole === 'Manager' && data === 'inactiveUsers') {
		var buttons = `
		<br>
        <a href="/update/user/${user.id}" class="btn btn-primary mx-3 mb-4">Update Info</a>
		<a href="/activate/user/${user.id}" class="btn btn-success mx-3 mb-4">Activate Account</a>
        <a href="/delete/user/${user.id}" class="btn btn-danger mx-3 mb-4">Delete Account</a>
    `;
	} else {
		var buttons = '<br>';
	}
	if (data === 'activeUsers') {
		return `
    <img class="profile-picture-js" src="${user.profile_picture}" alt="user_profile_Picture"/>
    <hr style="width:50%;">
    <p>ID: ${user.id}</p>
    <hr style="width:75%;">
    <p>Name: ${user.name}</p>
    <p>Email: ${user.email}</p>
    <hr>
    <p>Number: ${user.phone}</p>
    <p>Address: ${user.address} ${user.city} ${user.zip}</p>
	    <hr>
    ${buttons}
  `;
	}
	if (data === 'inactiveUsers') {
		return `
   <img class="profile-picture-js" src="${user.profile_picture}" alt="user_profile_Picture"/>
    <hr style="width:25%;">
    <p>ID: ${user.id}</p>
    <hr style="width:50%;">
    <p>Name: ${user.name}</p>
    <p>Email: ${user.email}</p>
    <hr style="width: 75%;">
    <p>Number: ${user.phone}</p>
    <p>Address: ${user.address} ${user.city} ${user.zip}</p>
	    <hr>
    ${buttons}
  `;
	} else {
		return '<h3 class=" mx-5 px-5 mt-5 mb-5 pt-5 pb-5 ">NOTHING TO SEE HERE</h3>';
	}
}

function generateOverlayContentReservations(userRole, reservation, data, status) {
	if (
		(userRole === 'Manager' || userRole == 'Supervisor') &&
		data === 'reservation' &&
		status != 'Canelled by Guest' &&
		status != 'Cancelled by Restaurant' &&
		status != 'No Show' &&
		status != 'Completed' &&
		status != 'Confirmed' &&
		status == 'Awaiting Confirmation'
	) {
		var buttons = `
		<br>
        <a href="/confirm/reservation/${reservation.id}" class="btn btn-success mx-3 mb-4">Confirm Reservation</a>
		<a href="/cancel/reservation/${reservation.id}" class="btn btn-danger mx-3 mb-4">Cancel Reservation</a>
    `;
	} else if (
		(userRole === 'Manager' || userRole == 'Supervisor') &&
		data === 'reservation' &&
		status != 'Canelled by Guest' &&
		status != 'Cancelled by Restaurant' &&
		status != 'No Show' &&
		status != 'Completed' &&
		status == 'Confirmed' &&
		status != 'Awaiting Confirmation'
	) {
		var buttons = `
		<br>
		<a href="/cancel/reservation/${reservation.id}" class="btn btn-danger mx-3 mb-4">Cancel Reservation</a>
		<a href="/complete/reservation/${reservation.id}" class="btn btn-success mx-3 mb-4">Reservation Complete!</a>
		<a href="/no-show/reservation/${reservation.id}" class="btn btn-warning mx-3 mb-4">No Shows!</a>
    `;
	} else {
		var buttons = '<br>';
	}

	if (data === 'reservation') {
		return `
		<div class="text-center justify-content-center>
    <p><strong>ID: ${reservation.id}</strong></p>
	<hr style="width:25%;">
	<strong><p style="text-decoration:underline">Details</p></strong>
    <p>Date: ${reservation.date}</p>
    <p>Time: ${reservation.time}</p>
	<p>People: ${reservation.people}</p>
    <hr style="width:50%;">
	<strong><p style="text-decoration:underline">Contact Details</p></strong>
    <p>Name: ${reservation.name}</p>
	<p>ID: ${reservation.user_id ? reservation.user_id : 'Guest'}</p>
    <p>Email: ${reservation.email}</p>
	<p>Number: ${reservation.phone}</p>
	<hr style="width:75%;">
	
    <p>Special Requests: ${reservation.requests}</p>
	<p>Status: ${reservation.status} </p>
	<hr>
    ${buttons}
	</div>
  `;
	} else {
		return '<h3 class=" mx-5 px-5 mt-5 mb-5 pt-5 pb-5 ">NOTHING TO SEE HERE</h3>';
	}
}

function generateOverlayContentReservationsUser(userRole, reservation, data, status) {
	console.log(reservation);
	console.log(data);
	console.log(status);
	console.log(userRole);
	if (
		data == 'activeReservation' &&
		userRole == 'user' &&
		(status != 'Completed' || status != 'Cancelled by Restaurant' || status != 'Cancelled by Guest' || status != 'No Show')
	) {
		var buttons = `
		<br>
		<a href="/cancel/reservation/${reservation.id}" class="btn btn-danger mx-3 mb-4">Cancel Reservation</a>
    `;
	} else {
		var buttons = '<br>';
	}
	console.log(data);
	if (data === 'activeReservation') {
		return `
		<div class="text-center justify-content-center>
    <p><strong>ID: ${reservation.id}</strong></p>
	<hr style="width:25%;">
	<strong><p style="text-decoration:underline">Details</p></strong>
    <p>Date: ${reservation.date}</p>
    <p>Time: ${reservation.time}</p>
	<p>People: ${reservation.people}</p>
    <hr style="width:50%;">
	<strong><p style="text-decoration:underline">Contact Details</p></strong>
    <p>Name: ${reservation.name}</p>
	<p>ID: ${reservation.user_id ? reservation.user_id : 'Guest'}</p>
    <p>Email: ${reservation.email}</p>
	<p>Number: ${reservation.phone}</p>
	<hr style="width:75%;">
	
    <p>Special Requests: ${reservation.requests}</p>
	<p>Status: ${reservation.status} </p>
	<hr>
    ${buttons}
	</div>
  `;
	} else if (data === 'pastReservation') {
		return `
			<div class="text-center justify-content-center>
    <p><strong>ID: ${reservation.id}</strong></p>
	<hr style="width:25%;">
	<strong><p style="text-decoration:underline">Details</p></strong>
    <p>Date: ${reservation.date}</p>
    <p>Time: ${reservation.time}</p>
	<p>People: ${reservation.people}</p>
    <hr style="width:50%;">
	<strong><p style="text-decoration:underline">Contact Details</p></strong>
    <p>Name: ${reservation.name}</p>
	<p>ID: ${reservation.user_id ? reservation.user_id : 'Guest'}</p>
    <p>Email: ${reservation.email}</p>
	<p>Number: ${reservation.phone}</p>
	<hr style="width:75%;">
	
    <p>Special Requests: ${reservation.requests}</p>
	<p>Status: ${reservation.status} </p>
	<hr>
	</div>
    ${buttons}
  `;
	} else {
		return `
			<div class="text-center justify-content-center><p><strong>ID: ${reservation.id}</strong></p>
	<hr style="width:25%;">
	<strong><p style="text-decoration:underline">Details</p></strong>
    <p>Date: ${reservation.date}</p>
    <p>Time: ${reservation.time}</p>
	<p>People: ${reservation.people}</p>
    <hr style="width:50%;">
	<strong><p style="text-decoration:underline">Contact Details</p></strong>
    <p>Name: ${reservation.name}</p>
	<p>ID: ${reservation.user_id ? reservation.user_id : 'Guest'}</p>
    <p>Email: ${reservation.email}</p>
	<p>Number: ${reservation.phone}</p>
	<hr style="width:75%;">
	
    <p>Special Requests: ${reservation.requests}</p>
	<p>Status: ${reservation.status} </p>
	<hr></div>`;
	}
}
document.addEventListener('DOMContentLoaded', function () {
	var openOverlayLinks = document.querySelectorAll('.open-overlay-orders');
	var overlay = document.getElementById('overlay');
	var overlayContent = document.getElementById('overlay-content');

	if (overlay && overlayContent) {
		for (var i = 0; i < openOverlayLinks.length; i++) {
			openOverlayLinks[i].addEventListener('click', function (e) {
				e.preventDefault();
				var info = this.getAttribute('data-info');
				var routeId = this.getAttribute('data-id');
				var status = this.getAttribute('data-status');
				var final = this.getAttribute('data-final');
				fetch('/orders-active/' + routeId)
					.then(function (response) {
						return response.json(); // Parse the response JSON
					})
					.then(function (order) {
						fetch('/order-details/' + routeId)
							.then(function (response) {
								return response.json(); // Parse the response JSON
							})
							.then(function (orderMain) {
								overlayContent.innerHTML = generateOverlayContent(order, routeId, orderMain, info, status, final);
								overlay.style.display = 'block';
							})
							.catch(function (error) {
								console.log(error);
							});
					})
					.catch(function (error) {
						console.log(error);
					});
			});
		}

		overlay.addEventListener('click', function (e) {
			if (e.target === this) {
				this.style.display = 'none';
			}
		});
	}
});

function generateOverlayContent(order, routeId, orderMain, info, status, final) {
	if (
		info == 'staff' &&
		status != 'Order Cancelled' &&
		status != 'Order Ready for Pick-up' &&
		status != 'Order Being Delivered to You!' &&
		status != 'Order Completed'
	) {
		console.log('Order accepted');
		//staff buttons
		buttons = `
		<br>
		<a href="/staff/cancel-order/${routeId}" class="btn btn-danger">Cancel Order</a>
		<a href="/staff/order-ready/${routeId}" class="btn btn-primary">Order Ready</a>
		<br>
    `;
	} else if (info === 'staff' && status === 'Order Ready for Pick-up' && !final) {
		buttons = `
    <br>
    <a href="/staff/delivery/${routeId}" class="btn btn-primary">Order picked up for delivery</a>
    <a href="/staff/process-order/${routeId}" class="btn btn-success">Process to Past Orders (picked-up)</a>
    <br>
	`;
	} else if (info == 'staff' && status == 'Order Being Delivered to You!') {
		buttons = `<br><a href="/staff/process-order/${routeId}" class="btn btn-success">Process to Past Orders</a><br>`;
	} else if (info == 'staff' && status == 'Order Cancelled') {
		buttons = `<br><a href="/staff/process-order-cancelled/${routeId}" class="btn btn-success">Process to Past Orders and Refund</a><br>`;
	} else {
		buttons = `<br>`;
	}

	//if the order is completed hide the buttons
	if (info == 'staff' && (status == 'Order Cancelled!' || status == 'Order Completed') && final == 'true') {
		buttons = '<br>';
	}
	//rate Order Button
	if (info == 'user' && status == 'Order Completed' && final == 'true') {
		console.log(orderMain.rated);
		if (orderMain.rated === 'false') {
			buttons = `<br> <a href="/rate-order/${routeId}" class="btn btn-primary">Rate Order</a>`;
		} else {
			buttons = `<br>`;
		}
	}

	//USER buttons
	else if (
		info == 'user' &&
		status != 'Order Cancelled!' &&
		status != 'Order Cancelled' &&
		status != 'Order Ready for Pick-up' &&
		status != 'Order Being Delivered to You!'
	) {
		buttons = `
		<br>
		<a href="/user/cancel-order/${routeId}" class="btn btn-danger">Cancel Order</a>
    `;
	} else if (info == 'user' && status == 'Order Canelled!') {
		buttons = `
		<br> 
		<strong style="background-color:green;">Please Await Refund</strong>
		`;
	} else if (info == 'user' && status == 'Order Ready for Pick-up' && status == 'Order Being Delivered to You!') {
		buttons = `
		<br> 
		`;
	} else if (info == 'user' && status == 'Order Cancelled!' && final == 'true')
		buttons = `
		<br> 
		`;

	var content = `
        <div class="text-center">
            <strong>Order Number: ${routeId}</strong><br>
            <strong>Date: ${orderMain.date}</strong><br>
            <strong>Time Ordered: ${orderMain.time}</strong><br>
            <hr style="width: 75%">
    `;

	for (var i = 0; i < order.length; i++) {
		content += `
            <strong>${order[i].product_name}</strong>
            <br>
            <strong>${order[i].price}€ x ${order[i].quantity}</strong>
            <br>
            <strong>Total: ${order[i].price * order[i].quantity}€</strong>
            <br><hr style="width: 50%">
        `;
	}

	if (orderMain.status === 'Order Cancelled') {
		content += `<strong>Status: <span id="status" style="background-color: red;">${orderMain.status}</span></strong>`;
	} else {
		content += `<strong>Status: ${orderMain.status}</strong>`;
	}

	content += `
		<br>
        <strong>Total Tax: ${orderMain.only_vat} €</strong>
        <br>
        <strong>Total: ${orderMain.total_excluding_vat} €</strong>
        <br>
        <strong>Delivery Method: ${orderMain.delivery_method}</strong>
        <br>
        <strong>For: ${orderMain.time_to_deliver}</strong>
        <br>
		<strong>Requests: ${orderMain.order_notes}</strong>
		<br>
        ${buttons}
    </div>`;

	return content;
}
document.addEventListener('DOMContentLoaded', function () {
	var selectElement = document.getElementById('table-select');

	if (selectElement) {
		var urlParams = new URLSearchParams(window.location.search);
		var selectedOption = urlParams.get('selected');

		if (selectedOption) {
			selectElement.value = selectedOption;
			showTable(selectedOption);
		}

		selectElement.addEventListener('change', function () {
			var selectedOption = selectElement.value;
			showTable(selectedOption);
		});
	}

	function showTable(selectedOption) {
		var tables = document.querySelectorAll('.table');
		tables.forEach(function (table) {
			if (table.id === 'table-' + selectedOption) {
				table.style.display = 'table';
			} else {
				table.style.display = 'none';
			}
		});
	}
});

function showTable(selectedOption) {
	var tables = document.querySelectorAll('.table');
	tables.forEach(function (table) {
		if (table.id === 'table-' + selectedOption) {
			table.style.display = 'table';
		} else {
			table.style.display = 'none';
		}
	});

	var completedTable = document.getElementById('table-completed');
	if (selectedOption !== 'completed') {
		completedTable.style.display = 'none';
	} else {
		completedTable.style.display = 'table';
	}
}

//Search Function
function searchTables(tableIds) {
	var input = document.getElementById('searchInput').value.toLowerCase();

	tableIds.forEach(function (tableId) {
		var table = document.getElementById(tableId);
		var rows = table.getElementsByTagName('tr');

		for (var j = 0; j < rows.length; j++) {
			var rowData = rows[j].getElementsByTagName('td');
			var match = false;

			for (var k = 0; k < rowData.length; k++) {
				var cellData = rowData[k].innerText.toLowerCase();
				if (cellData.includes(input)) {
					match = true;
					break;
				}
			}

			if (match) {
				rows[j].style.display = '';
			} else {
				rows[j].style.display = 'none';
			}
		}
	});
}

document.addEventListener('DOMContentLoaded', function () {
	var backToTopButton = document.getElementById('backToTopButton');
	backToTopButton.style.display = 'none';
	// Show the button when user scrolls down
	window.addEventListener('scroll', function () {
		if (window.scrollY > 1000) {
			backToTopButton.style.display = 'block';
		} else {
			backToTopButton.style.display = 'none';
		}
	});

	// Scroll back to top when the button is clicked
	backToTopButton.addEventListener('click', function () {
		scrollToTop(1500); // Scroll to top with a duration of 500ms (0.5 seconds)
	});

	// Smooth scroll to top function
	function scrollToTop(duration) {
		var startingY = window.scrollY;
		var startTime = performance.now();

		function scrollStep(timestamp) {
			var currentTime = timestamp || performance.now();
			var elapsed = currentTime - startTime;
			var ease = easeInOutQuad(elapsed, startingY, -startingY, duration);
			window.scrollTo(0, ease);

			if (elapsed < duration) {
				requestAnimationFrame(scrollStep);
			}
		}

		function easeInOutQuad(t, b, c, d) {
			t /= d / 2;
			if (t < 1) return (c / 2) * t * t + b;
			t--;
			return (-c / 2) * (t * (t - 2) - 1) + b;
		}

		requestAnimationFrame(scrollStep);
	}
});
var now = new Date();
now.setMinutes(now.getMinutes() + 30); // Add 30 minutes to the current time
var hours = now.getHours();
var minutes = now.getMinutes();

// Format the time as HH:MM
var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

// Set the formatted time as the default value for the input field
var timeInput = document.getElementById('timeInput');
if (timeInput) {
	timeInput.value = formattedTime;
}

// JavaScript code for previewing the uploaded image
document.getElementById('image')?.addEventListener('change', function (e) {
	var imagePreview = document.getElementById('imagePreview');
	imagePreview.src = URL.createObjectURL(e.target.files[0]);
});
