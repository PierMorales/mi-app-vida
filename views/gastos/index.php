

<h1>💵 Gastos</h1>

<div class="kpi-grid">

    <div class="kpi-card">
        <h3>Total este mes</h3>
        <div class="kpi-value rojo">
            $<?= number_format($total_mes, 2) ?>
        </div>
    </div>

</div>

<a href="gastos.php?action=crear" class="btn">➕ Agregar Gasto</a>

<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>

<div class="kpi-card">

    <form method="POST" action="gastos.php?action=store">

        <input type="date" name="fecha" required>

        <input type="text" name="categoria" placeholder="Categoría (Ej: Alimentación)" required>

        <input type="number" step="0.01" name="monto" placeholder="Monto" required>

        <input type="text" name="descripcion" placeholder="Descripción (Opcional)">

        <br><br>
        <button type="submit" class="btn">Guardar Gasto</button>

    </form>

</div>

<br>

<?php endif; ?>

<div class="kpi-card">

<table class="tabla-moderna">

<tr>
    <th>Fecha</th>
    <th>Categoría</th>
    <th>Monto</th>
    <th>Descripción</th>
    <th>Acción</th>
</tr>

<?php foreach ($gastos as $g): ?>

<tr>
    <td><?= date('d/m/Y', strtotime($g['fecha'])) ?></td>
    <td><?= htmlspecialchars($g['categoria']) ?></td>
    <td class="rojo">$<?= number_format($g['monto'], 2) ?></td>
    <td><?= htmlspecialchars($g['descripcion']) ?></td>
    <td>
        <a class="btn-mini-rojo"
           href="gastos.php?action=delete&id=<?= $g['id'] ?>"
           onclick="return confirm('¿Eliminar gasto?')">
           🗑
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</div>

<br>
<a href="/dashboard.php" class="btn">⬅ Volver</a>


