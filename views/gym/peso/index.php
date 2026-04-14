<h1>Registro de Peso</h1>

<form method="POST" action="peso.php?action=store">
    <input type="date" name="fecha" required>
    <input type="number" step="0.1" name="peso" placeholder="Peso en kg" required>
    <button type="submit">Guardar</button>
</form>

<br>

<table border="1" cellpadding="10">
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

<br>
<a href="../dashboard.php">⬅ Volver</a>
