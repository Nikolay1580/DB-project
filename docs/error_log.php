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

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $errorMessage = "Error [$errno]: $errstr in $errfile on line $errline";
    logError($errorMessage);
    return true;
});

set_exception_handler(function ($exception) {
    $errorMessage = "Uncaught exception: " . $exception->getMessage();
    logError($errorMessage);
});


register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        $errorMessage = "Fatal error: {$error['message']} in {$error['file']} on line {$error['line']}";
        logError($errorMessage);
    }
});
