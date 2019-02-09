<?php
    require("./../../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../../seguridad/videoStreaming/Usuario.class.php");
    require("./../../../seguridad/videoStreaming/Video.class.php");



    /*
     *  Comprobar que no haya una sesión ya activa, en tal caso nos echa del script
     */
    $funciones = new Funciones();
    $usuario = "";
    if ($funciones -> validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }



    /*
     *  Comprobar que las credenciales del formulario son correctas
     */
    $dni = "";
    if (!isset($_POST["dni"])) {
        die("ERROR DE FORMULARIO: No se ha podido recibir el DNI del usuario.");
    }
    $dni = strip_tags(trim($_POST["dni"]));

    $clave = "";
    if (!isset($_POST["clave"])) {
        die("ERROR DE FORMULARIO: No se ha podido recibir la contraseña.");
    }
    $clave = strip_tags(trim($_POST["clave"]));

    if (empty($dni) || strlen($dni)>9 || empty($clave) || strlen($clave)>20) {
        header("Location: ./../login.php?mensaje=".urlencode("El usuario no existe o la contraseña no es válida."));
        exit;
    }
    
    $videosBD = new VideosBD();
    $canal = $videosBD -> crearCanal();

    $consulta = $canal -> prepare("SELECT clave FROM usuarios WHERE dni = ?");
    $consulta -> bind_param("s", $dni);
    $consulta -> execute();
    $consulta -> bind_result($clave_);
    $consulta -> fetch();
    $consulta -> close();
    
    if (!password_verify($clave, $clave_)) {
        header("Location: ./../login.php?mensaje=".urlencode("El usuario no existe o la contraseña no es válida."));
        exit;
    }

    

    /*
     *  Crear el usuario
     */
    $consulta = $canal -> prepare("SELECT nombre FROM usuarios WHERE dni = ?");
    $consulta -> bind_param("s", $dni);
    $consulta -> execute();
    $consulta -> bind_result($nombre); 
    $consulta -> fetch();
    $consulta -> close();

    $consulta = $canal -> prepare("SELECT codigo_perfil FROM perfil_usuario WHERE dni = ?");
    $consulta -> bind_param("s", $dni);
    $consulta -> execute();
    $consulta -> bind_result($codigo);
    $codigosPerfil = array();
    while ($consulta -> fetch()) {    
        array_push($codigosPerfil, $codigo);
    }
    $consulta -> close();

    $usuario = new Usuario($dni, $nombre, $codigosPerfil);



    /*
     *  Crear los vídeos
     */
    $consulta1 = $canal -> prepare("SELECT codigo, titulo, cartel, descargable, sinopsis, video FROM videos WHERE codigo_perfil = ?");
    $consulta2 = $canal -> prepare("SELECT codigo_tematica FROM asociado WHERE codigo_video = ?");
    $videos = array();
    foreach($codigosPerfil as $codigo) {
        $consulta1 -> bind_param("s", $codigo);
        $consulta1 -> execute();
        $consulta1 -> bind_result($codigo, $titulo, $cartel, $descargable, $sinopsis, $video);    
        while ($consulta1 -> fetch()) {
            $consulta2 -> bind_param("s", $codigo);
            $consulta2 -> execute();
            $consulta2 -> bind_result($codigo_tematica);
            $tematicas = array();
            while ($consulta2 -> fetch()) {
                array_push($tematicas, $codigo_tematica);
            }
            $ruta = "./img/carteles/".$cartel;
            array_push($videos, new Video($codigo, $titulo, $cartel, $descargable, $sinopsis, $video, $tematicas, $ruta));
        }
    }
    
    $consulta1 -> close();  
    $canal -> close();



    /*
     *  Guardamos los datos como variables de sesión
     */
    $funciones -> iniciarSesion();

    $_SESSION["usuario"] = $usuario;
    $_SESSION["videos"] = $videos;
    $_SESSION["perfilActivo"] = "TODOS";
    $_SESSION["orden"] = "ABC";
?>
