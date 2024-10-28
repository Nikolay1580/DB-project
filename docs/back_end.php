<?php
// Ensure the server returns JSON response
header('Content-Type: application/json');

// Allow cross-origin requests (optional, depends on your setup)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Suppress warnings
error_reporting(E_ERROR | E_PARSE);

// Enable error logging to a file
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/error.log');

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
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}

/**
 * @param string $path 
 * this function checks the directory and loads all of the vars from .env
 * and then places them in the global var $_ENV so that they can be later obtain
 * using getenv()
 */
function loadDotEnv($path): void
{
    if (!file_exists($path)) {
        throw new Exception("The .env file does not exist at the path: " . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || empty(trim($line))) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, ' "');
        putenv("$name=$value");
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}


/**
 * @param mysqli $conn 
 * @param string $sql_string
 * @param char $types 
 * @param array  $values
 * 
 * prepares the sql, binds the vars to it and then gets a result table
 * loop through the table and add the results to an array and returnt that to be 
 * enocded as json
 */
function queryDatabase($conn, $sql_string, $types, $values)
{
    $stmt = $conn->prepare($sql_string);

    $stmt->bind_param($types, ...$values);

    $stmt->execute();
    $result = $stmt->get_result();

    $potential_rooms = [];
    while ($row = $result->fetch_assoc()) {
        $potential_rooms[] = array(
            'block_letter' => $row['block_letter'],
            'college' => $row['college']
        );
    }

    return $potential_rooms;
}
