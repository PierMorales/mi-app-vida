<h1>Metas</h1>

<a href="metas.php?action=crear">➕ Nueva Meta</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<form method="POST" action="metas.php?action=store">
    <input type="text" name="nombre_meta" placeholder="Nombre de la meta" required>
    <input type="number" step="0.01" name="monto_objetivo" placeholder="Monto objetivo" required>
    <input type="date" name="fecha_objetivo" required>

    <select name="tipo" required>
        <option value="Ahorro">Ahorro</option>
        <option value="Electrodoméstico">Electrodoméstico</option>
    </select>

    <button type="submit">Guardar</button>
</form>
<br>
<?php endif; ?>

<table border="1" cellpadding="10">
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
            <input type="number" step="0.01" name="monto" placeholder="Aporte" required>
            <button type="submit">Aportar</button>
        </form>

        <a href="metas.php?action=delete&id=<?= $meta['id'] ?>" onclick="return confirm('¿Eliminar meta?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="../dashboard.php">⬅ Volver</a>
