<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro - Mi Vida</title>
<link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="login-body">

<div class="login-container">

    <h2>Registro</h2>

    <form action="procesar_registro.php" method="POST">

        <input type="text" name="nombre" placeholder="Tu Nombre" required>

        <input type="email" name="email" placeholder="Correo electrónico" required>

        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit" class="login-btn">
            Registrarse
        </button>

    </form>

    <a href="login.php" class="login-link">
        ¿Ya tienes cuenta? Inicia Sesión
    </a>

</div>

</body>
</html>
