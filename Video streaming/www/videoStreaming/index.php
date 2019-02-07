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

    $nombreUsuario = $funciones -> getNombreUsuario();

    $codigosPerfil = $funciones -> getCodigosPerfil();

    $descripcionesPerfil = array();
    foreach($codigosPerfil as $codigo) {
        $descripcion = $funciones -> getDescripcion($codigo);
        array_push($descripcionesPerfil, $descripcion);
    }
    
    $perfilActual = $_SESSION["perfil"];
    $rutasCarteles = array();
    if ($perfilActual == "todos") {
        foreach($codigosPerfil as $codigo) {
            $carteles = $funciones -> getCarteles($codigo);   
            foreach($carteles as $cartel) {
                $ruta = "./img/carteles/".$cartel;
                array_push($rutasCarteles, $ruta);
            }
        }   
    }
    else {
        $carteles = $funciones -> getCarteles($perfilActual);
        foreach($carteles as $cartel) {
            $ruta = "./img/carteles/".$cartel;
            array_push($rutasCarteles, $ruta);        
        }        
    }

    $parametros = array("nombreUsuario" => $nombreUsuario, "descripcionesPerfil" => $descripcionesPerfil, "rutasCarteles" => $rutasCarteles);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
