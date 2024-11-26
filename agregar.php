<?php
include "conexion_bd.php";

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contra = $_POST['contra'];

$sql = "INSERT INTO musica (nombre, apellido, correo, contrasena) VALUES ('$nombre', '$apellido', '$correo', '$contra')";

if (mysqli_query($conexion, $sql)) {
    header("Location: registro.php?mensaje=Registro exitoso!");
} else {
    header("Location: registro.php?mensaje=Error en el registro!");
}

mysqli_close($conexion);
?>