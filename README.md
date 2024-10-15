Admin DashBoard -  http://localhost:8080/CinePlexC/admin/admin_dashboard.php
home - http://localhost:8080/CinePlexC/public/home.php#welcome
Booking with Payment gateway - http://localhost:8080/CinePlexC/public/booking_pay.php

# Cineplex Management System

### Overview

The **Cineplex Management System** is a comprehensive web-based application designed for managing a cineplex's operations. It includes features for user management, movie management, bookings, and reporting. Built using PHP, MySQL, and modern web technologies, the system provides both admin and customer-facing functionalities with role-based access control.

### Demo
[GitHub Repository](https://github.com/FayyazAbdulla/Cineplex.git)

---

## Table of Contents

- [Features](#features)
- [File Structure](#file-structure)
- [Installation](#installation)
- [Usage](#usage)
- [Technologies Used](#technologies-used)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)


## Features

### Admin Dashboard:
- **User Management**: Add, edit, and remove users (admins, staff, customers).
- **Movie Management**: Add, edit, remove movies, manage showtimes and seating.
- **Booking Management**: View customer bookings, track seat availability.
- **Reports**: Generate reports on users, movies, and bookings.

### Customer Portal:
- **User Registration/Login**: Customers can register, log in, and book tickets.
- **Booking System**: View available movies, showtimes, and book tickets.
- **Payment System**: Integrated basic payment system for booking payments.

### Notifications:
- **SweetAlert & Toastr**: Elegant pop-up notifications for actions like bookings, form submissions, and errors.


## File Structure

```
📦 Cineplex
├── 📁admin
│   ├── 📁api               # Backend APIs for admin
│   │   └── ManageBookingAPI.php
│   │   └── ManageMovieAPI.php
│   │   └── ManageUserAPI.php
│   ├── 📁js                # JavaScript for admin functionalities
│   │   └── bookingHandler.js
│   │   └── moviehandler.js
│   │   └── sectionhandler.js
│   │   └── userhandler.js
│   └── admin_dashboard.php  # Admin dashboard
├── 📁Ass_Doc               # Assignment documents
│   └── CSE5009- Writ1.pdf
├── 📁assets
│   ├── 📁css               # Stylesheets for the project
│   └── 📁images            # Image assets
│   └── 📁js                # JavaScript files for the frontend
├── 📁includes
│   └── db.php              # Database connection file
│   └── footer.php          # Footer include
│   └── header.php          # Header include
├── 📁public                # Public-facing files
│   ├── 📁api               # Public API endpoints
│   │   └── fetch_movies.php
│   │   └── fetch_showtimes.php
│   │   └── insert_booking.php
│   │   └── login_handler.php
│   └── booking_pay.php      # Booking payment page
│   └── booking.php          # Booking page
│   └── home.php             # Home page
│   └── login.php            # Login page
│   └── register.php         # Registration page
│   └── showtime.php         # Showtimes page
```

---

## Installation

### Prerequisites:
- **Web Server**: Apache/Nginx
- **PHP**: 7.4 or higher
- **MySQL**: 5.7 or higher
- **Composer**: For managing dependencies

### Steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/FayyazAbdulla/Cineplex.git
   cd Cineplex
   ```

2. **Set up the database**:
   - Import the `cineplex.sql` file in MySQL.
   - Configure the database connection in `/includes/db.php`:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "cineplex_db";
     ```

3. **Set up the environment**:
   - Ensure the `.env` file is configured with the correct DB details.
   
4. **Run the project**:
   - Access the project through a local server (e.g., `http://localhost/cineplex/`).

---

## Usage

### Admin:
1. **Login**: Go to `http://localhost/cineplex/public/login.php` and log in using admin credentials.
2. **Dashboard**: After login, access the admin dashboard to manage users, movies, and bookings.

### Customer:
1. **Registration**: Customers can register on the platform to book tickets.
2. **Booking**: Choose a movie, select showtimes, and book tickets. Payments can be made via the booking system.

---

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (ES6)
- **Backend**: PHP (Core PHP), MySQL
- **Libraries**:
  - **jQuery**: For enhanced JavaScript functionalities
  - **SweetAlert** & **Toastr**: For notifications
  - **AJAX**: For asynchronous API calls

---

### Database Schema

```plaintext
+------------------+           +----------------+           +-----------------+           +----------------+
|      users       |           |     movies      |           |    bookings     |           |    feedback     |
+------------------+           +----------------+           +-----------------+           +----------------+
| id (PK)          |           | id (PK)        |           | id (PK)         |           | id (PK)         |
| username (UNIQUE)|           | title          |           | user_id (FK)    |           | user_id (FK)    |
| password         |           | description    |           | movie_id (FK)   |           | message         |
| email (UNIQUE)   |           | showtime       |           | seats           |           | created_at      |
| role             |           | available_seats|           | created_at      |           +----------------+
| created_at       |           | image          |           +-----------------+
+------------------+           | created_at     |
                                +----------------+
```

### Relationships:
- **Users to Bookings:** One user can have many bookings (`user_id` as foreign key in `bookings` table).
- **Movies to Bookings:** One movie can have many bookings (`movie_id` as foreign key in `bookings` table).
- **Users to Feedback:** One user can submit multiple feedback messages (`user_id` as foreign key in `feedback` table).

---

This schema lays out the relationships and structure for managing user data, movie details, bookings, and feedback in the system. Each table has a primary key (`id`), and foreign keys are used to establish relationships between the tables.

## API Endpoints

### Admin API:
- `/admin/api/ManageUserAPI.php`: Manage users.
- `/admin/api/ManageMovieAPI.php`: Manage movies.
- `/admin/api/ManageBookingAPI.php`: Manage bookings.

### Public API:
- `/public/api/fetch_movies.php`: Fetch movie list.
- `/public/api/insert_booking.php`: Insert booking details.
- `/public/api/login_handler.php`: Handle user login.

---

## Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Create a pull request.

---

## License

This project is licensed under the MIT License.

--- 

For additional information or queries, feel free to contact: `your-email@example.com`

---

This `README.md` provides an overview of the project, installation steps, usage, and more.