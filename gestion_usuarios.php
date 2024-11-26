<!DOCTYPE html>
<html lang="es-MX">

<head>
    <title>Gestión de Usuarios</title>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        function confirmar() {
            return confirm('¿Estás seguro de proceder? Los datos se eliminarán permanentemente!');
        }
    </script>
</head>

<body>
    <?php
    include('conexion_bd.php');
    $sql = "SELECT * FROM musica";
    $resultado = mysqli_query($conexion, $sql);
    ?>

    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Gestión de Usuarios</h1>
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                    <tr>
                        <td><?php echo $filas['id']; ?></td>
                        <td><?php echo $filas['nombre']; ?></td>
                        <td><?php echo $filas['apellido']; ?></td>
                        <td><?php echo $filas['correo']; ?></td>
                        <td><?php echo $filas['contrasena']; ?></td>
                        <td>
                            <a href='editar_usuarios.php?id=<?php echo $filas['id']; ?>' class="btn btn-sm btn-warning">Editar</a>
                            <a href='eliminar_usuarios.php?id=<?php echo $filas['id']; ?>' class="btn btn-sm btn-danger" onclick='return confirmar()'>Eliminar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    mysqli_close($conexion);
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>