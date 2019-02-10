<?php
    require("./../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../seguridad/videoStreaming/Usuario.class.php");    
    require("./../../seguridad/videoStreaming/Video.class.php");
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
     *  Obtener el nombre del usuario
     */
    $nombreUsuario = $_SESSION["usuario"] -> nombre;


    
    /*
     *  Obtener el vídeo del cartel clickado
     */
    if (isset($_POST["codigo"])) {
        $codigoActual = $_POST["codigo"];
    }
    else {
        header("Location: ./index.php");
        exit;
    }

    $videos = $_SESSION["videos"];
    foreach($videos as $video) {
        if($video -> codigo == $codigoActual) {
            $videoActual = $video;
            break;
        }
    }

    if ($videoActual == null) {
        header("Location: ./index.php");
        exit;
    }



    /*
     *  Obtener la descripción de las temáticas
     */
    $videosBD = new VideosBD();
    $canal = $videosBD -> crearCanal();
    $consulta = $canal -> prepare("SELECT descripcion FROM tematica WHERE codigo = ?");

    $tematicas = $videoActual -> tematicas;
    $arrayDescripciones = array();
    foreach($tematicas as $codigo) {
        $consulta -> bind_param("s", $codigo);
        $consulta -> execute();
        $consulta -> bind_result($descripcion);
        $consulta -> fetch();
        array_push($arrayDescripciones, $descripcion);
    }

    $lineaDescripciones = "";
    for ($i = 0; $i < count($arrayDescripciones); $i++) {
        if ($i != count($arrayDescripciones) - 1) {
            $lineaDescripciones .= $arrayDescripciones[$i].",&nbsp;&nbsp;";  
        }
        else {
            $lineaDescripciones .= $arrayDescripciones[$i];
        }     
    }

    if ($lineaDescripciones == "") {
        $lineaDescripciones = "Sin categoría";
    }



    /*
     *  Obtener el nombre de archivo del vídeo y realizar encriptación
     */
    $nombreArchivo = $videoActual -> video;

    $cripto = new Cripto();
    $nombreCifrado = $cripto -> encriptar($_SESSION["ID"], $nombreArchivo);

    

    /*
     *  Vincular parámetros y llamar a la pantalla
     */
    $parametros = array("nombreUsuario" => $nombreUsuario,
                        "videoActual" => $videoActual,
                        "lineaDescripciones" => $lineaDescripciones,
                        "nombreCifrado" => $nombreCifrado);
    $pantalla = new Pantalla("./../../pantallas/videoStreaming"); 
    $pantalla -> mostrarPantalla("pelicula.tpl", $parametros);
?>
