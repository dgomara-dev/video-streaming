<?php
    require("./../../../seguridad/videoStreaming/src/classes/Funciones.class.php");


    
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
     *  Destruir toda la información de la sesión
     */
    session_unset();
    session_destroy();
    unset($_SESSION);
?>
