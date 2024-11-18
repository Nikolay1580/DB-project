<?php
require __DIR__ . "/gspot_lib.php";

function get_location_data() {
    loadDotEnv(__DIR__ . "/.env");
    $apiKey = getenv("API_KEY");

    $clientIp = getUserIP();

    if ($clientIp === "127.0.0.1" || $clientIp === "::1") {
        $clientIp = "8.8.8.8"; // Example IP for testing
    }

    $geoUrl = "https://ipinfo.io/{$clientIp}/json?token={$apiKey}";
    $response = @file_get_contents($geoUrl);

    if ($response === FALSE) {
        return [
            'error' => 'Failed to fetch geolocation data',
            'ip' => $clientIp,
            'latitude' => '0',
            'longitude' => '0',
        ];
    }

    $geoData = json_decode($response, true);

    if (!isset($geoData['loc'])) {
        return [
            'error' => 'Invalid response from geolocation service',
            'ip' => $clientIp,
            'latitude' => '0',
            'longitude' => '0',
        ];
    }

    $location = $geoData['loc'];
    $latitude = explode(',', $location)[0];
    $longitude = explode(',', $location)[1];

    return [
        'ip' => $clientIp,
        'latitude' => $latitude,
        'longitude' => $longitude,
    ];
}