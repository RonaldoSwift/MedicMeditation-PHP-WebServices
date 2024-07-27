<?php
header("Content-Type: application/json");
include '../db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo) {
    //Parametros de consulta
    $id = $_GET['id'];
    $sql = "SELECT * FROM music_detalle WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response = [
        'status' => '1',
        'data' => $result,
        'message' => 'Music Detalle'
    ];
    //Bota response en POSTMAN
    echo json_encode($response);
}
?>
