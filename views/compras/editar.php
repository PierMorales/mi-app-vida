<?php
session_start();
require_once '../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$id = $_GET['id'];

$stmt = $db->prepare("SELECT * FROM compras WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuario_id]);
$compra = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$compra) {
    die("Producto no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio_estimado'];
    $comprado = isset($_POST['comprado']) ? 1 : 0;

    $stmt = $db->prepare("
        UPDATE compras 
        SET nombre_producto = ?, cantidad = ?, precio_estimado = ?, comprado = ?
        WHERE id = ? AND usuario_id = ?
    ");

    $stmt->execute([$nombre, $cantidad, $precio, $comprado, $id, $usuario_id]);

    header("Location: index.php");
    exit;
}
?>

<h1>Editar Producto</h1>

<form method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre_producto" value="<?= htmlspecialchars($compra['nombre_producto']) ?>" required><br><br>

    <label>Cantidad:</label><br>
    <input type="number" name="cantidad" value="<?= $compra['cantidad'] ?>" required><br><br>

    <label>Precio estimado:</label><br>
    <input type="number" step="0.01" name="precio_estimado" value="<?= $compra['precio_estimado'] ?>" required><br><br>

    <label>
        <input type="checkbox" name="comprado" <?= $compra['comprado'] ? 'checked' : '' ?>>
        Marcar como comprado
    </label><br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="index.php">⬅ Volver</a>
