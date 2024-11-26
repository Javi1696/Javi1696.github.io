<?php
session_start();
$error_message = ''; // Inicializa la variable para evitar errores
include('controlador.php');
include('conexion_bd.php');
// Procesar inicio de sesión
if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];

    $query = "SELECT nombre, apellido FROM musica WHERE correo = ? AND contrasena = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ss", $correo, $contra);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['apellido'] = $user['apellido'];
    }
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <title>Iniciar Sesión - K-popWave</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>K-popWave</h1>
    </header>

    <div class="form-container">
        <form action="" method="POST">
            <h2>Iniciar Sesión</h2>

            <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" placeholder="tucorreo@ejemplo.com">

            <label for="contra">Contraseña:</label>
            <input type="password" id="contra" name="contra">

            <input name="iniciar_sesion" type="submit" value="Iniciar Sesión">

            <p class="signup-link"><a href="registro.php">¿Eres nuevo? ¡Regístrate aquí!</a></p>
        </form>
    </div>
</body>

</html>