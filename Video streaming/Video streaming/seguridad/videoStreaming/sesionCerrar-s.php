<?php
    require("./../../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../../seguridad/videoStreaming/Funciones.class.php");

    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    $usuario = "";
    if (!$funciones -> validarSesion($usuario)) {
        header("Location: ./login.php");
        exit;
    }
    session_destroy();
    unset($_SESSION);
?>
