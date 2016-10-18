$(document).ready(function() {
    // get input entries
    var username = $("input[name=user]");
    var password = $("input[name=pass]");

    // handle click event on form submit
    $('button[type="submit"]').click(function(e) {
        // override default form submission
        e.preventDefault();
        //little validation just to check username
        if (username.val() != "" && password.val() != "") {
			// ajax request to server to authenticate by post method
            $.post(baseurl + 'home/login', {
                username: username.val(),
                password: password.val()
            }, function(data) {
                if (data == "unautherized") {
                    $("#output").removeClass(' alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Wrong credentials!!");
                } else {
                    $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome " + "<span>" + username.val() + "</span>");
                    $("#output").removeClass(' alert-danger');
                    $("input").css({
                        "height": "0",
                        "padding": "0",
                        "margin": "0",
                        "opacity": "0"
                    });
                    //change button text
                    $('button[type="submit"]').html("continue")
                        .removeClass("btn-info")
                        .addClass("btn-default").click(function() {
                            location.reload();
                        });
                }
            });
        } else {
            //remove success mesage replaced with error message
            $("#output").removeClass(' alert alert-success');
            $("#output").addClass("alert alert-danger animated fadeInUp").html("All fields are required!");
        }
    });
});
