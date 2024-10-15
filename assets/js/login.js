$(document).ready(function () {
    // Handle form submission using jQuery AJAX
    $('#loginForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            type: 'POST',
            url: './api/login_handler.php', // URL to the PHP handler
            data: $(this).serialize(), // Send form data
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.href = 'home.php'; // Redirect to a protected page
                    });
                } else {
                    // Show error SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function () {
                // Handle any unexpected errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
