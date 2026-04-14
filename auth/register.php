<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>

    <form action="procesar_registro.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Registrarse</button>
    </form>

    <a href="login.php">Ya tengo cuenta</a>
</body>
</html>
