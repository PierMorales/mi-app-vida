<?php
session_start();
require_once '../../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dia = $_POST['dia'];
    $tipo = $_POST['tipo'];
    $ejercicios = $_POST['ejercicios'];

    $stmt = $db->prepare("
        INSERT INTO rutinas (usuario_id, dia, tipo, ejercicios)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $dia, $tipo, $ejercicios]);

    header("Location: index.php");
    exit;
}
?>

<h1>Agregar Rutina</h1>

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

    <label>Tipo (Push / Pull / Pierna / etc):</label><br>
    <input type="text" name="tipo" required>
    <br><br>

    <label>Ejercicios:</label><br>
    <textarea name="ejercicios" rows="5" required></textarea>
    <br><br>

    <button type="submit">Guardar</button>

</form>

<br>
<a href="index.php">⬅ Volver</a>
