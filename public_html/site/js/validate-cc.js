$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

// Validate cc
$('#UMcard').plum('form.verify', function () {
//return /^[a-zA-Z]{3}[\d]{3}$/.test(this.value);
	return /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/.test(this.value); //credit card alogorithm
		
});

$('#UMexpir').plum('form.verify', function () {
	return /^0[1-9]|^(11)|^(12)[0-9][0-9]$/.test(this.value); //MMYY
		
});

$('#UMcvv2').plum('form.verify', function () {
	return /^[0-9]{3,4}$/.test(this.value); //123 or 1234
		
});
