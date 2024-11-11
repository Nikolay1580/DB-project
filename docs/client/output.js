
window.onload = () => {
    loadData();
}


function loadData() {
    // Check if the data exists in window.sharedData or local storage
    const data = JSON.parse(localStorage.getItem('result_data'));

    if (data && data.college && data.block) {
        // Populate the table if valid data is present
        displayTable(data);
    } else {
        // Show a message or image indicating no room was found
        displayNoRoomFound();
    }

    console.log(data);
}

// This is the main funciton that should return the college and block
function displayTable(data) {
    const tableContainer = document.getElementById('table-container');
    // Initialize table structure
    let tableHTML = `
        <table>
            <tr>
                <th>College</th>
                <th>Block Letter</th>
            </tr>
    `;

    // Loop through the array of data and add rows for each entry
    data.forEach(item => {
        tableHTML += `
            <tr>
                <td>${item.college}</td>
                <td>${item.block}</td>
            </tr>
        `;
    });

    // Close the table
    tableHTML += `</table>`;

    // Set the innerHTML of the table container to display the table
    tableContainer.innerHTML = tableHTML;
}

// This helps the html file to display the correct meseage when there is no room
function displayNoRoomFound() {
    const tableContainer = document.getElementById('table-container');
    tableContainer.innerHTML = `
        <div class="no-room">
            <img src="content/no-room-found.jpeg" alt="No Room Found">
            <p>We could not find a room</p>
        </div>
    `;
}