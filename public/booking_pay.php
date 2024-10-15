<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ensure user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("Error: User ID not found in session.");
}

// Correct the path to db.php
$db_path = realpath(__DIR__ . '/../includes/db.php');
if ($db_path && file_exists($db_path)) {
    include_once $db_path;
} else {
    die("Error: Unable to include db.php. Please check the file path.");
}

// Fetch movies for the dropdown
$sql = "SELECT id, title FROM movies";
$result = $conn->query($sql);
$movies = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

// If the request is POST, handle the booking and payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('vendor/autoload.php');

    // Set your Stripe secret key
    \Stripe\Stripe::setApiKey('sk_test_ahbchwg287t72gdweyfgc7q2ftyuegf8q2q278rdhwegdcywebdcwyegc');

    $user_id = $_POST['user_id'];
    $movie_id = $_POST['movie_id'];
    $seats = $_POST['seats'];
    $token = $_POST['stripeToken']; // Stripe token from the frontend

    if (empty($user_id) || empty($movie_id) || empty($seats) || empty($token)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        exit();
    }

    try {
        // Calculate ticket price (example: $10 per seat)
        $amount = $seats * 1000; // in cents

        // Create a Stripe charge
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Ticket Booking for Movie ID: ' . $movie_id,
            'source' => $token,
        ]);

        // If payment is successful, insert booking into database
        $sql = "INSERT INTO bookings (user_id, movie_id, seats) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $user_id, $movie_id, $seats);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Booking and payment successful!']);
    } catch (\Stripe\Exception\CardException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Ticket</title>
    <link rel="stylesheet" href="../assets/css/booking_pay.css"> <!-- Include your CSS -->
    <link rel="stylesheet" href="../assets/css/header.css"> <!-- Include header CSS -->
    <link rel="stylesheet" href="../assets/css/footer.css"> <!-- Include footer CSS -->
    <script src="https://js.stripe.com/v3/"></script> <!-- Stripe.js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="../assets/js/booking.js" defer></script> <!-- Your custom JS -->
</head>

<body>
    <!-- Include your header -->
    <?php include '../includes/header.php'; ?>

    <section class="booking-section">
        <div class="booking-container">
            <h2>Book Your Ticket</h2>
            <p>Reserve your seat now for an unforgettable experience!</p>

            <form id="payment-form" method="POST" action="">
                <div class="form-group">
                    <label for="movie">Select Movie:</label>
                    <select name="movie_id" id="movie" required>
                        <option value="" disabled selected>Select a movie</option>
                        <?php foreach ($movies as $movie): ?>
                            <option value="<?= $movie['id']; ?>"><?= htmlspecialchars($movie['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="seats">Number of Seats:</label>
                    <input type="number" name="seats" id="seats" required min="1">
                </div>

                <!-- Hidden input for user_id -->
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

                <!-- Stripe Elements for card input -->
                <div id="card-element"></div>

                <button type="submit" class="submit-btn">Book Ticket</button>
            </form>
        </div>
    </section>

    <!-- Include your footer -->
    <?php include '../includes/footer.php'; ?>

    <script>
        const stripe = Stripe('pk_test_51Q9RrLDVLezn6SZE7W5uOyYSPx2DBkXhbdai0hhiGznZiLfPibPKGF7x16tN1rvNuhToQcOu8aKLtmBcWdEZsTUt00hquRY1EA'); // Correct: Publishable Key
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { token, error } = await stripe.createToken(cardElement);
            if (error) {
                Swal.fire('Error', error.message, 'error');
            } else {
                // Send the token and form data to the server
                const formData = new FormData(form);
                formData.append('stripeToken', token.id);

                fetch('./booking.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire('Success', 'Booking and payment successful!', 'success');
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', error.message, 'error');
                    });
            }
        });
    </script>
</body>

</html>