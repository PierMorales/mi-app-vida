<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/DeudaController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new DeudaController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: deudas.php");
    exit;
}

if ($action === 'pagar') {
    $controller->pagar($usuario_id, $_GET['id']);
    header("Location: deudas.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy($usuario_id, $_GET['id']);
    header("Location: deudas.php");
    exit;
}

$deudas = $controller->index($usuario_id);
$total_pendiente = $controller->totalPendiente($usuario_id);

require_once __DIR__ . '/../views/deudas/index.php';
