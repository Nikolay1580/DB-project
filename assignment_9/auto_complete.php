<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');

/**
 * checks if the user is setting a term, then filders to see if any of the keywrods
 * is closest to the one in our $data array and return the closes one as string of the words
 * that have the char(s) and seperates them with commas
 */
if (isset($_GET['term'])) {
    $term = $_GET['term'];

    $data = ["nord", "nordmetall", "merc", "mercator", "krupp a-d", "krupp e/f", "c3", "C3"];

    $results = array_filter($data, function($item) use ($term) {
        return stripos($item, $term) !== false;
    });

    echo implode(", ", $results);
} else {
    echo "No term parameter provided";
}
