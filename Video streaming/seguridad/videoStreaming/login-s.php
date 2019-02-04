<?php
    require_once("./../../seguridad/videoStreaming/FuncionesSesiones.class.php");
    
    $funcionesSesiones = new FuncionesSesiones();
    $funcionesSesiones -> iniciarSesion();
    $usuario = "";    
    if ($funcionesSesiones -> validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }
?>
