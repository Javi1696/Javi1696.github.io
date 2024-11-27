<!DOCTYPE html>
<html lang="es-MX">
<head>
    <title>Registro - K-popWave</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <h1>K-popWave</h1>
    </header>
    
    <div class="form-container">
        <form action="agregar.php" method="POST">
            <h2>Registro</h2>

            <?php
            if (isset($_GET['mensaje'])) {
                echo "<p class='mensaje'>" . htmlspecialchars($_GET['mensaje']) . "</p>";
            }
            ?>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Tu apellido">

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" placeholder="tucorreo@ejemplo.com">

            <label for="contra">Contraseña:</label>
            <input type="password" id="contra" name="contra">

            <input type="submit" name="registro" value="Registrarme">

            <p class="login-link"><a href="index.php">¿Ya tienes cuenta? Inicia sesión aquí</a></p>
        </form>
    </div>
</body>
</html>