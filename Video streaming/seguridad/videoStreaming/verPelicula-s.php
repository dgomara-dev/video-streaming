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
     *  Desencriptar la ruta
     */
    if (isset($_POST["nombreCifrado"])) {
        $nombreCifrado = $_POST["nombreCifrado"];
    }
    else {
        header("Location: ./pelicula.php");
        exit;
    }

    $cripto = new Cripto();
    $nombreArchivo = $cripto -> desencriptar($_SESSION["ID"], $nombreCifrado);
    die($nombreArchivo);



    /*
     *  Iniciar el streaming
     */
    $stream = new VideoStream("./../../../seguridad/videoStreaming/videos/".$nombreArchivo);
    $stream -> start();
?>
