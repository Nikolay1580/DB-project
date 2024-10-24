// This should work assuming getDataFromBackend stores or returns data correctly
window.sharedData = {}; 

function loadData() {
    // Check if the data exists in window.sharedData or local storage
    const data = window.sharedData || JSON.parse(localStorage.getItem('result_data'));

    if (data && data.college && data.block) {
        // Populate the table if valid data is present
        displayTable(data);
    } else {
        // Show a message or image indicating no room was found
        displayNoRoomFound();
    }
}

// This is the main funciton that should return the college and block
function displayTable(data) {
    const tableContainer = document.getElementById('table-container');
    tableContainer.innerHTML = `
        <table>
            <tr>
                <th>College</th>
                <th>Block Letter</th>
            </tr>
            <tr>
                <td>${data.college}</td>
                <td>${data.block}</td>
            </tr>
        </table>
    `;
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

function saveToSharedData(data) {
    window.sharedData = data; // window.sharedData
    localStorage.setItem('result_data', JSON.stringify(data)); // local storage
}

// When the page loads, attempt to load data
window.onload = loadData;
