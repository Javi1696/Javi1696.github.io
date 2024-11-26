<?php
$id = $_GET['id'];
include('conexion_bd.php');

$sql = "DELETE FROM musica where id= '" . $id . "'";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "<script language='JavaScript'>
                alert('Datos eliminados correctamente');
                location.assign('gestion_usuarios.php');
              </script>";
} else {
    echo "<script language='JavaScript'>
                alert('Hubo un problema al eliminar los datos');
                location.assign('gestion_usuarios.php');
              </script>";
}
