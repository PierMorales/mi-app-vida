<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>🎯 Metas de Ahorro</h1>

<a href="metas.php?action=crear" class="btn">➕ Nueva Meta</a>
<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>
<div class="kpi-card">
    <form method="POST" action="metas.php?action=store">
        <input type="text" name="nombre_meta" placeholder="Nombre de la Meta (Ej: Viaje)" required>
        <input type="number" step="0.01" name="monto_objetivo" placeholder="Monto Objetivo ($)" required>
        <input type="date" name="fecha_objetivo" required>
        <select name="tipo">
            <option value="ahorro">Ahorro</option>
            <option value="inversion">Inversión</option>
        </select>
        <br><br>
        <button type="submit" class="btn">Guardar Meta</button>
    </form>
</div>
<br>
<?php endif; ?>

<div class="kpi-grid">
<?php foreach ($metas as $m): 
    $progreso = ($m['monto_actual'] / $m['monto_objetivo']) * 100;
    $color = ($progreso >= 100) ? 'verde' : 'azul';
?>
    <div class="kpi-card">
        <h3><?= htmlspecialchars($m['nombre_meta']) ?></h3>
        <p>Objetivo: $<?= number_format($m['monto_objetivo'], 2) ?></p>
        <div class="kpi-value <?= $color ?>">
            $<?= number_format($m['monto_actual'], 2) ?>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar" style="width: <?= min($progreso, 100) ?>%;"></div>
        </div>
        <p><?= number_format($progreso, 1) ?>% alcanzado</p>

        <form method="POST" action="metas.php?action=aportar&id=<?= $m['id'] ?>" style="margin-top:10px;">
            <input type="number" step="0.01" name="monto" placeholder="Monto a aportar" required style="width:120px;">
            <button type="submit" class="btn-mini-azul">Aportar</button>
        </form>

        <br>
        <a class="btn-mini-rojo" href="metas.php?action=delete&id=<?= $m['id'] ?>" onclick="return confirm('¿Eliminar meta?')">Eliminar 🗑</a>
    </div>
<?php endforeach; ?>
</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
