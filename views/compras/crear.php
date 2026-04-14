<?php
require_once '../../layouts/header.php';
require_once '../../config/database.php';

$usuario_id = $_SESSION['usuario_id'];

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre_producto']);
    $cantidad = (int) $_POST['cantidad'];
    $precio = (float) $_POST['precio_estimado'];

    if ($nombre === '') {
        $errores[] = "El nombre del producto es obligatorio.";
    }

    if ($cantidad <= 0) {
        $errores[] = "La cantidad debe ser mayor a 0.";
    }

    if ($precio < 0) {
        $errores[] = "El precio no puede ser negativo.";
    }

    if (empty($errores)) {

        $stmt = $db->prepare("
            INSERT INTO compras (usuario_id, nombre_producto, cantidad, precio_estimado)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$usuario_id, $nombre, $cantidad, $precio]);

        header("Location: index.php");
        exit;
    }
}
?>

<h1>🛒 Agregar Producto</h1>

<div class="kpi-card form-container">

    <?php if (!empty($errores)): ?>
        <div class="alerta-roja">
            <?php foreach ($errores as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" id="formCompras">

        <div class="form-group">
            <label>Nombre del producto</label>
            <input type="text"
                   name="nombre_producto"
                   class="form-input"
                   placeholder="Ej: Arroz"
                   required>
        </div>

        <div class="form-group">
            <label>Cantidad</label>
            <input type="number"
                   name="cantidad"
                   id="cantidad"
                   class="form-input"
                   value="1"
                   min="1"
                   required>
        </div>

        <div class="form-group">
            <label>Precio estimado</label>
            <input type="number"
                   step="0.01"
                   name="precio_estimado"
                   id="precio"
                   class="form-input"
                   placeholder="0.00"
                   required>
        </div>

        <div class="form-group">
            <label>Total estimado</label>
            <input type="text"
                   id="total"
                   class="form-input"
                   readonly>
        </div>

        <button type="submit" class="btn-principal">
            Guardar Producto
        </button>

    </form>

</div>
<script>
const cantidad = document.getElementById("cantidad");
const precio = document.getElementById("precio");
const total = document.getElementById("total");

function calcularTotal() {
    const c = parseFloat(cantidad.value) || 0;
    const p = parseFloat(precio.value) || 0;
    total.value = "$ " + (c * p).toFixed(2);
}

cantidad.addEventListener("input", calcularTotal);
precio.addEventListener("input", calcularTotal);

calcularTotal();
</script>

<br>
<a href="index.php" class="btn">⬅ Volver</a>

<?php require_once '../../layouts/footer.php'; ?>
