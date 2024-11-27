<?php
$host = "sql310.infinityfree.com";
$dbname = "if0_37797674_kpopwave";
$username = "if0_37797674";
$password = "pP0YUZK9D0YlN7v";

$conexion = mysqli_connect($host, $username, $password, $dbname);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>