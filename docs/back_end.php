<?php
// Ensure the server returns JSON response
header('Content-Type: application/json');

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Suppress warnings
// error_reporting(E_ERROR | E_PARSE);

// Enable error logging to a file
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/error.log');

require __DIR__ . '/gspot_lib.php';

// Load the .env file
loadDotEnv(__DIR__ . '/.env');
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

/**
 * listens and checks for a POST request,
 * then it checks that the data is not empty and send corresponding error messages
 * if the data is correct, it tries to connect to the DB, and get the data from the DB 
 * using @queryDatabase() and then returns the data as a JSON object
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || empty($data)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to parse JSON input.'
        ]);
        exit;
    }

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    } catch (Exception $e) {
        logError($e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }

    $conditions = [];
    $types = '';
    $values = [];

    foreach ($data as $category => $value) {
        $conditions[] = "$category = ?";
        $types .= 'i';
        $values[] = $value;
    }

    if (empty($conditions)) {
        echo json_encode(['error' => 'No categories provided']);
        $sql_string = "SELECT block_letter, college FROM BLOCKS WHERE " . implode(' AND ', $conditions);
    }

    $sql_string = "SELECT BLOCK.NAME FROM BLOCKS WHERE " . implode(' AND ', $conditions);;

    $potential_rooms = queryDatabase($conn, $sql_string, $types, $values);

    $fake_data =  [
        ["college" => "Engineering", "block" => "c"],
    ];

    echo json_encode([
        'status' => 'success',
        'message' => 'Data fetched successfully',
        'data' => $fake_data
    ]);

    $conn->close();
} else { // when the server is just "idle"
    logError("Invalid request method in back_end.php");
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}
