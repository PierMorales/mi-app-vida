<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="login-body">

<div class="login-container">

    <h2>Login</h2>

    <form action="procesar_login.php" method="POST">

        <input type="email" name="email" placeholder="Correo electrónico" required>

        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit" class="login-btn">
            Iniciar Sesión
        </button>

    </form>

    <a href="register.php" class="login-link">
        ¿No tienes cuenta? Regístrate
    </a>

</div>

</body>
</html>
