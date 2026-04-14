<h1>Rutinas</h1>

<a href="rutinas.php?action=crear">➕ Nueva Rutina</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<form method="POST" action="rutinas.php?action=store">
    <select name="dia" required>
        <option>Lunes</option><option>Martes</option><option>Miércoles</option>
        <option>Jueves</option><option>Viernes</option><option>Sábado</option><option>Domingo</option>
    </select>

    <input type="text" name="tipo" placeholder="Push / Pull / Pierna" required>
    <textarea name="ejercicios" placeholder="Ejercicios..." required></textarea>
    <button type="submit">Guardar</button>
</form>
<br>
<?php endif; ?>

<table border="1" cellpadding="10">
<tr>
    <th>Día</th>
    <th>Tipo</th>
    <th>Ejercicios</th>
    <th>Acción</th>
</tr>

<?php foreach ($rutinas as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['dia']) ?></td>
    <td><?= htmlspecialchars($r['tipo']) ?></td>
    <td><?= nl2br(htmlspecialchars($r['ejercicios'])) ?></td>
    <td><a href="rutinas.php?action=delete&id=<?= $r['id'] ?>">Eliminar</a></td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="../dashboard.php">⬅ Volver</a>
