$(document).ready(function() {
    $('#signin-form').submit(function(e) {
        alert("test");
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "/login",
            data: {
                email: email,
                password: password
            },
            dataType: "json",
            encode: true,
            success: function(data) {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    $('#error-message').text(data.message);
                    $('#error-message').show();
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                $('#error-message').text("An error occurred. Please try again.");
                $('#error-message').show();
            }
        });
    });
});