

<h1>🛒 Compras</h1>

<div class="kpi-grid">

    <div class="kpi-card">
        <h3>Total Pendiente</h3>
        <div class="kpi-value rojo">
            $<?= number_format($totales['total_pendiente'] ?? 0, 2) ?>
        </div>
    </div>

    <div class="kpi-card">
        <h3>Total Comprado</h3>
        <div class="kpi-value verde">
            $<?= number_format($totales['total_comprado'] ?? 0, 2) ?>
        </div>
    </div>

    <div class="kpi-card">
        <h3>Total General</h3>
        <div class="kpi-value">
            $<?= number_format($totales['total_general'] ?? 0, 2) ?>
        </div>
    </div>

</div>

<a href="compras.php?action=crear" class="btn">➕ Nuevo Producto</a>

<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>

<div class="kpi-card">
    <form method="POST" action="compras.php?action=store">

        <input type="text" name="nombre_producto" placeholder="Producto" required>

        <input type="number" name="cantidad" value="1" min="1" required>

        <input type="number" step="0.01" name="precio_estimado" 
               placeholder="Precio estimado" min="0" required>

        <br><br>
        <button type="submit" class="btn">Guardar</button>

    </form>
</div>

<br>

<?php endif; ?>

<div class="kpi-card">

<table class="tabla-moderna">

<tr>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Precio</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>

<?php foreach ($compras as $c): ?>

<tr>
    <td><?= htmlspecialchars($c['nombre_producto']) ?></td>
    <td><?= (int)$c['cantidad'] ?></td>
    <td>$<?= number_format((float)$c['precio_estimado'], 2) ?></td>

    <td>
        <?php if ((int)$c['comprado'] === 1): ?>
            <span class="badge-verde">Comprado</span>
        <?php else: ?>
            <span class="badge-naranja">Pendiente</span>
        <?php endif; ?>
    </td>

    <td>
        <a class="btn-mini" href="compras.php?action=toggle&id=<?= $c['id'] ?>">
            <?= ((int)$c['comprado'] === 1) ? "↩ Pendiente" : "✔ Comprar" ?>
        </a>

        <a class="btn-mini-rojo" 
           href="compras.php?action=delete&id=<?= $c['id'] ?>"
           onclick="return confirm('¿Eliminar producto?')">
           🗑
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>


