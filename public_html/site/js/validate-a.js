$('form').plum('form', { 
ajax: true, 
labels: true, 
action: null
shake: true
complete: function (result) {
alert(result);
}


 });

$('#uname').plum('form.verify', { min: 5 });

$('#password').plum('form.verify', { min: 5 });

$('#password-retype').plum('form.verify', function () {
	var password = $('#password').val();
	return password && password === this.value;
});

