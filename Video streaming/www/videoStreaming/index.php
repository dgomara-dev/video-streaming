<?php
    require_once("./../../seguridad/videoStreaming/index-s.php");
    require_once("./../../seguridad/videoStreaming/FuncionesPerfiles.class.php");
    require_once("./src/Pantalla.class.php");
    
    $mensaje = "";
    if (isset($_GET["mensaje"])) {
        $mensaje = trim(strip_tags($_GET["mensaje"]));
    }
    
    $funcionesPerfiles = new FuncionesPerfiles();
    $perfiles = $funcionesPerfiles -> getPerfiles();
    $linea = "";
    for ($i=0; $i<count($perfiles); $i++) {
        $linea = $linea."<li onclick='cambiarClaseActiva()'><img src='./img/iconos/perfil.png' alt='Perfil' height='18' />".$perfiles[$i]."</li>";
    }
    $parametros = array("mensaje" => $mensaje, "perfiles" => $linea);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
