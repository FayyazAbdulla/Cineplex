<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css"> <!-- Link to your external CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include userhandler.js -->
    <script src="./js/userhandler.js" defer></script>
    <!-- Include userhandler.js -->
    <script src="./js/moviehandler.js" defer></script>
    <!-- Include userhandler.js -->
    <script src="./js/bookinghandler.js" defer></script>
    <!-- Include userhandler.js -->
    <script src="./js/sectionhandler.js" defer></script>


    <title>Admin Dashboard</title>

</head>

<body>
    <div class="admin-dashboard">
        <aside class="sidebar">
            <h1>Admin Board</h1>
            <ul>
                <li><a href="#" onclick="showSection('manage-users')"><i class="fas fa-users"></i> Manage Users</a></li>
                <li><a href="#" onclick="showSection('manage-movies')"><i class="fas fa-film"></i> Manage Movies</a>
                </li>
                <li><a href="#" onclick="showSection('view-bookings')"><i class="fas fa-ticket-alt"></i> View
                        Bookings</a></li>
            </ul>
        </aside>


        <!-- Welcome section  -->
        <main class="content">
            <section id="Dashboard">
                <h2>Welcome to the Admin Dashboard</h2>
                <p>Here you can manage the Cineplex operations.</p>
                <div class="card-container">
                    <div class="card" onclick="showSection('manage-users')">
                        <i class="fas fa-users"></i>
                        <h3>Manage Users</h3>
                        <p>Manage user accounts and permissions.</p>
                    </div>
                    <div class="card" onclick="showSection('manage-movies')">
                        <i class="fas fa-film"></i>
                        <h3>Manage Movies</h3>
                        <p>Add, edit, or remove movies.</p>
                    </div>
                    <div class="card" onclick="showSection('view-bookings')">
                        <i class="fas fa-ticket-alt"></i>
                        <h3>View Bookings</h3>
                        <p>Check all bookings made by customers.</p>
                    </div>

                </div>
            </section>





            <!-- Manage Users -->
            <section id="manage-users" class="hidden">
                <h3>Manage Users</h3>
                <p>Here you can add, edit, or remove users.</p>

                <div class="form-container">
                    <form id="userForm" onsubmit="handleUserSubmit(event)">

                        <input type="hidden" id="userId" name="userId">
                        <div class="form-field">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-field">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-field">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-field">
                            <label for="role">Role:</label>
                            <select id="role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="button">Add User</button>
                    </form>
                </div>

                <div class="user-list" id="userList">
                    <h4>Existing Users</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- User data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </section>





            <!-- Manage Movies -->
            <section id="manage-movies" class="hidden">
                <h3>Manage Movies</h3>
                <p>Here you can add, edit, or remove movies.</p>

                <!-- Movie Form for Adding and Editing -->
                <form id="movie-form">
                    <input type="hidden" id="movie-id" name="movie_id">
                    <input type="hidden" id="action" name="action" value="add">
                    <div class="form-field">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-field">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>

                    <div class="form-field">
                        <label for="showtime">Showtime:</label>
                        <input type="datetime-local" id="showtime" name="showtime" required>
                    </div>

                    <div class="form-field">
                        <label for="available_seats">Available Seats:</label>
                        <input type="number" id="available_seats" name="available_seats" required>
                    </div>

                    <div class="form-field">
                        <label for="image">Image URL:</label>
                        <input type="text" id="image" name="image" required>
                    </div>

                    <button type="submit" class="button">Save Movie</button>
                    <button type="button" id="cancel-edit" class="hidden">Cancel</button>
                </form>

                <!-- Movie List -->
                <h4>Existing Movies</h4>
                <table id="movie-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Showtime</th>
                            <th>Available Seats</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Movie rows will be dynamically inserted here -->
                    </tbody>
                </table>
            </section>

            <script>

            </script>


            <!-- view booking section -->
            <section id="view-bookings" class="bookings-section hidden">
                <h3>View Bookings</h3>
                <p>Here you can see all the bookings made by customers.</p>

                <table id="bookings-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Movie ID</th>
                            <th>Seats Reserved</th>
                            <th>Booking Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Booking rows will be inserted here dynamically -->
                    </tbody>
                </table>
            </section>

        </main>
    </div>


</body>

</html>