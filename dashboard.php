<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

/* =========================
   DATOS FINANCIEROS BASE
========================= */

$stmt = $db->prepare("
    SELECT
        (SELECT COALESCE(SUM(monto),0) FROM gastos WHERE usuario_id = ?) AS total,
        (SELECT COALESCE(SUM(monto),0) FROM gastos WHERE usuario_id = ? AND EXTRACT(MONTH FROM fecha)=EXTRACT(MONTH FROM CURRENT_DATE) AND EXTRACT(YEAR FROM fecha)=EXTRACT(YEAR FROM CURRENT_DATE)) AS total_mes,
        (SELECT COALESCE(SUM(monto),0) FROM deudas WHERE usuario_id = ? AND estado='pendiente') AS total_deudas,
        (SELECT COALESCE(SUM(ahorrado),0) FROM metas WHERE usuario_id = ?) AS total_ahorrado
");
$stmt->execute([$usuario_id, $usuario_id, $usuario_id, $usuario_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$total = $data['total'];
$total_mes = $data['total_mes'];
$total_deudas = $data['total_deudas'];
$total_ahorrado = $data['total_ahorrado'];

/* =========================
   PRESUPUESTO ACTIVO
========================= */

$stmt_presupuesto = $db->prepare("
    SELECT * FROM presupuestos
    WHERE usuario_id = ?
    ORDER BY fecha_inicio DESC
    LIMIT 1
");
$stmt_presupuesto->execute([$usuario_id]);
$presupuestoActivo = $stmt_presupuesto->fetch(PDO::FETCH_ASSOC);

$dineroDisponible = 0;
$totalGastosPeriodo = 0;
$porcentajeUso = 0;

if ($presupuestoActivo) {

    $tipo = $presupuestoActivo['tipo_periodo'];

    if ($tipo === 'semanal') {
        $fechaInicioPeriodo = date('Y-m-d', strtotime('-7 days'));
    }

    if ($tipo === 'quincenal') {
        $fechaInicioPeriodo = date('Y-m-d', strtotime('-15 days'));
    }

    if ($tipo === 'mensual') {
        $fechaInicioPeriodo = date('Y-m-01');
    }

    $stmt_gastos_periodo = $db->prepare("
        SELECT COALESCE(SUM(monto),0)
        FROM gastos
        WHERE usuario_id = ?
        AND fecha >= ?
    ");
    $stmt_gastos_periodo->execute([$usuario_id, $fechaInicioPeriodo]);
    $totalGastosPeriodo = $stmt_gastos_periodo->fetchColumn();

    $dineroDisponible = $presupuestoActivo['monto'] - $totalGastosPeriodo;

    if ($presupuestoActivo['monto'] > 0) {
        $porcentajeUso = ($totalGastosPeriodo / $presupuestoActivo['monto']) * 100;
        if ($porcentajeUso > 100) $porcentajeUso = 100;
    }
}

/* =========================
   TOTAL COMPRAS PENDIENTES
========================= */

$stmt_compras = $db->prepare("
    SELECT COALESCE(SUM(cantidad * precio_estimado),0)
    FROM compras
    WHERE usuario_id = ? AND comprado = FALSE
");
$stmt_compras->execute([$usuario_id]);
$totalComprasPendientes = $stmt_compras->fetchColumn();

/* =========================
   COLOR PROGRESO
========================= */

$colorBarra = 'progress-green';
if ($porcentajeUso >= 70) $colorBarra = 'progress-orange';
if ($porcentajeUso >= 90) $colorBarra = 'progress-red';
?>

<?php require_once 'layouts/header.php'; ?>

<div class="topbar">
    <strong>Resumen General</strong>
</div>

<div class="kpi-grid">

    <div class="kpi-card">
        <h3>💰 Disponible</h3>
        <div class="kpi-value <?= $dineroDisponible >= 0 ? 'verde' : 'rojo' ?>">
            $<?= number_format($dineroDisponible,2) ?>
        </div>
    </div>

    <div class="kpi-card">
        <h3>📊 Presupuesto</h3>
        <div class="kpi-value">
            $<?= number_format($presupuestoActivo['monto'] ?? 0,2) ?>
        </div>
    </div>

    <div class="kpi-card">
        <h3>🛒 Compras Pendientes</h3>
        <div class="kpi-value">
            $<?= number_format($totalComprasPendientes,2) ?>
        </div>
    </div>

    <div class="kpi-card">
        <h3>💳 Deudas</h3>
        <div class="kpi-value">
            $<?= number_format($total_deudas,2) ?>
        </div>
    </div>

</div>

<div class="kpi-card">
    <h3>Uso del Presupuesto (<?= number_format($porcentajeUso,1) ?>%)</h3>

    <div class="progress-container">
        <div class="progress-bar <?= $colorBarra ?>" 
                style="width: <?= $porcentajeUso ?>%;">
        </div>
    </div>

    <p>Gastado: $<?= number_format($totalGastosPeriodo,2) ?></p>

    <?php if ($totalComprasPendientes > $dineroDisponible): ?>
        <div class="alerta-roja">
            ⚠️ Tus compras superan tu dinero disponible.
        </div>
    <?php endif; ?>
</div>

<?php require_once 'layouts/footer.php'; ?>

