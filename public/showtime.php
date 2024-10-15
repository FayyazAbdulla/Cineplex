<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the file that fetches showtimes
include './api/fetch_showtimes.php';

// Check if the connection was established (optional)
if (!isset($conn) || $conn === false) {
    die("Error: Database connection failed.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtimes</title>
    <link rel="stylesheet" href="../assets/css/showtime.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>

<body>
    <!-- Header section -->
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <h2 class="section-title">Movie Showtimes</h2>

        <!-- Search form -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search for a movie..." value="<?php echo htmlspecialchars($searchQuery); ?>" >
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </form>

        <div class="card-container">
            <?php if (!empty($showtimes)): ?>
                <?php foreach ($showtimes as $showtime): ?>
                    <div class="card">
                    <a href="booking.php" class="nav-link">
                        <div class="card-icon">
                            <i class="fas fa-film"></i> <!-- Movie icon -->
                        </div>
                        
                        <div class="card-content">
                            <h3 class="movie-title"><?php echo htmlspecialchars($showtime['title']); ?></h3>
                            <p class="showtime">Showtime: <?php echo htmlspecialchars($showtime['showtime']); ?></p>
                        </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No showtimes available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer section -->
    <?php include '../includes/footer.php'; ?>
</body>

</html> 
