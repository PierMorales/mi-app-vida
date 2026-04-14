<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/PresupuestoController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new PresupuestoController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: presupuesto.php");
    exit;
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($_GET['id'], $usuario_id, $_POST);
    header("Location: presupuesto.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy($usuario_id, $_GET['id']);
    header("Location: presupuesto.php");
    exit;
}

$presupuestos = $controller->index($usuario_id);

require_once __DIR__ . '/../views/presupuesto/index.php';
