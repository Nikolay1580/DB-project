<?php
// Ensure the server returns JSON response
header('Content-Type: application/json');

// Allow cross-origin requests (optional, depends on your setup)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Load the .env file
loadDotEnv(__DIR__ . '/.env');

// Access the environment variables
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

echo "DB_HOST: $servername\n";
echo "DB_USER: $username\n";
echo "DB_PASS: $password\n";
echo "DB_NAME: $dbname\n";


$conn = connectToDatabase($servername, $username, $password, $dbname);

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

/**
 * @param string $path 
 * this function checks the directory and loads all of the vars from .env
 * and then places them in the global var $_ENV so that they can be later obtain
 * using getenv()
*/
function loadDotEnv($path)
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
 * Summary of connectToDatabase
 * @param string $servername
 * @param string $username
 * @param string $password
 * @param string $dbname
 * @return mysqli
 * 
 * function creates a connection to the database if the connection is successful it
 * will return the db otherwise it will throw an error using die
 */
function connectToDatabase($servername, $username, $password, $dbname): mysqli {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
