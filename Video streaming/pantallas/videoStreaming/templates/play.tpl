<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reproducir - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./css/play.css" />
</head>

<body>
    <video width="800" height="450" controls="controls" preload="auto">
        <source src="http://localhost/videoStreaming/seguridad/verPelicula-s.php" />
        Parece que el navegador no soporta esta reproducción.
    </video>
    <a href="./index.php">Volver</a>
    <form action="./src/sesionCerrar.php">
        <button type="submit">CERRAR SESIÓN</button>
    </form>
</body>

</html>
