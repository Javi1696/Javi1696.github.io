<?php
include('conexion_bd.php');
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <title>Editar Usuario</title>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php
        if (isset($_POST['enviar'])) {

            $id = $_POST['id'];
            $nombre = $_POST['nombres'];
            $apellido = $_POST['apellidos'];
            $correo = $_POST['email'];
            $contrasena = $_POST['contra'];

            $sql = "UPDATE musica SET nombre='" . $nombre . "', apellido='" . $apellido . "', correo='" . $correo . "', contrasena='" . $contrasena . "' WHERE id='" . $id . "'";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "<script language='JavaScript'>
                alert('Datos actualizados correctamente');
                location.assign('gestion_usuarios.php');
              </script>";
            } else {
                echo "<script language='JavaScript'>
                alert('Hubo un error al actualizar los datos');
                location.assign('gestion_usuarios.php');
              </script>";
            }
            mysqli_close($conexion);
        } else {
            $id = $_GET['id'];
            $sql = "SELECT * FROM musica WHERE id='" . $id . "'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);
            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];
            $correo = $fila["correo"];
            $contrasena = $fila["contrasena"];

            mysqli_close($conexion);
        ?>
            <h1 class="text-center text-primary mb-4">Editar Usuario</h1>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="border p-4 rounded shadow-sm">
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombre:</label>
                    <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $nombre ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellido:</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $apellido ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $correo ?>" required>
                </div>
                <div class="mb-3">
                    <label for="contra" class="form-label">Contraseña:</label>
                    <input type="password" id="contra" name="contra" class="form-control" value="<?php echo $contrasena ?>" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="d-flex justify-content-between">
                    <button type="submit" name="enviar" class="btn btn-primary">Actualizar</button>
                    <a href="gestion_usuarios.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        <?php
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>