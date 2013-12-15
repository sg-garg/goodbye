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

$('#checkbox').plum('form.verify', function () {
    return this.checked;
});


$(':file').plum('form' {
	ajax: true,
	json: true,
	action: null,
	shake: true,
	files: 1,
	file: {
		button: 'Upload New Avatar',
		autoupload: true,
		html: '{avatar/<?php echo $data_u; ?>.jpg} {10000}',
		size: 2097152,
		types: [ 'image/png', 'image/jpeg' ],
		start: function () { $(this).css('border', '5px solid green');},
		progress: function (event) { $('div.progress div',
		 this).css('width', event.percent + '%');},
		complete: function (event, result) { if (result === 'File uploaded.') {
		alert('File has been successfully uploaded.');
		} else {
		alert('File failed to upload.');
}}
}});

