<?php
    require_once("./../../../seguridad/videoStreaming/VideosBD.class.php");

    if (!isset($_SESSION["dni"])) {
        die("ERROR DE SERVIDOR: No se ha podido recibir el dni de usuario.");
    }
    $dni = $_SESSION["dni"];

    $videosBD = new VideosBD();
    $canal = $videosBD -> crearCanal();

    $consulta = $canal -> prepare("SELECT codigo_perfil FROM perfil_usuario WHERE dni = ?");
    $consulta -> bind_param("s", $dni);
    $consulta -> execute();
    $consulta -> bind_result($codigo_perfil);
    $perfiles = array();
    while ($consulta -> fetch()) {       
        array_push($perfiles, codigo_perfil);
    }
    $canal -> close();

    for ($i=0; $i<$perfiles.length; i++) {
        print($perfiles[i]);
    }




    

?>
