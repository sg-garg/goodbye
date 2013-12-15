$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});


$('#fname').plum('form.verify', { min: 1 });

$('#lname').plum('form.verify', { min: 1 });

//$('#about').plum('form.verify', { min: 5 });
//$('#uname').plum('form.verify', { min: 5 });

$('#password').plum('form.verify', { min: 5 });

// Validate email address
$('#email').plum('form.verify', { method: 'email' });

$('#email-retype').plum('form.verify', function () {
	var email = $('#email').val();
	return email && email === this.value;
});

// Validate telephone number
$('#tel').plum('form.verify', { method: 'tel' });

// Validate URL
$('#url').plum('form.verify', { method: 'url' });

// Custom validation: the password fields must begin with 3 letters and
// end with 3 numbers and both fields must match
//$('#password').plum('form.verify', function () {
//	return /^[a-zA-Z]{3}[\d]{3}$/.test(this.value);
//});

$('#password-retype').plum('form.verify', function () {
	var password = $('#password').val();
	return password && password === this.value;
});

// Adding form elements on the fly
// These are of course, only examples. You can load via AJAX entire pages
// that contain forms


// Example resizing on open/close
var open_close_width;
$('#open-close').bind({
	open: function () {
		// We need the width of the outer wrapper so we know what to go back
		// to after the menu is closed.
		var wrapper = $(this).parent();
		open_close_width = wrapper.width();
		// Then change the width of the wrapper and the options container
		$('ul.select-container', wrapper).add(wrapper)
			.animate({ width: 300 }, 150);
	},
	close: function () {
		var wrapper = $(this).parent();
		// Now we need to adjust the containers back to their original widths
		$('ul.select-container', wrapper).add(wrapper)
			.animate({ width: open_close_width }, 150);
	}
});
