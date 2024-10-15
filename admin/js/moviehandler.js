// Fetch and display movies on page load
document.addEventListener("DOMContentLoaded", function () {
  fetchMovies();
});

// Fetch movies from the API and display them in the table
function fetchMovies() {
  fetch("./api/ManageMovieAPI.php?action=getMovies")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const tableBody = document.querySelector("#movie-table tbody");
        tableBody.innerHTML = ""; // Clear the table
        data.movies.forEach((movie) => {
          const row = `<tr>
                        <td>${movie.id}</td>
                        <td>${movie.title}</td>
                        <td>${movie.description}</td>
                        <td>${new Date(movie.showtime).toLocaleString()}</td>
                        <td>${movie.available_seats}</td>
                        <td>
                            <button onclick="editMovie(${
                              movie.id
                            })">Edit</button>
                            <button onclick="deleteMovie(${
                              movie.id
                            })">Delete</button>
                        </td>
                    </tr>`;
          tableBody.insertAdjacentHTML("beforeend", row);
        });
        // Swal.fire('Success!', 'Movies fetched successfully.', 'success');
      } else {
        Swal.fire("Error!", "Failed to fetch movies: " + data.message, "error");
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

// Add or edit movie
document.querySelector("#movie-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const action = formData.get("action");

  // Validate that required fields are filled before submitting
  if (!formData.get("title") || !formData.get("description") || !formData.get("showtime") || !formData.get("available_seats")) {
    Swal.fire("Error!", "Please fill in all required fields.", "error");
    return;
  }

  fetch("./api/ManageMovieAPI.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        Swal.fire("Success!", data.message, "success");
        fetchMovies();
        resetForm();
      } else {
        Swal.fire("Error!", "Failed to save movie: " + data.message, "error");
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
});

// Edit movie
function editMovie(id) {
  fetch("./api/ManageMovieAPI.php?action=getMovies")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const movie = data.movies.find((movie) => movie.id === id.toString()); // Ensure type matches
        if (movie) {
          // Populate form fields with movie data
          document.getElementById("movie-id").value = movie.id;
          document.getElementById("title").value = movie.title;
          document.getElementById("description").value = movie.description;
          document.getElementById("showtime").value = movie.showtime.replace(
            " ",
            "T"
          ); // Format for datetime-local
          document.getElementById("available_seats").value =
            movie.available_seats;
          document.getElementById("image").value = movie.image;
          document.getElementById("action").value = "edit";

          // Change submit button text to 'Update User'
          document.querySelector(
            '#movie-form button[type="submit"]'
          ).textContent = "Update Movie";

          // Show cancel edit button
          document.getElementById("cancel-edit").classList.remove("hidden");

          // Scroll to the form for better user experience
          document
            .querySelector("#manage-movies")
            .scrollIntoView({ behavior: "smooth" });
        }
      } else {
        Swal.fire(
          "Error!",
          "Failed to fetch movie data: " + data.message, 
          "error"
        );
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

// Delete movie
async function deleteMovie(movie_id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`./api/ManageMovieAPI.php`, {
        method: "DELETE",
        headers:{
            'Content-Type' : 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({id:movie_id})
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            Swal.fire("Deleted!", data.message, "success");
            fetchMovies();
          } else {
            Swal.fire(
              "Error!",
              "Failed to delete movie: " + data.message,
              "error"
            );
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
  });
}

// Reset form after adding or editing movie
function resetForm() {
  document.getElementById("movie-form").reset();
  document.getElementById("movie-id").value = "";
  document.getElementById("action").value = "add";
  document.getElementById("cancel-edit").classList.add("hidden");
}

// Cancel editing and reset form
document.getElementById("cancel-edit").addEventListener("click", function () {
  resetForm();
});
