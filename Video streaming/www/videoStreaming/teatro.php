<?php
    require("./../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../seguridad/videoStreaming/Cripto.class.php");
    require("./src/Pantalla.class.php");



    /*
     *  Comprobar que hay una sesión iniciada
     */
    $funciones = new Funciones();
    $funciones -> iniciarSesion();
    if (!$funciones -> validarSesion()) {
        header("Location: ./login.php");
        exit;
    }

    

    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array();
    $pantalla = new Pantalla("./../../pantallas/videoStreaming"); 
    $pantalla -> mostrarPantalla("teatro.tpl", $parametros);
?>
