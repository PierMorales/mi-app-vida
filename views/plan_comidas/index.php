<h1>Plan de Comidas</h1>

<a href="plan_comidas.php?action=crear">➕ Nuevo Plan</a>
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

    <button type="submit">Guardar</button>
</form>
<br>
<?php endif; ?>

<table border="1" cellpadding="10">
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

<br>
<a href="../dashboard.php">⬅ Volver</a>
