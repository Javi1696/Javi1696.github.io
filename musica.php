<?php 
include "conexion_bd.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-popWave</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <header>
            K-popWave
        </header>

        <form method="POST">
        <nav class="menu">
            <p><a href="gestion_usuarios.php">Gestionar Usuarios</a></p>
        </nav>
            <input type="text" name="search" placeholder="Buscar canciones..." required>
            <button type="submit">Buscar</button>
        </form>

        <?php
        // Mostrar saludo si hay sesión iniciada
if (isset($_SESSION["nombre"]) && isset($_SESSION["apellido"])) {
    $nombre = htmlspecialchars($_SESSION["nombre"]);
    $apellido = htmlspecialchars($_SESSION["apellido"]);
    echo "<div id='saludo' style='background-color: #ff69b4; color: white; padding: 25px; margin: 50px; border-radius: 25px; color: #ffffff; font-weight: bold; '>Hola, $nombre $apellido</div>";
}
        ?>

        <div id="results">
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
                include "spotify_api.php";
                $search = $_POST["search"];

                $stmt = $conexion->prepare("INSERT INTO busquedas (termino) VALUES (?)");
                $stmt->bind_param("s", $search);
                if ($stmt->execute()) {
                    //echo "<p id='successMessage'>Búsqueda guardada exitosamente.</p>";
                    //echo "<script>hideMessage();</script>";
                } else {
                    echo "<p>Error al guardar la búsqueda.</p>";
                }

                $results = searchSpotifyTrack($search);
                if (isset($results["tracks"]["items"])) {
                    foreach ($results["tracks"]["items"] as $track) {
                        $track_url = $track["external_urls"]["spotify"];
                        $embed_url = "https://open.spotify.com/embed/track/" . $track["id"];

                        echo "<div class='track'>";
                        echo "<img src='" . $track["album"]["images"][0]["url"] . "' alt='Cover'>";
                        echo "<p>" . $track["name"] . " - " . $track["artists"][0]["name"] . "</p>";
                        echo "<iframe src='" . $embed_url . "' width='300' height='80' frameborder='0' allowtransparency='true' allow='encrypted-media'></iframe>";
                        echo "<p><a href='" . $track_url . "' target='_blank'>Reproducir en Spotify</a></p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No se encontraron resultados.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>