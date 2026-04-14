<?php require_once '../layouts/header.php'; ?>

<h1>🍽 Plan de Comidas</h1>

<div class="kpi-card form-container">
<a href="plan_comidas.php?action=crear" class="btn">➕ Nuevo Plan</a>
<br><br>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<form method="POST" action="plan_comidas.php?action=store">
    <select name="dia" required>
        <option>Lunes</option><option>Martes</option><option>Miércoles</option>
        <option>Jueves</option><option>Viernes</option><option>Sábado</option><option>Domingo</option>
    </select>

    <input type="text" name="desayuno" placeholder="Desayuno">
    <input type="text" name="almuerzo" placeholder="Almuerzo">
    <input type="text" name="cena" placeholder="Cena">
    <input type="number" name="calorias_estimadas" placeholder="Calorías estimadas">

    <button type="submit" class="btn-principal">Guardar</button>
</form>
</div>
<br>
<?php endif; ?>

<div class="kpi-card">
<table class="tabla-moderna">
<tr>
    <th>Día</th>
    <th>Desayuno</th>
    <th>Almuerzo</th>
    <th>Cena</th>
    <th>Calorías</th>
    <th>Acción</th>
</tr>

<?php foreach ($planes as $p): ?>
<tr>
    <td><?= htmlspecialchars($p['dia']) ?></td>
    <td><?= htmlspecialchars($p['desayuno']) ?></td>
    <td><?= htmlspecialchars($p['almuerzo']) ?></td>
    <td><?= htmlspecialchars($p['cena']) ?></td>
    <td><?= htmlspecialchars($p['calorias_estimadas']) ?></td>
    <td>
        <a href="plan_comidas.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar plan?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once '../layouts/footer.php'; ?>
