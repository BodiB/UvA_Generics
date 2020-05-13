grecaptcha.ready(function() {
	grecaptcha.execute('6LcpSOsUAAAAAKk5EE2MoABHbM75mpNUHz_dlQ3r', {
		action: 'contact'
	}).then(function(token) {
		var recaptchaResponse = document.getElementById('recaptchaResponse');
		recaptchaResponse.value = token;
	});
});
