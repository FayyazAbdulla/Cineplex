// Function to show the selected section and hide others
function showSection(sectionId) {
    const sections = document.querySelectorAll('.content section');
    sections.forEach(section => section.classList.add('hidden')); // Hide all sections

    const selectedSection = document.getElementById(sectionId);
    selectedSection.classList.remove('hidden'); // Show the selected section

    if (sectionId === 'manage-users') {
        loadUsers(); // Load users when Manage Users section is shown
    }
}

// Load users on page load (optional)
document.addEventListener('DOMContentLoaded', () => {
    loadUsers(); // Load users on initial page load
});