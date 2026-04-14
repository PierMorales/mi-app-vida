<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $monto = $_POST['monto'];
    $tipo_periodo = $_POST['tipo_periodo'];
    $fecha_inicio = $_POST['fecha_inicio'];

    // Validaciones mínimas
    if ($monto <= 0) {
        die("Monto inválido");
    }

    if (!in_array($tipo_periodo, ['semanal','quincenal','mensual'])) {
        die("Tipo inválido");
    }

    $stmt = $db->prepare("
        INSERT INTO presupuestos (usuario_id, monto, tipo_periodo, fecha_inicio)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $monto, $tipo_periodo, $fecha_inicio]);

    header("Location: index.php");
    exit;
}
?>

<h1>Crear Presupuesto</h1>

<form method="POST">

    <label>Monto:</label><br>
    <input type="number" step="0.01" name="monto" required>
    <br><br>

    <label>Tipo de periodo:</label><br>
    <select name="tipo_periodo" required>
        <option value="semanal">Semanal</option>
        <option value="quincenal">Quincenal</option>
        <option value="mensual">Mensual</option>
    </select>
    <br><br>

    <label>Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio" required>
    <br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
