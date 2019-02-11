<?php
    require("./../../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../../seguridad/videoStreaming/VideoStream.class.php");
    require("./../../../seguridad/videoStreaming/Cripto.class.php");


    
    /*
     *  Comprobar que hay una sesión iniciada
     */
    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    $usuario = "";
    if (!$funciones -> validarSesion($usuario)) {
        header("Location: ./login.php");
        exit;
    }
    


    /*
     *  Desencriptar el nombre del archivo
     */
    if (isset($_POST["descargar"])) {
        $nombreCifrado = $_POST["descargar"];
    }
    else {
        header("Location: ./pelicula.php");
        exit;
    }

    $cripto = new Cripto();
    $nombreArchivo = $cripto -> desencriptar($_SESSION["ID"], $nombreCifrado);



    /*
     *  Iniciar el streaming
     */
    $stream = new VideoStream("./../../../seguridad/videoStreaming/videos/".$nombreArchivo);
    $stream -> start();
?>