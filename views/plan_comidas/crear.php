<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dia = $_POST['dia'];
    $desayuno = $_POST['desayuno'];
    $almuerzo = $_POST['almuerzo'];
    $cena = $_POST['cena'];
    $calorias = $_POST['calorias_estimadas'];

    $stmt = $db->prepare("
        INSERT INTO plan_comidas 
        (usuario_id, dia, desayuno, almuerzo, cena, calorias_estimadas)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $dia, $desayuno, $almuerzo, $cena, $calorias]);

    header("Location: index.php");
    exit;
}
?>

<h1>Agregar Plan de Comidas</h1>

<form method="POST">

    <label>Día:</label><br>
    <select name="dia" required>
        <option value="Monday">Lunes</option>
        <option value="Tuesday">Martes</option>
        <option value="Wednesday">Miércoles</option>
        <option value="Thursday">Jueves</option>
        <option value="Friday">Viernes</option>
        <option value="Saturday">Sábado</option>
        <option value="Sunday">Domingo</option>
    </select>
    <br><br>

    <label>Desayuno:</label><br>
    <input type="text" name="desayuno"><br><br>

    <label>Almuerzo:</label><br>
    <input type="text" name="almuerzo"><br><br>

    <label>Cena:</label><br>
    <input type="text" name="cena"><br><br>

    <label>Calorías estimadas:</label><br>
    <input type="number" name="calorias_estimadas"><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
