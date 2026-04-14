<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    die("ID no válido");
}

$id = (int) $_GET['id'];

/* =========================
   OBTENER PRESUPUESTO
========================= */
$stmt = $db->prepare("
    SELECT * FROM presupuestos
    WHERE id = ? AND usuario_id = ?
");
$stmt->execute([$id, $usuario_id]);
$presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$presupuesto) {
    die("Presupuesto no encontrado");
}

/* =========================
   ACTUALIZAR
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $monto = $_POST['monto'];
    $tipo_periodo = $_POST['tipo_periodo'];
    $fecha_inicio = $_POST['fecha_inicio'];

    if ($monto <= 0) {
        die("Monto inválido");
    }

    if (!in_array($tipo_periodo, ['semanal','quincenal','mensual'])) {
        die("Tipo inválido");
    }

    $stmt = $db->prepare("
        UPDATE presupuestos
        SET monto = ?, tipo_periodo = ?, fecha_inicio = ?
        WHERE id = ? AND usuario_id = ?
    ");

    $stmt->execute([$monto, $tipo_periodo, $fecha_inicio, $id, $usuario_id]);

    header("Location: index.php");
    exit;
}
?>

<h1>Editar Presupuesto</h1>

<form method="POST">

    <label>Monto:</label><br>
    <input type="number" step="0.01" name="monto"
           value="<?= htmlspecialchars($presupuesto['monto']) ?>" required>
    <br><br>

    <label>Tipo de periodo:</label><br>
    <select name="tipo_periodo" required>
        <option value="semanal" <?= $presupuesto['tipo_periodo']=='semanal' ? 'selected' : '' ?>>Semanal</option>
        <option value="quincenal" <?= $presupuesto['tipo_periodo']=='quincenal' ? 'selected' : '' ?>>Quincenal</option>
        <option value="mensual" <?= $presupuesto['tipo_periodo']=='mensual' ? 'selected' : '' ?>>Mensual</option>
    </select>
    <br><br>

    <label>Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio"
           value="<?= htmlspecialchars($presupuesto['fecha_inicio']) ?>" required>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
