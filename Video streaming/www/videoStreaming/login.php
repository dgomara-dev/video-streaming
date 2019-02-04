<?php
    require_once("./../../seguridad/videoStreaming/login-s.php");
    require_once("./src/Pantalla.class.php");
    
    $mensaje = "";
    if (isset($_GET["mensaje"])) {
        $mensaje = trim(strip_tags($_GET["mensaje"]));
    }
    
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $parametros = array("mensaje" => $mensaje);
    $pantalla -> mostrarPantalla("login.tpl", $parametros);
?>
