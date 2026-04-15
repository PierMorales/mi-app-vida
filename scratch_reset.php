<?php
require 'config/database.php';

$new_pass = 'administrador123';
$hash = password_hash($new_pass, PASSWORD_DEFAULT);

$stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE email = 'test@test.com'");
$stmt->execute([$hash]);

echo "CLAVE ACTUALIZADA: $new_pass\n";
?>
