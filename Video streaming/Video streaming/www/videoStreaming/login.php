<?php
    require("./../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/Funciones.class.php");
    require("./src/Pantalla.class.php");

    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    $usuario = "";    
    if ($funciones -> validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }
    
    $mensaje = "";
    if (isset($_GET["mensaje"])) {
        $mensaje = trim(strip_tags($_GET["mensaje"]));
    }
    
    $parametros = array("mensaje" => $mensaje);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming"); 
    $pantalla -> mostrarPantalla("login.tpl", $parametros);
?>
