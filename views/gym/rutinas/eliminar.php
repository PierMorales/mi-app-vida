<?php
session_start();
require_once '../../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id = $_GET['id'];

$stmt = $db->prepare("
    DELETE FROM rutinas 
    WHERE id = ? AND usuario_id = ?
");
$stmt->execute([$id, $usuario_id]);

header("Location: index.php");
exit;
