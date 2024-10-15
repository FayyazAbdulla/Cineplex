<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cineplex - Movie Theatre in Kandy</title>
    <link rel="stylesheet" href="../assets/css/home.css"> <!-- External CSS -->
    <script src="../assets/js/home.js" defer></script> <!-- External JavaScript -->
    <link rel="icon" href="assets/images/logo.png" type="image/png"> <!-- Website Logo -->
    <!-- Include Font Awesome CDN in your HTML head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../assets/css/footer.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <i class="fas fa-film logo-icon"></i>
            <a href="#welcome" class="nav-link">
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
                <li class="nav-item"><a href="#movies" class="nav-link">Movies</a></li>
                <li class="nav-item"><a href="#showtimes" class="nav-link">Showtimes</a></li>
                <li class="nav-item"><a href="#booking" class="nav-link">Booking</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                <li class="nav-item">
                    <button id="theme-toggle" class="theme-toggle">🌙</button> <!-- Dark/Light Mode Toggle -->
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


    <main class="main-content" id="welcome">
        <section class="hero">
            <div class="hero-content">
                <section class="hero-section">
                    <h2 class="hero-title">Welcome to Cineplex</h2>
                    <p class="hero-description">Experience the magic of movies like never before!</p>
                    <a href="#movies" class="hero-button">View Movies</a>
                </section>

            </div>
        </section>


        <section id="movies" class="movies-section">
            <h2 class="section-title">Now Showing</h2>
            <div class="movies-list">

                <!-- Movie Item -->
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/Inception.jpg" alt="Inception"
                        class="movie-poster">
                    <h3 class="movie-title">Inception</h3>
                    <p class="movie-description">A thief steals corporate secrets through dream-sharing technology.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/TheDarkKnight.jpg" alt="The Dark Knight"
                        class="movie-poster">
                    <h3 class="movie-title">The Dark Knight</h3>
                    <p class="movie-description">The Joker wreaks havoc in Gotham, challenging Batman.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/interstellar.jpg" alt="Interstellar"
                        class="movie-poster">
                    <h3 class="movie-title">Interstellar</h3>
                    <p class="movie-description">Explorers travel through a wormhole in search of humanity's survival.
                    </p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/Avatar.jpg" alt="Avatar"
                        class="movie-poster">
                    <h3 class="movie-title">Avatar</h3>
                    <p class="movie-description">A paraplegic Marine dispatched to the moon Pandora on a unique mission.
                    </p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/Titanic.jpg" alt="Titanic"
                        class="movie-poster">
                    <h3 class="movie-title">Titanic</h3>
                    <p class="movie-description">A seventeen-year-old aristocrat falls in love with a kind but poor
                        artist.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/GodFather.jpg" alt="The Godfather"
                        class="movie-poster">
                    <h3 class="movie-title">The Godfather</h3>
                    <p class="movie-description">The aging patriarch of an organized crime dynasty transfers control to
                        his reluctant son.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/ForrestGump.jpg" alt="Forrest Gump"
                        class="movie-poster">
                    <h3 class="movie-title">Forrest Gump</h3>
                    <p class="movie-description">The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate
                        scandal, and other historical events unfold through the perspective of an Alabama man.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/PulpFiction .jpg" alt="Pulp Fiction"
                        class="movie-poster">
                    <h3 class="movie-title">Pulp Fiction</h3>
                    <p class="movie-description">The lives of two mob hitmen, a boxer, a gangster's wife, and a pair of
                        diner bandits intertwine in four tales of violence and redemption.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/thematrix.jpg" alt="The Matrix"
                        class="movie-poster">
                    <h3 class="movie-title">The Matrix</h3>
                    <p class="movie-description">A computer hacker learns from mysterious rebels about the true nature
                        of his reality and his role in the war against its controllers.</p>
                </div>
                <div class="movie-item">
                    <img src="http://localhost:8080/CinePlex/assets/images/Gladiator.jpg" alt="Gladiator"
                        class="movie-poster">
                    <h3 class="movie-title">Gladiator</h3>
                    <p class="movie-description">A former Roman general sets out to exact vengeance against the corrupt
                        emperor who murdered his family and sent him into slavery.</p>
                </div>

            </div>
        </section>






        <!-- show time section -->

        <section id="showtimes" class="showtimes-section">
            <h2 class="section-title">Showtimes</h2>
            <p class="showtime-description">Check our latest showtimes and book your tickets!</p>

            <?php
            // Include the PHP file that fetches the showtimes
            include './api/fetch_showtimes.php';

            // Check if the $showtimes array is set and not empty
            if (isset($showtimes) && !empty($showtimes)): ?>
                <ul class="showtime-list">
                    <?php foreach ($showtimes as $showtime): ?>
                        <a href="showtime.php" class="nav-link">
                            <li class="showtime-item">
                                <!-- Movie Icon -->
                                <i class="fas fa-film"></i>
                                <strong><?php echo htmlspecialchars($showtime['title']); ?></strong>
                                <?php echo date('l, F j, Y \a\t g:ia', strtotime($showtime['showtime'])); ?>
                            </li>
                        </a>

                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No showtimes available at the moment.</p>
            <?php endif; ?>
        </section>




        <!-- booking section -->
        <section id="booking" class="booking-section">
            <h2 class="section-title">Book Your Tickets</h2>
            <p class="booking-description">Secure your seats for the latest blockbuster hits.</p>

            <!-- Booking form link button -->
            <a href="booking.php" class="booking-button">Book Now</a>
        </section>



        <!-- FAQ section -->
        <section id="faq" class="faq-section">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <h3 class="faq-question">🎥 What movies are currently showing?</h3>
                    <p class="faq-answer">You can check our <a href="#movies" class="faq-link">Movies</a> section for
                        the latest releases and showtimes.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">💳 How can I book tickets?</h3>
                    <p class="faq-answer">To book tickets, simply visit our <a href="#booking"
                            class="faq-link">Booking</a> page and follow the instructions.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">🕒 What are the showtimes for each movie?</h3>
                    <p class="faq-answer">Our <a href="#showtimes" class="faq-link">Showtimes</a> section provides all
                        the information you need about movie times.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">📞 How can I contact customer support?</h3>
                    <p class="faq-answer">You can reach out to us through the <a href="#contact"
                            class="faq-link">Contact</a> section for any inquiries.</p>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">❓ Do you offer discounts for group bookings?</h3>
                    <p class="faq-answer">Yes! We have special rates for group bookings. Please check our <a
                            href="#booking" class="faq-link">Booking</a> page for more details.</p>
                </div>
            </div>
        </section>



        <!-- Contact Us Section -->
        <section id="contact" class="contact-section">
            <h2 class="section-title">Contact Us</h2>
            <p class="contact-description">Have questions? Get in touch with us!</p>

            <!-- Contact form -->
            <form id="contactForm" class="contact-form" action="https://formspree.io/f/xkgnnojn" method="POST">
                <div class="form-group">
                    <input type="text" id="name" name="name" required placeholder="Your Name">
                </div>

                <div class="form-group">
                    <input type="email" id="email" name="email" required placeholder="Your Email">
                </div>

                <div class="form-group">
                    <textarea id="message" name="message" rows="5" required placeholder="Your Message"></textarea>
                </div>

                <button type="submit" class="contact-submit">Send Message</button>
            </form>
        </section>


    </main>

    <!-- Footer section -->
    <?php include '../includes/footer.php'; ?>


</body>

</html>