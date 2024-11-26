<?php
if (!empty($_POST["iniciar_sesion"])) {
    if (empty($_POST["correo"]) || empty($_POST["contra"])) {
        $error_message = "Los campos están vacíos";
    } else {
        include 'conexion_bd.php';
        $correo = $_POST["correo"];
        $contra = $_POST["contra"];
        
        $query = "SELECT nombre, apellido FROM musica WHERE correo = ? AND contrasena = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ss", $correo, $contra);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION["nombre"] = $user["nombre"];
            $_SESSION["apellido"] = $user["apellido"];
            header("Location: musica.php");
            exit();
        } else {
            $error_message = "Correo o contraseña incorrectos";
        }

        $stmt->close();
        $conexion->close();
    }
}
?>