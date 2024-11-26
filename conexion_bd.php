<?php
$host = "localhost";
$dbname = "b22330051920262";
$username = "22330051920262";
$password = "BAGL070927HVZCRSA3";

$conexion = mysqli_connect($host, $username, $password, $dbname);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>