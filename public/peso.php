<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/PesoController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new PesoController($db);

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($usuario_id, $_POST);
    header("Location: peso.php");
    exit;
}

$pesos = $controller->index($usuario_id);

require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../views/gym/peso/index.php';
require_once __DIR__ . '/../layouts/footer.php';

