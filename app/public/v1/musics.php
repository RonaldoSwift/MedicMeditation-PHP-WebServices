<?php
header("Content-Type: application/json");
include '../db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
//Parametro en Body -JSON
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo) {
    $sql = "SELECT * FROM music";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = [
        'status' => '1',
        'data' => $result,
        'message' => 'Hola'
    ];
    echo json_encode($response);
}
?>
