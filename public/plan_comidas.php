<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/PlanComidaController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new PlanComidaController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: plan_comidas.php");
    exit;
}

if ($action === 'delete') {
    $controller->destroy($usuario_id, (int)($_GET['id'] ?? 0));
    header("Location: plan_comidas.php");
    exit;
}

$planes = $controller->index($usuario_id);

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../views/plan_comidas/index.php';
require_once __DIR__ . '/../layouts/footer.php';

