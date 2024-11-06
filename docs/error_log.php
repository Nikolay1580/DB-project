<?php

require __DIR__ . '/gspot_lib.php';
$errorLogFile = '/home/tlachezarov/var/log/apache2/error_log.csv';

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
