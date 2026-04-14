<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/CompraController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new CompraController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: compras.php");
    exit;
}

if ($action === 'toggle') {
    $controller->toggle($usuario_id, (int)($_GET['id'] ?? 0));
    header("Location: compras.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy($usuario_id, (int)($_GET['id'] ?? 0));
    header("Location: compras.php");
    exit;
}

$compras = $controller->index($usuario_id);
$totales = $controller->totales($usuario_id);

require_once __DIR__ . '/../views/compras/index.php';
