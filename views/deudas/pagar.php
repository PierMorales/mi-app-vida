<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $db->prepare("
        UPDATE deudas 
        SET estado = 'pagada' 
        WHERE id = ? AND usuario_id = ?
    ");

    $stmt->execute([$id, $usuario_id]);
}

header("Location: index.php");
exit;
?>
