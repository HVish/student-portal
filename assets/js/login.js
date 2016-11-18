$(document).ready(function() {
    // handle click event on form submit
    $('.form-signin').submit(function (e) {
		// prevent default submission of sign-in form
		e.preventDefault();
		// get input entries
		var username = $("input[name=username]");
		var password = $("input[name=password]");
		//little validation just to check username
        if (username.val() != "" && password.val() != "") {
			// start loader
			document.dispatchEvent(new CustomEvent('loadingStart'));
			// ajax request to server to authenticate by post method
            $.post($(this).attr('action'), {
                username: username.val(),
                password: password.val()
            }, function(data) {
				// stop loader
				document.dispatchEvent(new CustomEvent('loadingComplete'));
                if (data == "unautherized") {
					new PNotify({
						title: 'Failed!',
						text: 'Wrong credentials!',
						type: 'error',
						styling: 'bootstrap3'
					});
                } else {
					location.reload();
                }
            });
        } else {
			// $('.login-error').fadeIn();
			new PNotify({
				title: 'Failed!',
				text: 'Please Fill All Fields!',
				type: 'info',
				styling: 'bootstrap3'
			});
        }
    });
});
