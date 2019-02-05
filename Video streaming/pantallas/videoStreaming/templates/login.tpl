<!DOCTYPE html>
<html lang="es">

<head>
    <title>Iniciar sesión - Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="./img/iconos/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <script src="./js/utilidades.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body onload="mostrarMensaje('{$mensaje}');">
    <header>
        <a href="./index.php">
            <a href="./login.php"><img src="./img/logo.png" alt="Nitflex" /></a>
        </a>
    </header>
    <section>
        <h3>Iniciar sesión</h3>
        <form method="post" action="./src/sesionValidar.php" autocomplete="off">
            <input type="text" placeholder="DNI" name="dni" maxlength="20" size="20" required="required" />
            <input type="password" placeholder="Contraseña" name="clave" maxlength="20" size="20" required="required" />
            <button type="submit">Iniciar sesión</button>
        </form>
    </section>
    <footer>
        <p>
            "Vídeo Streaming en PHP"<br />
            DAW 2 - Desarrollo Web en Entorno Servidor<br />
            I.E.S. Virgen del Espino (Soria)<br />
            Febrero 2019
        </p>
    </footer>
</body>

</html>
