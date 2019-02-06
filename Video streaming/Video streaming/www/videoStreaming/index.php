<?php
    require("./../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/Funciones.class.php");
    require("./src/Pantalla.class.php");
    
    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    $usuario = "";
    if (!$funciones -> validarSesion($usuario)) {
        header("Location: ./login.php");
        exit;
    }

    $nombre = $funciones -> getNombre();   
    $perfiles = $funciones -> getPerfiles();
    
    $parametros = array("nombre" => $nombre, "perfiles" => $perfiles);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
