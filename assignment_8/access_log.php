<?php

require __DIR__ . '/gspot_lib.php';
$accessLogFile = '/home/tlachezarov/var/log/apache2/access.log';

umask(0002);

// Capture request data
$userIP = getUserIP();
$pageURL = $_SERVER['REQUEST_URI'];
$timestamp = date('Y-m-d H:i:s');
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Create a CSV line for the access log
$accessLogEntry = [$userIP, $pageURL, $timestamp, $userAgent];

// Write to the access log file
$accessHandle = fopen($accessLogFile, 'a');
if ($accessHandle !== false) {
    fputcsv($accessHandle, $accessLogEntry);
    fclose($accessHandle);
} else {
    error_log("Unable to write to access log file: $accessLogFile");
}
