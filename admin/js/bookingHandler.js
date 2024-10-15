// Fetch and display bookings on page load
document.addEventListener("DOMContentLoaded", function () {
    fetchBookings();
});

// Fetch bookings from the API and display them in the table
function fetchBookings() {
    fetch("./api/ManageBookingAPI.php?action=getBookings")
        .then((response) => response.json())
        .then((data) => {
            const tableBody = document.querySelector("#bookings-table tbody");
            tableBody.innerHTML = ""; // Clear the table

            if (data.success) {
                data.bookings.forEach((booking) => {
                    const row = `<tr>
                                  <td>${booking.id}</td>
                                  <td>${booking.customer_name}</td>
                                  <td>${booking.movie_id}</td> <!-- Display movie_id directly -->
                                  <td>${booking.seats_reserved}</td>
                                  <td>${new Date(booking.booking_time).toLocaleString()}</td>
                              </tr>`;
                    tableBody.insertAdjacentHTML("beforeend", row);
                });
                // Swal.fire('Success!', 'Bookings fetched successfully.', 'success');
            } else {
                Swal.fire("Error!", "Failed to fetch bookings: " + data.message, "error");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire(
                "Error!",
                "An unexpected error occurred: " + error.message,
                "error"
            );
        });
}
