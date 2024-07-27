<?php
header("Content-Type: application/json");
include '../db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}
//Se usa en la pantalla PROFILE
function handleGet($pdo) {
    $sql = "SELECT * FROM user_detalle";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = [
        'status' => '1',
        'data' => $result,
        'message' => 'User Detalle'
    ];
    echo json_encode($response);
}

//Se usa en la pantalla PROFILE

function handlePut($pdo, $input) {
    $sql = "UPDATE user_detalle SET address = :address, dni = :dni, date_of_birth = :date_of_birth, cell_phone_number = :cell_phone_number WHERE id_user = :id_user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['address' => $input['address'], 'dni' => $input['dni'],'date_of_birth' => $input['date_of_birth'], 'cell_phone_number' => $input['cell_phone_number'], 'id_user' => $input['id_user']]);
    echo json_encode(['message' => 'User updated successfully']);
}
?>