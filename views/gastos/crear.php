<?php
require_once '../../layouts/header.php';
require_once '../../config/database.php';

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];

    $stmt = $db->prepare("
        INSERT INTO gastos (usuario_id, descripcion, monto, fecha)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$usuario_id, $descripcion, $monto, $fecha]);

    header("Location: index.php");
    exit;
}
?>

<h1>💵 Agregar Gasto</h1>

<div class="kpi-card form-container">

    <form method="POST">

        <div class="form-group">
            <label>Descripción</label>
            <input type="text"
                   name="descripcion"
                   class="form-input"
                   placeholder="Ej: Supermercado"
                   required>
        </div>

        <div class="form-group">
            <label>Monto</label>
            <input type="number"
                   step="0.01"
                   name="monto"
                   class="form-input"
                   placeholder="0.00"
                   required>
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date"
                   name="fecha"
                   class="form-input"
                   required>
        </div>

        <button type="submit" class="btn-principal">
            Guardar Gasto
        </button>

    </form>

</div>

<br>
<a href="index.php" class="btn">⬅ Volver</a>

<?php require_once '../../layouts/footer.php'; ?>
