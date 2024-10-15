<?php
// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
    <div class="logo">
        <i class="fas fa-film logo-icon"></i>
        <a href="home.php" class="nav-link">
            <h1 class="logo-text">Cineplex</h1>
        </a>
    </div>
    <nav class="navbar">
        <div class="nav-toggle" id="nav-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-list">
            <li class="nav-item"><a href="home.php" class="nav-link">Movies</a></li>
            <li class="nav-item"><a href="showtime.php" class="nav-link">Showtimes</a></li>
            <li class="nav-item"><a href="booking.php" class="nav-link">Booking</a></li>
            <li class="nav-item">
                <button id="theme-toggle" class="theme-toggle">🌙</button>
            </li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="welcome-message">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</li>
                <li class="nav-item">
                    <a href="logout.php" class="logout-icon" title="Logout">
                        <i class="fas fa-sign-out-alt"></i> <!-- Logout icon -->
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- JavaScript to toggle the navigation menu on small screens -->
<script>
    const navToggle = document.getElementById('nav-toggle');
    const navList = document.querySelector('.nav-list');

    navToggle.addEventListener('click', () => {
        navList.classList.toggle('active');
    });
</script>
