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
     *  Obtener los nombres (descripciones) de los perfiles
     */
    $codigosPerfil = $_SESSION["usuario"] -> codigosPerfil;

    $videosBD = new VideosBD();
    $canal = $videosBD -> crearCanal();
    $consulta = $canal -> prepare("SELECT descripcion FROM perfil WHERE codigo = ?");

    $descripcionesPerfil = array();
    foreach($codigosPerfil as $codigo) {
        $consulta -> bind_param("s", $codigo);
        $consulta -> execute();
        $consulta -> bind_result($descripcion);
        $consulta -> fetch();
        array_push($descripcionesPerfil, $descripcion);
    }

    

    /*
     *  Obtener los títulos y las rutas de los carteles, según el orden y el perfil
     */
    if ($_SESSION["orden"] == "ABC") {
        $consulta1 = $canal -> prepare("SELECT titulo FROM videos WHERE codigo_perfil = ? ORDER BY titulo");
        $consulta2 = $canal -> prepare("SELECT cartel FROM videos WHERE codigo_perfil = ? ORDER BY titulo");
    }
    else if ($_SESSION["orden"] == "TEMA") {
        //todo
    }
    
    $titulosPeliculas = array();
    $cartelesPeliculas = array();
    if ($_SESSION["perfilActivo"] == "TODOS") {
        foreach($codigosPerfil as $codigo) {
            $consulta1 -> bind_param("s", $codigo);
            $consulta1 -> execute();
            $consulta1 -> bind_result($titulo);
            $consulta1 -> fetch();
            $consulta1 -> close();
            array_push($titulosPeliculas, $titulo);
            $consulta2 -> bind_param("s", $codigo);
            $consulta2 -> execute();
            $consulta2 -> bind_result($cartel);
            $consulta2 -> fetch();
            $consulta2 -> close();
            $cartel = "./img/carteles/".$cartel;
            array_push($cartelesPeliculas, $cartel);
        }            
    }
    /*else {
        $carteles = $funciones -> getCarteles($perfilActual);
        foreach($carteles as $cartel) {
            $ruta = "./img/carteles/".$cartel;
            array_push($rutasCarteles, $ruta);        
        } 
    }*/



    /*
     *  Cierre del canal
     */
    $canal -> close();



    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array("nombreUsuario" => $nombreUsuario,
                        "descripcionesPerfil" => $descripcionesPerfil,
                        "titulosPeliculas" => $titulosPeliculas,
                        "cartelesPeliculas" => $cartelesPeliculas);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
