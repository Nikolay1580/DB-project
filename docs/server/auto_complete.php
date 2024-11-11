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

    $data = [
        "College 3", "C3", "c3",
        "Nord Metall", "nord Metal", "Nord", "nord", "nord metal",
        "Alfred Krupp", "alfred Krupp", "alfred krupp", "Krupp", "krupp",
        "Mercator", "mercator", "Merc", "merc"
    ];

    $results = array_filter($data, function($item) use ($term) {
        return stripos($item, $term) !== false;
    });

    $resultString = implode(", ", $results);

    echo $resultString;
} else {
    echo "No term parameter provided";
}