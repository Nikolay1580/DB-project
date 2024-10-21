<?php
// Ensure the server returns JSON response
header('Content-Type: application/json');

// Allow cross-origin requests (optional, depends on your setup)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the POST body (assumes JSON format)
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if we successfully decoded the JSON
    if ($data) {
        $isValid = true;  // Placeholder for real validation logic

        // Return a success message if valid
        if ($isValid) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data received successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid data!'
            ]);
        }
    } else {
        // Failed to decode JSON
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to parse JSON input.'
        ]);
    }
} else {
    // Handle requests that are not POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST is allowed.'
    ]);
}
?>