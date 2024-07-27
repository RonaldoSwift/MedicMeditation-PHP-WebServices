<?php
header("Content-Type: application/json");
include '../db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}
//Este servicio se usa para el Sign Up de aplicaciones
function handlePost($pdo, $input) {
    $sql = "INSERT INTO user (id, name, email, password) VALUES (:id, :name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id'],'name' => $input['name'],'email' => $input['email'],'password' => $input['password']]);
    echo json_encode(['message' => 'User created successfully']);
}
// Se usa para actuaizar en la pantalla perfil de los usuarios
function handlePut($pdo, $input) {
    $sql = "UPDATE user SET name = :name, email = :email, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email'],'password' => $input['password'], 'id' => $input['id']]);
    echo json_encode(['message' => 'User updated successfully']);
}
?>