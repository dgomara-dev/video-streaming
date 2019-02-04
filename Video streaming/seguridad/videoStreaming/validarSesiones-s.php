<?php
    require_once("./../../../seguridad/videoStreaming/VideosBD.class.php");
    require_once("./../../../seguridad/videoStreaming/funcionesSesiones.php");

    $usuario = "";
    if (!isset($_POST["usuario"])) {
        die("ERROR DE SERVIDOR: No se ha podido recibir el nombre de usuario.");
    }
    $usuario = strip_tags(trim($_POST["usuario"]));

    $clave = "";
    if (!isset($_POST["clave"])) {
        die("ERROR DE SERVIDOR: No se ha podido recibir la contraseña.");
    }
    $clave = strip_tags(trim($_POST["clave"]));

    if (empty($usuario) || strlen($usuario)>20 || empty($clave) || strlen($clave)>20) {
        header("Location: ./../login.php?mensaje=".urlencode("El usuario no existe o la contraseña no es válida."));
        exit;
    }
    
    /* ? ? ? */
    // $canal = crearCanal();
    $canal = new mysqli(VideosBD::IP, VideosBD::USUARIO, VideosBD::CLAVE, VideosBD::BD);
    if ($canal -> connect_errno) {
        die("ERROR DE SERVIDOR: No se ha podido establecer conexión con la base de datos.");
    }
    $canal -> set_charset("utf8");
    /* ? ? ? */

    $consulta = $canal -> prepare("SELECT clave FROM usuarios WHERE dni = ?");
    $consulta -> bind_param("s", $usuario);
    $consulta -> execute();
    $consulta -> bind_result($clave_);
    $consulta -> fetch();
    $canal -> close();
    
    if (!password_verify($clave, $clave_)) {
        header("Location: ./../login.php?mensaje=".urlencode("El usuario no existe o la contraseña no es válida."));
        exit;
    }

    inicioSesion();
    $_SESSION["validado"] = true;
    $_SESSION["usuario"] = $usuario;
?>
