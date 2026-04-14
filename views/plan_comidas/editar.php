<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$id = $_GET['id'];

$stmt = $db->prepare("
    SELECT * FROM plan_comidas
    WHERE id = ? AND usuario_id = ?
");
$stmt->execute([$id, $usuario_id]);
$plan = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$plan) {
    die("Plan no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dia = $_POST['dia'];
    $desayuno = $_POST['desayuno'];
    $almuerzo = $_POST['almuerzo'];
    $cena = $_POST['cena'];
    $calorias = $_POST['calorias_estimadas'];

    $stmt = $db->prepare("
        UPDATE plan_comidas
        SET dia = ?, desayuno = ?, almuerzo = ?, cena = ?, calorias_estimadas = ?
        WHERE id = ? AND usuario_id = ?
    ");

    $stmt->execute([$dia, $desayuno, $almuerzo, $cena, $calorias, $id, $usuario_id]);

    header("Location: index.php");
    exit;
}
?>

<h1>Editar Plan</h1>

<form method="POST">

    <label>Día:</label><br>
    <select name="dia">
        <option value="Monday" <?= $plan['dia']=='Monday'?'selected':'' ?>>Lunes</option>
        <option value="Tuesday" <?= $plan['dia']=='Tuesday'?'selected':'' ?>>Martes</option>
        <option value="Wednesday" <?= $plan['dia']=='Wednesday'?'selected':'' ?>>Miércoles</option>
        <option value="Thursday" <?= $plan['dia']=='Thursday'?'selected':'' ?>>Jueves</option>
        <option value="Friday" <?= $plan['dia']=='Friday'?'selected':'' ?>>Viernes</option>
        <option value="Saturday" <?= $plan['dia']=='Saturday'?'selected':'' ?>>Sábado</option>
        <option value="Sunday" <?= $plan['dia']=='Sunday'?'selected':'' ?>>Domingo</option>
    </select>
    <br><br>

    <label>Desayuno:</label><br>
    <input type="text" name="desayuno" value="<?= htmlspecialchars($plan['desayuno']) ?>"><br><br>

    <label>Almuerzo:</label><br>
    <input type="text" name="almuerzo" value="<?= htmlspecialchars($plan['almuerzo']) ?>"><br><br>

    <label>Cena:</label><br>
    <input type="text" name="cena" value="<?= htmlspecialchars($plan['cena']) ?>"><br><br>

    <label>Calorías estimadas:</label><br>
    <input type="number" name="calorias_estimadas" value="<?= $plan['calorias_estimadas'] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
