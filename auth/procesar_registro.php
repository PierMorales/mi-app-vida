<?php
require_once '../config/database.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);

try {
    $stmt->execute([$nombre, $email, $password]);
    echo "Usuario registrado correctamente <br>";
    echo "<a href='login.php'>Ir a Login</a>";
} catch (PDOException $e) {
    echo "Error: El email ya existe.";
}
?>
