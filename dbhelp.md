### SQL Commands to Create Tables

1. **Users Table**
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       role ENUM('admin', 'staff', 'customer') DEFAULT 'customer',
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

2. **Movies Table**
   ```sql
   CREATE TABLE movies (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(100) NOT NULL,
       description TEXT NOT NULL,
       showtime DATETIME NOT NULL,
       available_seats INT NOT NULL,
       image VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

3. **Bookings Table**
   ```sql
   CREATE TABLE bookings (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       movie_id INT NOT NULL,
       seats INT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
       FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
   );
   ```

4. **Feedback Table**
   ```sql
   CREATE TABLE feedback (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       message TEXT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );
   ```


----------------------------------------------------------------------------------------------

### Sample Data Insertion SQL Commands

1. **Insert Sample Data into Users Table**
   ```sql
   INSERT INTO users (username, password, email, role) VALUES
   ('john_doe', 'password123', 'john@example.com', 'customer'),
   ('jane_smith', 'password123', 'jane@example.com', 'customer'),
   ('admin_user', 'admin123', 'admin@example.com', 'admin'),
   ('staff_member', 'staff123', 'staff@example.com', 'staff'),
   ('alex_brown', 'password123', 'alex@example.com', 'customer'),
   ('lisa_white', 'password123', 'lisa@example.com', 'customer'),
   ('mike_green', 'password123', 'mike@example.com', 'customer'),
   ('emily_jones', 'password123', 'emily@example.com', 'customer'),
   ('david_wilson', 'password123', 'david@example.com', 'customer'),
   ('sarah_clark', 'password123', 'sarah@example.com', 'customer');
   ```

2. **Insert Sample Data into Movies Table**
   ```sql
   INSERT INTO movies (title, description, showtime, available_seats, image) VALUES
   ('Inception', 'A thief steals corporate secrets through the use of dream-sharing technology.', '2024-10-15 18:30:00', 100, 'inception.jpg'),
   ('The Dark Knight', 'When the menace known as The Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.', '2024-10-16 20:00:00', 80, 'dark_knight.jpg'),
   ('Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', '2024-10-17 19:00:00', 75, 'interstellar.jpg'),
   ('Titanic', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', '2024-10-18 17:00:00', 50, 'titanic.jpg'),
   ('Avatar', 'In the 22nd century, a paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', '2024-10-19 21:00:00', 120, 'avatar.jpg'),
   ('The Matrix', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', '2024-10-20 16:00:00', 90, 'matrix.jpg'),
   ('Forrest Gump', 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold through the perspective of an Alabama man with an IQ of 75.', '2024-10-21 18:00:00', 65, 'forrest_gump.jpg'),
   ('The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', '2024-10-22 19:30:00', 85, 'shawshank.jpg'),
   ('The Godfather', 'An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.', '2024-10-23 20:30:00', 70, 'godfather.jpg'),
   ('Pulp Fiction', 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', '2024-10-24 21:30:00', 60, 'pulp_fiction.jpg');
   ```

3. **Insert Sample Data into Bookings Table**
   ```sql
   INSERT INTO bookings (user_id, movie_id, seats) VALUES
   (1, 1, 2),
   (1, 2, 4),
   (2, 1, 1),
   (2, 3, 3),
   (3, 4, 2),
   (4, 5, 5),
   (5, 6, 2),
   (6, 7, 4),
   (7, 8, 1),
   (8, 9, 3);
   ```

4. **Insert Sample Data into Feedback Table**
   ```sql
   INSERT INTO feedback (user_id, message) VALUES
   (1, 'Great experience, loved the movie!'),
   (2, 'The booking process was easy and quick.'),
   (3, 'Had an issue with my booking but customer service helped.'),
   (4, 'The theater was clean and well-maintained.'),
   (5, 'Loved the popcorn and the comfy seats!'),
   (6, 'Will definitely come back for more movies.'),
   (7, 'The movie selection is fantastic!'),
   (8, 'I enjoyed the special promotions on tickets.'),
   (9, 'Could use more parking space.'),
   (10, 'Great place for family outings!');
   ```



   // Testing for payment gateway 

   CREATE TABLE bookings_pay (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    seats INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    payment_status ENUM('pending', 'paid') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

