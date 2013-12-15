$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

// Validate email address - for LOGIN
$('#email').plum('form.verify', { method: 'email' });
$('#password').plum('form.verify', { min: 6 });


// This below is JOIN form
$('#join').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#fname').plum('form.verify', { min: 1 });
$('#lname').plum('form.verify', { min: 1 });
$('#tos').plum('form.verify', { min: 1 });

// Validate email address - for JOIN
$('#emailj').plum('form.verify', { method: 'email' });
$('#email-retypej').plum('form.verify', function () {
	var emailval = $('#emailj').val();
	//return email && email === this.value;
	//return emailj && this.value === value;
	return emailval && emailval === this.value;
});

// Validate password - this check for 3 letters and 3 numbers
$('#passwordj').plum('form.verify', function () {
//return /^[a-zA-Z]{3}[\d]{3}$/.test(this.value);
	return /^.*(?=.{6,})(?=.*[a-zA-Z])[a-zA-Z0-9]+$/.test(this.value); //6 char, 1 let
		
});

$('#password-retypej').plum('form.verify', function () {
// Get the value of the "password" field
var pwvalue = $('#passwordj').val();
// Check that the "password" field is populated and that it matches the
// value of this field. 
//return pwvalue && this.value === value;
return pwvalue && pwvalue === this.value;
});

// birthday mm/dd/yyyy
$('#birthday').plum('form.verify', function () { return /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/.test(this.value) && /[0-9]/.test(this.value);
});

// id="tos" Validate Terms of Service radio button