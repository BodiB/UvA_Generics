grecaptcha.ready(function() {
	grecaptcha.execute(public_key, {
		action: 'contact'
	}).then(function(token) {
		var recaptchaResponse = document.getElementById('recaptchaResponse');
		recaptchaResponse.value = token;
	});
});
