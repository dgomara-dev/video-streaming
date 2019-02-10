<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reproducir - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./css/teatro.css" />
</head>

<body>
    <video width="320" height="240" controls="controls" preload="auto">
        <source src="http://localhost/videoStreaming/seguridad/verPelicula-s.php" />
        Your browser does not support the video tag.
    </video>
    <br /><br />
    <a href="./index.php">Volver</a><br /><br />
    <form action="./src/sesionCerrar.php">
        <button type="submit">CERRAR SESIÓN</button>
    </form>
</body>

</html>
