$(document).ready(function () {
	$('.name').keyup(function () {
		var name = $(this).val();
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
	});
});
$(document).ready(function () {
	var emailIsValid = true;

	$('.email').on('keyup', function () {
		var email = $(this).val();
		emailIsValid = validateEmailFormat(email);
	});

	$('.email').on('blur', function () {
		if (!emailIsValid) {
			$('.email-notice').html('<p class="error">Invalid email format</p>').removeClass('available');
		} else {
			$('.email-notice').empty();
		}
	});

	$('.emailuser').on('keyup blur', function () {
		var email = $(this).val();
		if (emailIsValid) {
			validateEmail(email, '/registeremailuser');
		}
	});

	function validateEmailFormat(email) {
		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
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
		});
	}

	function handleEmailValidationResponse(response) {
		var noticeElement = $('.email-notice');

		if (response.available) {
			noticeElement.html('<p class="good">Email is available!</p>').removeClass('unavailable').addClass('available');
		} else {
			noticeElement.html('<p class="error">Email already registered!</p>').removeClass('available').addClass('invalid');
		}
	}
});
$(document).ready(function () {
	$('.password').keyup(function () {
		var password = $(this).val();
		var noticeElement = $('.password-notice');
		var cpassword = $('.confirm-password').val();
		var cnoticeElement = $('.confirm-password-notice');

		if (password.length < 4) {
			noticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
			cnoticeElement.html('');
		} else {
			if (password.length >= 4 && cpassword.length >= 4) {
				if (cpassword === password) {
					noticeElement.html("<p class='good'>Passwords match</p>");
					cnoticeElement.html("<p class='good'>Passwords match</p>");
				} else {
					noticeElement.html("<p class='error'>Passwords do not match</p>");
					cnoticeElement.html("<p class='error'>Passwords do not match</p>");
				}
			} else {
				cnoticeElement.html('');
			}

			if (password.length === 0 && cpassword.length === 0) {
				noticeElement.html('');
				cnoticeElement.html('');
			}
		}
	});

	$('.confirm-password').keyup(function () {
		var password = $('.password').val();
		var cpassword = $(this).val();
		var noticeElement = $('.password-notice');
		var cnoticeElement = $('.confirm-password-notice');

		if (password.length < 4 || cpassword.length < 4) {
			noticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
			cnoticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
			return;
		}

		if (cpassword === password) {
			noticeElement.html("<p class='good'>Passwords match</p>");
			cnoticeElement.html("<p class='good'>Passwords match</p>");
		} else {
			noticeElement.html("<p class='error'>Passwords do not match</p>");
			cnoticeElement.html("<p class='error'>Passwords do not match</p>");
		}

		if (password.length === 0 && cpassword.length === 0) {
			noticeElement.html('');
			cnoticeElement.html('');
		}
	});
});

$(document).ready(function () {
	$('.phone').keyup(function () {
		var number = $(this).val();
		var phoneNotice = $('.phone-notice');
		var regex = /^(\+|00)?([0-9]+)$/;

		if (!regex.test(number)) {
			phoneNotice.html('<p class="error">Phone number should contain only numbers</p>');
		} else {
			phoneNotice.text('');
		}
	});
});

// ENTER NEW PASSWORD VALIDATION ----------------------
$(document).ready(function () {
	$('.new-password').keyup(function () {
		var password = $(this).val();
		var noticeElement = $(this).closest('.form-floating').find('.new-password-notice');
		var cpassword = $(this).closest('.custom-form').find('.confirm-new-password').val();
		var cnoticeElement = $(this).closest('.custom-form').find('.confirm-new-password-notice');

		if (password.length < 4) {
			noticeElement.html('<p class="error">Password must be a minimum of 4 characters long</p>');
		} else {
			noticeElement.html('');
		}

		if (password.length >= 4 && cpassword.length >= 4) {
			if (cpassword === password) {
				noticeElement.html("<p class='good'>Passwords match</p>");
				cnoticeElement.html("<p class='good'>Passwords match</p>");
			} else {
				noticeElement.html("<p class='error'>Passwords do not match</p>");
				cnoticeElement.html("<p class='error'>Passwords do not match</p>");
			}
		} else {
			cnoticeElement.html('');
		}
	});

	$('.confirm-new-password').keyup(function () {
		var password = $(this).closest('.custom-form').find('.new-password').val();
		var cpassword = $(this).val();
		var noticeElement = $(this).closest('.custom-form').find('.new-password-notice');
		var cnoticeElement = $(this).closest('.custom-form').find('.confirm-new-password-notice');

		if (cpassword === password) {
			noticeElement.html("<p class='good'>Passwords match</p>");
			cnoticeElement.html("<p class='good'>Passwords match</p>");
		} else {
			noticeElement.html("<p class='error'>Passwords do not match</p>");
			cnoticeElement.html("<p class='error'>Passwords do not match</p>");
		}
	});
});

$(document).ready(function () {
	var emailIsValid = true;

	$('.email').on('keyup', function () {
		var email = $(this).val();
		emailIsValid = validateEmailFormat(email);
	});

	$('.emailstaff').on('blur', function () {
		if (!emailIsValid) {
			$('.email-notice').html('<p class="error">Invalid email format</p>').removeClass('available');
		} else {
			$('.email-notice').empty();
		}
	});

	$('.emailstaff').on('keyup blur', function () {
		var email = $(this).val();
		if (emailIsValid) {
			validateEmail(email, '/registeremailstaff');
		}
	});

	function validateEmailFormat(email) {
		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
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
		});
	}

	function handleEmailValidationResponse(response) {
		var noticeElement = $('.email-notice');

		if (response.available) {
			noticeElement.html('<p class="good">Email is available!</p>').removeClass('unavailable').addClass('available');
		} else {
			noticeElement.html('<p class="error">Email already registered!</p>').removeClass('available').addClass('invalid');
		}
	}
});
