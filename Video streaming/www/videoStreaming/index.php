<?php
    require("./../../seguridad/videoStreaming/src/classes/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Funciones.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Usuario.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Video.class.php");
    require("./../../seguridad/videoStreaming/src/classes/Pantalla.class.php");
    


    /*
     *  Comprobar que SI hay una sesión iniciada
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
    $consulta -> close();

    

    /*
     *  Ordenar los vídeos
     */
    $videos = $_SESSION["videos"];
    if ($_SESSION["orden"] == "ABC") {
        usort($videos, function($v1, $v2) {
            return strcmp($v1 -> titulo, $v2 -> titulo);  
        });
    }
    else {
        // Ordenar por temas   
    }
    


    /*
     *  Obtener los códigos de los vídeos vistos
     */
    $dni = $_SESSION["usuario"] -> dni;
    $consulta = $canal -> prepare("SELECT codigo_video FROM visionado WHERE dni = ?");
    $consulta -> bind_param("s", $dni);
    $consulta -> execute();
    $consulta -> bind_result($codigo_video);
    $videos_v = array();
    while ($consulta -> fetch()) {
        array_push($videos_v, $codigo_video);
    }
    $consulta -> close();



    /*
     *  Cierre del canal
     */
    $canal -> close();



    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array("nombreUsuario" => $nombreUsuario,
                        "descripcionesPerfil" => $descripcionesPerfil,
                        "videos" => $videos,
                        "videos_v" => $videos_v);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming");
    $pantalla -> mostrarPantalla("index.tpl", $parametros);
?>
