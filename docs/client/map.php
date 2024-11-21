<?php
require_once __DIR__ . "/../server/get_location.php";

$geoData = get_location_data();

if (isset($geoData['error'])) {
    echo "Error: " . $geoData['error'];
    exit;
}

$latitude = $geoData['latitude'];
$longitude = $geoData['longitude'];
$clientIp = $geoData['ip'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Geolocation Map</title>
    <link rel="stylesheet" href="map.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>IP Geolocation Map</h1>
    <p>Your IP: <?php echo htmlspecialchars($clientIp); ?></p>
    <p>Location: <?php echo htmlspecialchars($location); ?></p>
    <div id="map"></div>

    <script>
        // Initialize the map
        const map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);

        // Add OpenStreetMap layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add a marker with a popup
        const marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map);
        marker.bindPopup("IP: <?php echo htmlspecialchars($clientIp); ?>").openPopup();
    </script>
</body>
</html>