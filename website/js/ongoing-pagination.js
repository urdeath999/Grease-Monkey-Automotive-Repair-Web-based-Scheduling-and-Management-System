let repairCurrentPage = 1;
const repairsPerPage = 5;
let filteredRows = []; // Store filtered rows globally

function searchOngoingRepairs() {
    const input = document.getElementById("repairSearch").value.toLowerCase();
    const rows = document.querySelectorAll("#repairTable tbody tr");
    filteredRows = []; // Reset filtered rows on each search

    rows.forEach(row => {
        const cells = Array.from(row.getElementsByTagName("td"));
        const serviceType = cells[0].textContent.toLowerCase();
        const appointmentDate = cells[1].textContent.toLowerCase();
        const appointmentTime = cells[2].textContent.toLowerCase();

        const matchFound = serviceType.includes(input) || appointmentDate.includes(input) || appointmentTime.includes(input);
        row.style.display = matchFound ? "" : "none";

        if (matchFound) filteredRows.push(row);
    });

    repairCurrentPage = 1;
    paginateOngoingRepairs(filteredRows);
}

function paginateOngoingRepairs(rows = null) {
    const rowsToShow = rows || Array.from(document.querySelectorAll("#repairTable tbody tr"));
    const totalRepairs = rowsToShow.length;
    const totalPages = Math.ceil(totalRepairs / repairsPerPage);
    const startIndex = (repairCurrentPage - 1) * repairsPerPage;
    const endIndex = startIndex + repairsPerPage;

    rowsToShow.forEach((row, index) => {
        row.style.display = (index >= startIndex && index < endIndex) ? "" : "none";
    });

    renderPaginationControls(totalPages);
}

function renderPaginationControls(totalPages) {
    const paginationContainer = document.getElementById("repairPagination");
    paginationContainer.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement("button");
        pageButton.innerText = i;
        
        // Inline styles for active and inactive buttons
        pageButton.style.padding = "8px 12px";
        pageButton.style.margin = "0 5px";
        pageButton.style.border = "1px solid #ccc";
        pageButton.style.borderRadius = "4px";
        pageButton.style.cursor = "pointer";
        pageButton.style.backgroundColor = i === repairCurrentPage ? "#ffd700" : "#f0f0f0";
        pageButton.style.color = i === repairCurrentPage ? "#333" : "#333";
        pageButton.style.fontWeight = i === repairCurrentPage ? "bold" : "normal";

        pageButton.onclick = function() {
            repairCurrentPage = i;
            paginateOngoingRepairs(filteredRows.length > 0 ? filteredRows : null); // Use filteredRows if available
        };

        paginationContainer.appendChild(pageButton);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    paginateOngoingRepairs();
});
