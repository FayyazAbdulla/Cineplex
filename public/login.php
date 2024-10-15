<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="../assets/js/login.js" defer></script> <!-- Include the login.js file -->
</head>

<body>

    <!-- Header section -->
    <?php include '../includes/header.php'; ?>

    <section class="login-section">
        <div class="login-container">
            <form id="loginForm" method="POST">
                <h2>Login</h2>
                <div class="label-icon">
                    <i class="fas fa-user"></i>
                    <label for="username">Username</label>
                </div>
                <input type="text" name="username" id="username" required>

                <div class="label-icon">
                    <i class="fas fa-lock"></i>
                    <label for="password">Password</label>
                </div>
                <input type="password" name="password" id="password" required>

                <button type="submit">Login</button>
                <div class="message">Don't have an account? <a href="register.php">Register here</a></div>
            </form>
        </div>
    </section>

    <!-- Footer section -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>
