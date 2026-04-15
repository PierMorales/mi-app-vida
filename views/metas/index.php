<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>🎯 Metas</h1>

<a href="metas.php?action=crear" class="btn">➕ Nueva Meta</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="metas.php?action=store">
        <input type="text" name="nombre_meta" placeholder="Nombre de la meta" required>
        <input type="number" step="0.01" name="monto_objetivo" placeholder="Objetivo ($)" required>
        <input type="date" name="fecha_objetivo" required>

        <select name="tipo" required>
            <option value="Ahorro">Ahorro</option>
            <option value="Electrodoméstico">Electrodoméstico</option>
        </select>

        <br><br>
        <button type="submit" class="btn">Guardar Meta</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-card">
<table class="tabla-moderna">
<tr>
    <th>Meta</th>
    <th>Objetivo</th>
    <th>Ahorrado</th>
    <th>Progreso</th>
    <th>Acciones</th>
</tr>

<?php foreach ($metas as $meta): ?>
<tr>
    <td><?= htmlspecialchars($meta['nombre_meta']) ?></td>
    <td>$<?= number_format($meta['monto_objetivo'],2) ?></td>
    <td>$<?= number_format($meta['ahorrado'],2) ?></td>
    <td><?= number_format($meta['porcentaje'],1) ?>%</td>
    <td>
        <form method="POST" action="metas.php?action=aportar&id=<?= $meta['id'] ?>" style="display:inline;">
            <input type="number" step="0.01" name="monto" placeholder="Aporte" required style="width: 80px;">
            <button type="submit" class="btn-mini">Aportar</button>
        </form>

        <a class="btn-mini-rojo" href="metas.php?action=delete&id=<?= $meta['id'] ?>" onclick="return confirm('¿Eliminar meta?')">🗑</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>

