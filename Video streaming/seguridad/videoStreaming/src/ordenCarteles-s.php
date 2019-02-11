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
     *  Cambiar el orden por temas
     */
    if (isset($_POST["ordenarTematica"])) {
        $_SESSION["orden"] = "TEMAS";
    }
    else if (isset($_POST["ordenarAlfabetico"])) {
        $_SESSION["orden"] = "ABC";
    }   
?>
