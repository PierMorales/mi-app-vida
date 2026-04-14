<?php
session_start();
require_once '../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['usuario_nombre'] = $user['nombre'];
    header("Location: ../dashboard.php");

    exit();
} else {
    echo "Credenciales incorrectas";
}
?>
