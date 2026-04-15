<?php require_once __DIR__ . '/../../../layouts/header.php'; ?>

<h1>⚖️ Registro de Peso</h1>

<a href="peso.php?action=crear" class="btn">➕ Nuevo Registro</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="peso.php?action=store">
        <input type="date" name="fecha" required>
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
    <th>Peso</th>
</tr>

<?php foreach ($pesos as $p): ?>
<tr>
    <td><?= htmlspecialchars($p['fecha']) ?></td>
    <td><?= htmlspecialchars($p['peso']) ?> kg</td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once __DIR__ . '/../../../layouts/footer.php'; ?>

