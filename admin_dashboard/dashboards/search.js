// Get the search input field and the search button
const searchInput = document.getElementById('searchInput');
const searchButton = document.querySelector('.search button');

// Add an event listener for when the search button is clicked
searchButton.addEventListener('click', function () {
    const searchValue = searchInput.value.toLowerCase();

    // Get all the rows in the different appointment sections
    const allTables = document.querySelectorAll('.table tbody');
    allTables.forEach(tableBody => {
        const rows = tableBody.getElementsByTagName('tr');
        
        // Loop through each row in the table body
        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();

            // Check if the row contains the search value
            if (rowText.includes(searchValue)) {
                rows[i].style.display = ''; // Show row if it matches
            } else {
                rows[i].style.display = 'none'; // Hide row if it doesn't match
            }
        }
    });
});

// Optional: Search as you type functionality (real-time filtering)
searchInput.addEventListener('input', function () {
    const searchValue = searchInput.value.toLowerCase();

    const allTables = document.querySelectorAll('.table tbody');
    allTables.forEach(tableBody => {
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].textContent.toLowerCase();
            
            if (rowText.includes(searchValue)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});
