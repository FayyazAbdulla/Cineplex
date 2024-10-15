<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="../assets/js/register.js" defer></script> <!-- Include the register.js file -->
</head>

<body>

    <!-- Header section -->
    <?php include '../includes/header.php'; ?>

    <section class="register-section">
        <div class="register-container">
            <form id="registerForm" method="POST" action="./api/register_handler.php">
                <h2>Register</h2>
                <div class="label-icon">
                    <i class="fas fa-user"></i>
                    <label for="username">Username</label>
                </div>
                <input type="text" name="username" id="username" required>

                <div class="label-icon">
                    <i class="fas fa-envelope"></i>
                    <label for="email">Email</label>
                </div>
                <input type="email" name="email" id="email" required>

                <div class="label-icon">
                    <i class="fas fa-lock"></i>
                    <label for="password">Password</label>
                </div>
                <input type="password" name="password" id="password" required>

                <button type="submit">Register</button>
                <div class="message">Already have an account? <a href="login.php">Login here</a></div>
            </form>
        </div>
    </section>

    <!-- Footer section -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>
