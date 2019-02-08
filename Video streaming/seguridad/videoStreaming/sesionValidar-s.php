<?php
    require("./../../../seguridad/videoStreaming/VideosBD.class.php");
    require("./../../../seguridad/videoStreaming/Funciones.class.php");
    require("./../../../seguridad/videoStreaming/Usuario.class.php");


    // Llamada a iniciarSesion()
    $funciones = new Funciones();
    $funciones -> iniciarSesion();


    // Comprobar que no haya una sesión ya activa, en tal caso nos echa del script
    $usuario = "";
    if ($funciones -> validarSesion($usuario)) {
        header("Location: ./index.php");
        exit;
    }


    /*
     * Comprobar que las credenciales del formulario son correctas
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
     * Crear el objeto Usuario y guardar variables de sesión
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

    $canal -> close();
    
    $_SESSION["usuario"] = new Usuario($dni, $nombre, $codigosPerfil);
    $_SESSION["perfilActivo"] = "TODOS";
    $_SESSION["orden"] = "ABC";
?>
