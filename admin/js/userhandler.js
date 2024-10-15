// Function to handle form submission for both adding and editing users
async function handleUserSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(event.target); // Get form data
    const userId = formData.get('userId'); // Get userId to check if it's an edit

    // Determine the action based on whether userId is empty (add) or not (edit)
    const action = userId ? 'edit' : 'add';
    formData.append('action', action);

    const response = await fetch(`./api/ManageUserAPI.php`, {
        method: 'POST',
        body: formData
    });

    const data = await response.json(); // Parse JSON response

    if (data.success) {
        loadUsers(); // Reload user list
        event.target.reset(); // Reset form fields
        document.querySelector('#userForm button[type="submit"]').textContent = 'Add User'; // Reset button text
        document.getElementById('password').required = true; // Make password required again

        Swal.fire(
            'Success!',
            `User has been ${action === 'add' ? 'added' : 'updated'} successfully.`,
            'success'
        );
    } else {
        Swal.fire(
            'Error!',
            data.message,
            'error'
        ); // Display error message
    }
}

// Function to load users
async function loadUsers() {
    const response = await fetch('./api/ManageUserAPI.php?action=getUsers');
    const data = await response.json(); // Parse JSON response
    const userListBody = document.querySelector('#userList tbody');
    userListBody.innerHTML = ''; // Clear existing content

    if (data.success) {
        data.users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
        <td>${user.id}</td>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${user.role}</td>
        <td>
            <button onclick="editUser(${user.id}, '${user.username}', '${user.email}', '${user.role}')">Edit</button>
            <button onclick="deleteUser(${user.id})">Delete</button>
        </td>
    `;
            userListBody.appendChild(row);
        });
    } else {
        userListBody.innerHTML = `<tr><td colspan="5" style="text-align: center;">${data.message}</td></tr>`;
    }
}

// Function to populate form with user details for editing
function editUser(userId, username, email, role) {
    document.getElementById('userId').value = userId; // Populate hidden input with user ID
    document.getElementById('username').value = username; // Populate username
    document.getElementById('email').value = email; // Populate email
    document.getElementById('role').value = role; // Populate role
    document.getElementById('password').required = false; // Make password not required for editing

    // Change submit button text to 'Update User'
    document.querySelector('#userForm button[type="submit"]').textContent = 'Update User';
}

async function deleteUser(userId) {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    });

    if (result.isConfirmed) {
        const response = await fetch('./api/ManageUserAPI.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ id: userId }),
        });

        const data = await response.json();

        if (data.success) {
            Swal.fire(
                'Deleted!',
                'User has been deleted.',
                'success'
            );
            loadUsers(); // Reload user list after deletion
        } else {
            Swal.fire(
                'Error!',
                data.message,
                'error'
            ); // Display error message
        }
    }
}


