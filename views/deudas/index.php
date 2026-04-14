<?php require_once '../layouts/header.php'; ?>

<h1>💳 Deudas</h1>

<div class="kpi-grid">

    <div class="kpi-card">
        <h3>Total Pendiente</h3>
        <div class="kpi-value rojo">
            $<?= number_format($total_pendiente, 2) ?>
        </div>
    </div>

</div>

<a href="deudas.php?action=crear" class="btn">➕ Nueva Deuda</a>

<br><br>

<?php if (($_GET['action'] ?? '') === 'crear'): ?>

<div class="kpi-card form-container">

    <form method="POST" action="deudas.php?action=store">

        <div class="form-group">
            <label>Descripción</label>
            <input type="text"
                   name="descripcion"
                   class="form-input"
                   placeholder="Ej: Tarjeta de crédito"
                   required>
        </div>

        <div class="form-group">
            <label>Monto</label>
            <input type="number"
                   step="0.01"
                   name="monto"
                   class="form-input"
                   placeholder="0.00"
                   required>
        </div>

        <div class="form-group">
            <label>Fecha límite</label>
            <input type="date"
                   name="fecha_limite"
                   class="form-input"
                   required>
        </div>

        <button type="submit" class="btn-principal">
            Guardar Deuda
        </button>

    </form>

</div>

<br>

<?php endif; ?>

<div class="kpi-card">

<table class="tabla-moderna">

<tr>
    <th>Descripción</th>
    <th>Monto</th>
    <th>Fecha límite</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>

<?php foreach ($deudas as $deuda): ?>

<tr>
    <td><?= htmlspecialchars($deuda['descripcion']) ?></td>

    <td>$<?= number_format($deuda['monto'], 2) ?></td>

    <td><?= date('d/m/Y', strtotime($deuda['fecha_limite'])) ?></td>

    <td>
        <?php if ($deuda['estado'] === 'pendiente'): ?>
            <span class="badge-rojo">Pendiente</span>
        <?php else: ?>
            <span class="badge-verde">Pagada</span>
        <?php endif; ?>
    </td>

    <td>
        <?php if ($deuda['estado'] === 'pendiente'): ?>
            <a class="btn-mini"
               href="deudas.php?action=pagar&id=<?= $deuda['id'] ?>">
               ✔ Pagar
            </a>
        <?php endif; ?>

        <a class="btn-mini-rojo"
           href="deudas.php?action=delete&id=<?= $deuda['id'] ?>"
           onclick="return confirm('¿Eliminar deuda?')">
           🗑
        </a>
    </td>

</tr>

<?php endforeach; ?>

</table>

</div>

<br>
<a href="../dashboard.php" class="btn">⬅ Volver</a>

<?php require_once '../layouts/footer.php'; ?>
