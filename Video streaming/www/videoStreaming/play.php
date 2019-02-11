<?php
    require("./../../seguridad/videoStreaming/src/classes/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Funciones.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Usuario.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Video.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Cripto.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Pantalla.class.php");



    /*
     *  Comprobar que SI hay una sesión iniciada
     */
    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    if (!$funciones -> validarSesion()) {
        header("Location: ./login.php");
        exit;
    }



    /*
     *  Obtener el DNI del usuario
     */
    $dni = $_SESSION["usuario"] -> dni;



    /*
     *  Obtener el código del vídeo
     */
    if (isset($_POST["verPelicula"])) {
        $codigoVideo = $_POST["verPelicula"];
    }
    else {
        header("Location: ./pelicula.php");
        exit;
    }



    /*
     *  Obtener el número de veces que se ha visto ya el vídeo por el usuario
     */
    $videosBD = new VideosBD();
    $canal = $videosBD -> crearCanal();
    $consulta = $canal -> prepare("SELECT numero FROM visionado WHERE dni = ? AND codigo_video = ?");
    $consulta -> bind_param("ss", $dni, $codigo_video);
    $consulta -> execute();
    $consulta -> bind_result($numero);
    $consulta -> fetch();
    $consulta -> close();



    /*
     *  Marcar el vídeo como visto si no lo está ya
     */
    $
    $consulta = $canal -> prepare("INSERT INTO visionado (numero, dni, codigo_video, fecha, sinopsis) VALUES (?, ?, ?, CURRENT_TIMESTAMP, NULL)");
    $consulta -> bind_param("sss", $numero, $dni, $codigo_video);
    $consulta -> execute();
    $consulta -> fetch();
    $consulta -> close();
    


    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array();
    $pantalla = new Pantalla("./../../pantallas/videoStreaming"); 
    $pantalla -> mostrarPantalla("play.tpl", $parametros);
?>
