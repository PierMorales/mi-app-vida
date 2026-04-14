<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $fecha_limite = $_POST['fecha_limite'];
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $db->prepare("
        INSERT INTO deudas (usuario_id, descripcion, monto, fecha_limite)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $descripcion, $monto, $fecha_limite]);

    header("Location: index.php");
    exit;
}
?>

<h2>Nueva Deuda</h2>

<form method="POST">
    <label>Descripción:</label><br>
    <input type="text" name="descripcion" required><br><br>

    <label>Monto:</label><br>
    <input type="number" step="0.01" name="monto" required><br><br>

    <label>Fecha límite:</label><br>
    <input type="date" name="fecha_limite"><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">Volver</a>
