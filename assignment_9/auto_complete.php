<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');

/**
 * Checks if a 'term' parameter is provided in the URL query string.
 * Filters through the $data array to find items containing the search term.
 * Returns matching items as a comma-separated string.
 */
if (isset($_GET['term'])) {
    $term = $_GET['term'];

    // Array of college names
    $data = ["nord", "nordmetall", "merc", "mercator", "krupp a-d", "krupp e-f", "c3", "C3"];

    // Filter the array to include only items that contain the term (case-insensitive)
    $results = array_filter($data, function($item) use ($term) {
        return stripos($item, $term) !== false;
    });

    // Convert the result array to a comma-separated string and output it
    echo implode(", ", $results);
} else {
    // If no 'term' parameter is provided, return a message
    echo "No term parameter provided";
}
