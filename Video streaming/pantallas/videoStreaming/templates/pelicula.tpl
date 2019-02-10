<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ver película - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./css/pelicula.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="./js/utilidades.js"></script>
</head>

<body>
    <header>
        <input type="image" src="./img/iconos/menu.png" onclick="toggleAside()" class="slide-toggle" />
        <a href="./index.php"><img src="./img/logo.png" alt="Nitflex" /></a>
        <div id="sesion">
            <span>{$nombreUsuario}</span>
            <form action="./src/sesionCerrar.php">
                <button type="submit">CERRAR SESIÓN</button>
            </form>
        </div>
    </header>
    <aside>
        <ul>
            <form method="post" action="./teatro.php">    
                <button type="submit" name="verPelicula" value={$nombreCifrado}><img src="./img/iconos/play.png" height="18" />Ver película</button>
            </form>
            <form method="post" action="./src/descargar.php">
                <button type="submit" name="descargar" value={$nombreCifrado}><img src="./img/iconos/descargar.png" height="18" />Descargar</button>
            </form>
        </ul>
    </aside>
    <section>
        {$ruta = $videoActual -> ruta}
        {$titulo = $videoActual -> titulo}
        {$sinopsis = $videoActual -> sinopsis}
        <img src={$ruta} alt={$titulo} height="300" />
        <h1>{$titulo}</h1>
        <h3>{$lineaDescripciones}</h3>
        <p>{$sinopsis}</p>
        <a href="./index.php">Volver</a>
    </section>
</body>

</html>
