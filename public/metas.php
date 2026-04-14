<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/MetaController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new MetaController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: metas.php");
    exit;
}

if ($action === 'aportar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->aportar($usuario_id, $_GET['id'], $_POST['monto']);
    header("Location: metas.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy($usuario_id, $_GET['id']);
    header("Location: metas.php");
    exit;
}

$metas = $controller->index($usuario_id);

require_once __DIR__ . '/../views/metas/index.php';
