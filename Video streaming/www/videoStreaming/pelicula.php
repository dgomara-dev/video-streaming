<?php
    require("./../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../seguridad/videoStreaming/Usuario.class.php");
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
     *  Obtener el nombre del usuario
     */
    $nombreUsuario = $_SESSION["usuario"] -> nombre;
    



    


    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array("nombreUsuario" => $nombreUsuario);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming"); 
    $pantalla -> mostrarPantalla("pelicula.tpl", $parametros);
?>
