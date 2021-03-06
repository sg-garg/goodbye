// This entire form is just for lost password
// Validate email address
$('#email').plum('form.verify', { method: 'email' });

$('#email-retype').plum('form.verify', function () {
	var email = $('#email').val();
	return email && email === this.value;
});

//$('#user_name').plum('form.verify', { min: 3 }, function () { return /[a-zA-Z]/.test(this.value);});

// Custom validation: username must be all lowercase and minimum 4 characters
$('#user_name').plum('form.verify', function () {
	return /[a-z]{4}/.test(this.value);
});

// Custom validation: coupon code (groupon) must have 8 numbers
$('#txt2').plum('form.verify', function () {
	return /[\d]{8}/.test(this.value);
});
