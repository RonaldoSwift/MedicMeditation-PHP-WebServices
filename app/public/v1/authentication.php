<?php
header("Content-Type: application/json");
include '../db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

//Este servicio se usa en el LOGIN
function handleGet($pdo) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM user WHERE email = $email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $accessToken = uniqid();
    $sql2 = "UPDATE user_token SET token = '$accessToken'";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    $result['accessToken'] = $accessToken;
    $response = [
        'status' => '1',
        'data' => $result,
        'message' => 'User'
    ];
    echo json_encode($response);
}

?>