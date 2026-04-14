<?php require_once '../layouts/header.php'; ?>

<h1>⚖️ Registro de Peso</h1>

<div class="kpi-card form-container">
<form method="POST" action="peso.php?action=store">
    <input type="date" name="fecha" required>
    <input type="number" step="0.1" name="peso" placeholder="Peso en kg" required>
    <button type="submit" class="btn-principal">Guardar</button>
</form>
</div>

<br>

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

<?php require_once '../layouts/footer.php'; ?>
