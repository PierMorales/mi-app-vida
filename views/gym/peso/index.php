

<h1>⚖️ Control de Peso</h1>

<a href="peso.php?action=crear" class="btn">➕ Registrar Peso</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="peso.php?action=store">
        <input type="date" name="fecha" value="<?= date('Y-m-d') ?>" required>
        <input type="number" step="0.1" name="peso" placeholder="Peso (kg)" required>
        <br><br>
        <button type="submit" class="btn">Guardar Peso</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-card">
<table class="tabla-moderna">
<tr>
    <th>Fecha</th>
    <th>Peso (kg)</th>
    <th>Acción</th>
</tr>

<?php foreach ($pesos as $p): ?>
<tr>
    <td><?= date('d/m/Y', strtotime($p['fecha'])) ?></td>
    <td><?= number_format($p['peso'], 1) ?> kg</td>
    <td>
        <a class="btn-mini-rojo" href="peso.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar registro?')">🗑</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="../../dashboard.php" class="btn">⬅ Volver</a>


