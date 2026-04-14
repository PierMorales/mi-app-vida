<?php
session_start();
require_once '../../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha = $_POST['fecha'];
    $peso = $_POST['peso'];

    $stmt = $db->prepare("
        INSERT INTO peso (usuario_id, fecha, peso)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $fecha, $peso]);

    header("Location: index.php");
    exit;
}
?>

<h1>Registrar Peso</h1>

<form method="POST">
    <label>Fecha:</label><br>
    <input type="date" name="fecha" required><br><br>

    <label>Peso (kg):</label><br>
    <input type="number" step="0.01" name="peso" required><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
