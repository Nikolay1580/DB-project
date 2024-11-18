<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Geolocation Map</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>IP Geolocation Map</h1>
    <div id="info">
        <p>Your IP: <span id="clientIp">Loading...</span></p>
        <p>Location: <span id="location">Loading...</span></p>
    </div>
    <div id="map"></div>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'http://5.75.182.107/~tlachezarov/docs/server/get_location.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const clientIp = data.ip;
                    const location = data.loc;
                    const latitude = parseFloat(location.split(',')[0]);
                    const longitude = parseFloat(location.split(',')[1]);

                    $('#clientIp').text(clientIp);
                    $('#location').text(location);

                    const map = L.map('map').setView([latitude, longitude], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    const marker = L.marker([latitude, longitude]).addTo(map);
                    marker.bindPopup(`IP: ${clientIp}`).openPopup();
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching location:', error);
                    alert('Failed to retrieve location.');
                },
            });
        });
    </script>
</body>
</html>