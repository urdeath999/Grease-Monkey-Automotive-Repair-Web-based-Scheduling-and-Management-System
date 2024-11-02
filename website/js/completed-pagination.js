let serviceCurrentPage = 1;
const servicesPerPage = 5;
let filteredServiceRows = []; // Store filtered rows globally

function searchServiceHistory() {
    const input = document.getElementById("serviceSearch").value.toLowerCase();
    const rows = document.querySelectorAll("#serviceTable tbody tr");
    filteredServiceRows = []; // Reset filtered rows on each search

    rows.forEach(row => {
        const cells = Array.from(row.getElementsByTagName("td"));
        const serviceType = cells[0].textContent.toLowerCase();
        const appointmentDate = cells[1].textContent.toLowerCase();
        const appointmentTime = cells[2].textContent.toLowerCase();

        const matchFound = serviceType.includes(input) || appointmentDate.includes(input) || appointmentTime.includes(input);
        row.style.display = matchFound ? "" : "none";

        if (matchFound) filteredServiceRows.push(row);
    });

    serviceCurrentPage = 1;
    paginateServiceHistory(filteredServiceRows);
}

function paginateServiceHistory(rows = null) {
    const rowsToShow = rows || Array.from(document.querySelectorAll("#serviceTable tbody tr"));
    const totalServices = rowsToShow.length;
    const totalPages = Math.ceil(totalServices / servicesPerPage);
    const startIndex = (serviceCurrentPage - 1) * servicesPerPage;
    const endIndex = startIndex + servicesPerPage;

    rowsToShow.forEach((row, index) => {
        row.style.display = (index >= startIndex && index < endIndex) ? "" : "none";
    });

    renderServicePaginationControls(totalPages);
}

function renderServicePaginationControls(totalPages) {
    const paginationContainer = document.getElementById("completedPagination");
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
        pageButton.style.backgroundColor = i === serviceCurrentPage ? "#ffd700" : "#f0f0f0";
        pageButton.style.color = i === serviceCurrentPage ? "#333" : "#333";
        pageButton.style.fontWeight = i === serviceCurrentPage ? "bold" : "normal";

        pageButton.onclick = function() {
            serviceCurrentPage = i;
            paginateServiceHistory(filteredServiceRows.length > 0 ? filteredServiceRows : null); // Use filtered rows if available
        };

        paginationContainer.appendChild(pageButton);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    paginateServiceHistory();
});
