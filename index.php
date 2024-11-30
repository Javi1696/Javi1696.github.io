<?php
session_start();
$error_message = ''; // Inicializa la variable para evitar errores
include('controlador.php');
include('conexion_bd.php');

// Verificar si el modal ya se mostró en la sesión actual
if (!isset($_SESSION['modal_shown'])) {
    $_SESSION['modal_shown'] = false;
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            text-align: center;
            position: relative;
        }

        .modal-content input[type="submit"] {
            margin-top: 10px;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>K-popWave</h1>
    </header>

    <!-- Modal -->
    <?php if ($_SESSION['modal_shown'] === false): ?>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <!-- Contenido de instrucciones.php -->
            <h2>Modo de uso</h2>
            <p>¡Bienvenido a K-popWave! A continuación te mostraremos una serie de pasos para que puedas disfrutar al máximo tus canciones favoritas:</p>
            <p>1. Inicia sesión en Spotify en tu navegador. Haz click <a href="https://open.spotify.com/intl-es">aquí</a></p>
            <p>2. Inicia sesión en K-popWave o si no tienes cuenta regístrate <a href="http://kpopwave.infinityfreeapp.com/registro.php">aquí</a></p>
            <p>3. Al iniciar sesión podrás disfrutar todas tus canciones favoritas.</p>
            <input type="submit" name="continuar" value="Aceptar" onclick="closeModal()">
        </div>
    </div>
    <?php $_SESSION['modal_shown'] = true; ?>
    <?php endif; ?>

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

    <script>
        // Mostrar el modal al cargar la página si está visible
        window.onload = function () {
            var modal = document.getElementById('modal');
            if (modal) {
                modal.style.display = 'block';
            }
        };

        // Cerrar el modal
        function closeModal() {
            var modal = document.getElementById('modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>