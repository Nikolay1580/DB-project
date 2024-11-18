<?php
header('Content-Type: application/json');

require __DIR__ . "/gspot_lib.php";

loadDotEnv(__DIR__ . "/.env");
$apiKey = getenv("API_Key");

if ($Server[""])
    $clientIp = getUserIP();

    $geoUrl = "https://ipinfo.io/{$clientIp}/json?token={$ipinfoToken}";
    $geoData = json_decode(file_get_contents($geoUrl), true);

    $response = [
        'ip' => $geoData['ip'] ?? 'Unknown',
        'loc' => $geoData['loc'] ?? 'Unknown'
    ];

    echo json_encode($response);