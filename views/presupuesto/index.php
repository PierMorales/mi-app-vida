<h1>Presupuestos</h1>

<a href="presupuesto.php?action=crear">➕ Nuevo Presupuesto</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<form method="POST" action="presupuesto.php?action=store">
    <input type="number" step="0.01" name="monto" placeholder="Monto" required>

    <select name="tipo_periodo" required>
        <option value="semanal">Semanal</option>
        <option value="quincenal">Quincenal</option>
        <option value="mensual">Mensual</option>
    </select>

    <input type="date" name="fecha_inicio" required>

    <button type="submit">Guardar</button>
</form>
<br>
<?php endif; ?>

<table border="1" cellpadding="10">
<tr>
    <th>Monto</th>
    <th>Periodo</th>
    <th>Inicio</th>
    <th>Acciones</th>
</tr>

<?php foreach ($presupuestos as $p): ?>
<tr>
    <td>$<?= number_format($p['monto'],2) ?></td>
    <td><?= ucfirst($p['tipo_periodo']) ?></td>
    <td><?= $p['fecha_inicio'] ?></td>
    <td>
        <a href="presupuesto.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="../dashboard.php">⬅ Volver</a>
