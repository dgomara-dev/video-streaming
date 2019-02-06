<?php
    require("./../../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../../seguridad/videoStreaming/Funciones.class.php");

    $funciones = new Funciones();
    $funciones -> iniciarSesion();

    $usuario = "";
    if ($funciones -> validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }

    $dni = "";
    if (!isset($_POST["dni"])) {
        die("ERROR DE SERVIDOR: No se ha podido recibir el DNI del usuario.");
    }
    $dni = strip_tags(trim($_POST["dni"]));

    $clave = "";
    if (!isset($_POST["clave"])) {
        die("ERROR DE SERVIDOR: No se ha podido recibir la contraseña.");
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
    $canal -> close();
    
    if (!password_verify($clave, $clave_)) {
        header("Location: ./../login.php?mensaje=".urlencode("El usuario no existe o la contraseña no es válida."));
        exit;
    }

    $_SESSION["validado"] = true;
    $_SESSION["dni"] = $dni;

    $perfiles = $funciones -> getPerfiles();
    $_SESSION["perfil"] = $perfiles[0];
?>
