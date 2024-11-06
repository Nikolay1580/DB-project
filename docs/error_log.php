<?php

require __DIR__ . '/gspot_lib.php';
$errorLogFile = '/home/tlachezarov/var/log/apache2/error_log.csv';


/**
 * opens the error file
 * gives a timestamp and the error
 */
function logError($errorMessage)
{
    global $errorLogFile;

    $timestamp = date('Y-m-d H:i:s');
    $userIP = getUserIP();
    $errorLogEntry = [$timestamp, $userIP, $errorMessage];

    // Write to the error log file
    $errorHandle = fopen($errorLogFile, 'a');
    if ($errorHandle !== false) {
        fputcsv($errorHandle, $errorLogEntry);
        fclose($errorHandle);
    } else {
        error_log("Unable to write to error log file: $errorLogFile");
    }
}

// Example usage of error logging
// Simulating an error for demonstration purposes
try {
    if (!file_exists('some_nonexistent_file.txt')) {
        throw new Exception("File does not exist: some_nonexistent_file.txt");
    }
} catch (Exception $e) {
    logError($e->getMessage());
}
