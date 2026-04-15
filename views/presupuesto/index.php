

<h1>📊 Presupuestos</h1>

<a href="presupuesto.php?action=crear" class="btn">➕ Nuevo Presupuesto</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="presupuesto.php?action=store">
        <input type="number" step="0.01" name="monto" placeholder="Monto ($)" required>

        <select name="tipo_periodo" required>
            <option value="semanal">Semanal</option>
            <option value="quincenal">Quincenal</option>
            <option value="mensual">Mensual</option>
        </select>

        <input type="date" name="fecha_inicio" required>

        <br><br>
        <button type="submit" class="btn">Guardar Presupuesto</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-card">
<table class="tabla-moderna">
<tr>
    <th>Monto</th>
    <th>Periodo</th>
    <th>Inicio</th>
    <th>Acciones</th>
</tr>

<?php foreach ($presupuestos as $p): ?>
<tr>
    <td>$<?= number_format($p['monto'], 2) ?></td>
    <td><?= ucfirst($p['tipo_periodo']) ?></td>
    <td><?= $p['fecha_inicio'] ?></td>
    <td>
        <a class="btn-mini-rojo" href="presupuesto.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar?')">🗑</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="/dashboard.php" class="btn">⬅ Volver</a>


