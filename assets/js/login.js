$(document).ready(function() {
	$('.login-error').hide();

    // handle click event on form submit
    $('.form-signin').submit(function (e) {
		// prevent default submission of sign-in form
		e.preventDefault();
		// get input entries
		var username = $("input[name=username]");
		var password = $("input[name=password]");
		//little validation just to check username
        if (username.val() != "" && password.val() != "") {
			// ajax request to server to authenticate by post method
            $.post($(this).attr('action'), {
                username: username.val(),
                password: password.val()
            }, function(data) {
                if (data == "unautherized") {
                    $('.login-error').fadeIn();
                } else {
					$('.login-error').fadeOut(function () {
						location.reload();
					});
                }
            });
        } else {
			$('.login-error').fadeIn();
        }
    });
});
