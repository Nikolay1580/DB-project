<?php

// Ensure the server returns JSON response
// Allow cross-origin requests
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/gspot_lib.php';


loadDotEnv(__DIR__ . '/.env');
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');


/**
 * listens and checks for a POST request,
 * then it checks that the data is not empty and send corresponding error messages
 * if the message is login, then it checks if the person is in the DB using a basic SELECt query
 * if the message is register, we first check if the user is already in the DB, if so
 * return an accoring message, otherwise, INSERT the new username and password into the DB and return success
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

    if ($data["type"] == "login") {
        $con = connect_to_db($servername, $username, $password, $dbname);
        $sql_string = "SELECT * FROM users WHERE username = ? AND password = ?";
        $result = login($con, $sql_string, $data['username'], $data['password']);

        if (! $result) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid username or password.'
            ]);
            exit;
        }

        echo json_encode([
            'status' => 'success',
            'data' => "login successful"
        ]);
        exit;
    }

    if ($data["type"] == "register") {
        $con = connect_to_db($servername, $username, $password, $dbname);
        $sql_string = "SELECT * FROM users WHERE username = ? AND password = ?";
        $result = login($con, $sql_string, $data['username'], $data['password']);

        if ($result) {
            echo json_encode([
                'status' => 'error',
                'message' => 'User already exists.'
            ]);
            exit;
        }
        $sql_string = "INSERT INTO users (username, password) VALUES (?, ?)";
        $result = register($con, $sql_string, $data['username'], $data['password']);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}

function login(mysqli $con, string $sql_string, $types, $values): mysqli_result|false
{
    $stmt = $con->prepare($sql_string);
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $con->close();
    return $result;
}

function register(mysqli $con, string $sql_string, $types, $values): void
{
    $stmt = $con->prepare($sql_string);
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    $stmt->close();
    $con->close();
    return;
}
