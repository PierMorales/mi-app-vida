<?php
require 'config/database.php';
$stmt = $db->query("SELECT id, nombre, email, password FROM usuarios LIMIT 5");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($usuarios)) {
    echo "NO HAY USUARIOS REGSITRADOS.\n";
} else {
    foreach ($usuarios as $u) {
        echo "Nombre: {$u['nombre']} | Email: {$u['email']} | PassHash: {$u['password']}\n";
    }
}
?>
