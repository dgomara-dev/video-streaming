<?php
    require_once("./../../seguridad/videoStreaming/index-s.php");

    require_once("./src/Pantalla.class.php");
    require_once("./src/Video.class.php");
    require_once("./src/AccesoVideos.class.php");
    
    $mensaje = "";
    if (isset($_GET["mensaje"])) {
        $mensaje = trim(strip_tags($_GET["mensaje"]));
    }
    
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $parametros = array("mensaje" => $mensaje);
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
