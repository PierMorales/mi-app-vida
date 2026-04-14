<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $monto_objetivo = $_POST['monto_objetivo'];
    $fecha_limite = $_POST['fecha_limite'];
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $db->prepare("
        INSERT INTO metas (usuario_id, nombre, monto_objetivo, fecha_limite) 
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $nombre, $monto_objetivo, $fecha_limite]);

    header("Location: index.php");
    exit;
}
?>

<h2>Nueva Meta</h2>

<form method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Monto Objetivo:</label><br>
    <input type="number" step="0.01" name="monto_objetivo" required><br><br>

    <label>Fecha límite:</label><br>
    <input type="date" name="fecha_limite"><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">Volver</a>
