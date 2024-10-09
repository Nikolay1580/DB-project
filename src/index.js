function showRankings(category) {
    // Show the ranking table
    document.getElementById('ranking-table').style.display = 'block';
    document.getElementById('category-title').innerText = category + ' Rankings';

    // Clear previous rankings
    const rankingBody = document.getElementById('ranking-body');
    rankingBody.innerHTML = '';

    // Sample data for rankings
    const rankings = {
        'Rooms': [
            { name: 'Dorm A', cleanliness: '9/10', distance: '5 min', quietness: '8/10' },
            { name: 'Dorm B', cleanliness: '8/10', distance: '7 min', quietness: '7/10' },
            { name: 'Dorm C', cleanliness: '7/10', distance: '10 min', quietness: '6/10' },
        ],
        'Kitchen': [
            { name: 'Kitchen 1', cleanliness: '9/10', distance: '2 min', quietness: 'N/A' },
            { name: 'Kitchen 2', cleanliness: '8/10', distance: '3 min', quietness: 'N/A' },
        ],
        'Study Areas': [
            { name: 'Library', cleanliness: '10/10', distance: '5 min', quietness: '10/10' },
            { name: 'Study Hall', cleanliness: '8/10', distance: '3 min', quietness: '9/10' },
        ]
    };

    // Populate the table with the selected category's data
    rankings[category].forEach((item, index) => {
        const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${item.name}</td>
                <td>${item.cleanliness}</td>
                <td>${item.distance}</td>
                <td>${item.quietness || 'N/A'}</td>
            </tr>
        `;
        rankingBody.innerHTML += row;
    });
}