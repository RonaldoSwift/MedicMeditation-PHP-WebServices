<?php

$host = "db"; // it's db since we are using docker, normally it's localhost 
$user = "root";
$password = "your_root_password";
$dbname = "your_database_name";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>


