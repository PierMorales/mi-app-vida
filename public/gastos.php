<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/GastoController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new GastoController($db);

$action = $_GET['action'] ?? 'index';

/* ==== ACCIONES ==== */

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: gastos.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy((int)($_GET['id'] ?? 0), $usuario_id);
    header("Location: gastos.php");
    exit;
}

/* ==== DATOS PARA LA VISTA ==== */

$gastos = $controller->index($usuario_id);
$total_mes = $controller->totalMes($usuario_id);

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../views/gastos/index.php';
require_once __DIR__ . '/../layouts/footer.php';
