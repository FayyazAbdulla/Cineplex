<?php
session_start();
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51Q9RrLDVLezn6SZE7W5uOyYSPx2DBkXhbdai0hhiGznZiLfPibPKGF7x16tN1rvNuhToQcOu8aKLtmBcWdEZsTUt00hquRY1EA');

// Get booking ID from query parameter
$booking_id = filter_var($_GET['booking_id'], FILTER_SANITIZE_NUMBER_INT);

// Include database connection
include_once '../includes/db.php';

// Fetch booking details
$sql = "SELECT total_price FROM bookings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$stmt->bind_result($total_price);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <h2>Complete Payment</h2>
    <p>Total Price: $<?= number_format($total_price, 2); ?></p>

    <form id="payment-form">
        <div id="card-element"></div>
        <button type="submit">Pay Now</button>
    </form>

    <script>
        const stripe = Stripe('your_publishable_key');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const { error, paymentIntent } = await stripe.confirmCardPayment('your_client_secret', {
                payment_method: {
                    card: card
                }
            });

            if (error) {
                alert(error.message);
            } else {
                alert('Payment successful!');
                window.location.href = 'booking_confirmation.php?booking_id=<?= $booking_id; ?>';
            }
        });
    </script>
</body>

</html>