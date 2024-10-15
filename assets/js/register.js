$(document).ready(function () {
    // Handle form submission using jQuery AJAX
    $('#registerForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            type: 'POST',
            url: './api/register_handler.php',
            data: $(this).serialize(), // Send form data
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.href = 'login.php'; // Redirect to login page
                    });
                } else {
                    // Show error SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
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
