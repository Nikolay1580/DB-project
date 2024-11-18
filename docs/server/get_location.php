<?php
header('Content-Type: application/json');

require __DIR__ . "/gspot_lib.php";

loadDotEnv(__DIR__ . "/.env");
$apiKey = getenv("API_Key");


$clientIp = getUserIP();

$geoUrl = "https://ipinfo.io/{$clientIp}/json?token={$apiKey}";

// Fetch geolocation data
$response = @file_get_contents($geoUrl);
$geoData = $response ? json_decode($response, true) : ['loc' => '0,0', 'ip' => $clientIp];

$location = $geoData['loc'];
$latitude = explode(',', $location)[0];
$longitude = explode(',', $location)[1];