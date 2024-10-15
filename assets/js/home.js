// Dark Mode / Light Mode Toggle
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');

    // Check for saved user preference
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.toggle('dark-mode', currentTheme === 'dark');

    // Set the initial toggle button icon
    themeToggle.innerText = currentTheme === 'dark' ? '🌞' : '🌙';

    themeToggle.addEventListener('click', () => {
        // Toggle the theme
        document.body.classList.toggle('dark-mode');
        
        // Save the current theme in localStorage
        const newTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
        localStorage.setItem('theme', newTheme);

        // Update the toggle button icon
        themeToggle.innerText = newTheme === 'dark' ? '🌞' : '🌙';
    });
});


// movie section 
document.addEventListener("DOMContentLoaded", () => {
    const movieItems = document.querySelectorAll(".movie-item");

    // Function to add animations when the movie items are in view
    const handleScroll = () => {
        const windowHeight = window.innerHeight;

        movieItems.forEach(item => {
            const itemPosition = item.getBoundingClientRect().top;

            // Check if item is in view
            if (itemPosition < windowHeight - 100) { // 100 pixels before it comes into view
                item.classList.add("animate"); // Add animation class
            }
        });
    };

    // Add event listener for scroll
    window.addEventListener("scroll", handleScroll);

    // Trigger the scroll event to check initial visibility
    handleScroll();
});



// Contact Form Submission Handler
document.getElementById('contactForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevent default form submission

    const form = e.target;
    const formData = new FormData(form);

    // Send form data to Formspree using fetch
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        });

        if (response.ok) {
            // Display success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Message sent successfully! Redirecting to homepage...',
                timer: 3000, // Set the timer for 3 seconds
                timerProgressBar: true,
                willClose: () => {
                    // Redirect to home.php after the alert closes
                    window.location.href = 'home.php';
                }
            });
        } else {
            // Display error message if submission fails
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Please try again.'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Network Error!',
            text: 'Please try again later.'
        });
    }
});

