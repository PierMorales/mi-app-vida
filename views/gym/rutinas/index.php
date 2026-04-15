
<h1>💪 Mis Rutinas</h1>

<a href="rutinas.php?action=crear" class="btn">➕ Nueva Rutina</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="rutinas.php?action=store">
        <select name="dia" required>
            <option value="">-- Selecciona Día --</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>

        <input type="text" name="tipo" placeholder="Tipo (Ej: Empuje, Pierna, Tirón)" required>

        <textarea name="ejercicios" placeholder="Detalle de ejercicios..." style="width: 100%; height: 100px; margin-top: 10px;" required></textarea>

        <br><br>
        <button type="submit" class="btn">Guardar Rutina</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-card">
<table class="tabla-moderna">
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
    <td style="white-space: pre-line;"><?= htmlspecialchars($r['ejercicios']) ?></td>
    <td>
        <a class="btn-mini-rojo" href="rutinas.php?action=delete&id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar rutina?')">🗑</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<br>
<a href="/dashboard.php" class="btn">⬅ Volver</a>
