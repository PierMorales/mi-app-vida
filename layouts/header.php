<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi Vida</title>
<link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="layout">

    <div class="sidebar">
        <h2>Mi Vida</h2>
        <a href="../dashboard.php">🏠 Dashboard</a>
        <a href="../public/gastos.php">💵 Gastos</a>
        <a href="../public/compras.php">🛒 Compras</a>
        <a href="../public/metas.php">🎯 Metas</a>
        <a href="../public/deudas.php">💳 Deudas</a>
        <a href="../public/presupuesto.php">📊 Presupuesto</a>
        <a href="../public/peso.php">⚖️ Peso</a>
        <a href="../public/rutinas.php">💪 Rutinas</a>
        <a href="../public/plan_comidas.php">🍽 Plan Comidas</a>
        <a href="../auth/logout.php">🚪 Salir</a>
    </div>

    <div class="main">
