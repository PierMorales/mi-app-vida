<?php require_once __DIR__ . '/../../../layouts/header.php'; ?>

<h1>💪 Mis Rutinas</h1>

<a href="rutinas.php?action=crear" class="btn">➕ Nueva Rutina</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="rutinas.php?action=store">
        <input type="text" name="nombre_rutina" placeholder="Nombre (Ej: Empuje, Pierna)" required>
        <textarea name="descripcion" placeholder="Detalles de los ejercicios..." style="width: 100%; height: 100px; margin-top: 10px;"></textarea>
        <br><br>
        <button type="submit" class="btn">Guardar Rutina</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-grid">
<?php foreach ($rutinas as $r): ?>
    <div class="kpi-card">
        <h3><?= htmlspecialchars($r['nombre_rutina']) ?></h3>
        <p style="white-space: pre-line;"><?= htmlspecialchars($r['descripcion']) ?></p>
        <br>
        <a class="btn-mini-rojo" href="rutinas.php?action=delete&id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar rutina?')">🗑</a>
    </div>
<?php endforeach; ?>
</div>

<br>
<a href="../../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once __DIR__ . '/../../../layouts/footer.php'; ?>
