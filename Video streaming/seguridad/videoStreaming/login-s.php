<?php
    require_once("./../../seguridad/videoStreaming/funcionesSesiones.php");
    
    $usuario = "";
    iniciarSesion();  
    if (validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }
?>