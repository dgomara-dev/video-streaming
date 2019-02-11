<?php
    require("./../../../seguridad/videoStreaming/src/classes/Funciones.class.php");
    require("./../../../seguridad/videoStreaming/src/classes/Cripto.class.php");



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
     *  Desencriptar el nombre del archivo
     */
    if (isset($_POST["descargar"])) {
        $nombreCifrado = $_POST["descargar"];
    }
    else {
        header("Location: ./../pelicula.php");
        exit;
    }

    $cripto = new Cripto();
    $nombreArchivo = $cripto -> desencriptar($_SESSION["ID"], $nombreCifrado);



    /*
     *  Compresión y descarga
     */
    $zip = new ZipArchive();
    $zip -> open("descarga.zip", ZipArchive::CREATE);
	$zip -> addFile("./../../../seguridad/videoStreaming/videos".$nombreArchivo, $nombreArchivo);
    $zip -> close();

    header("Content-disposition: attachment; filename=descarga.zip");
    header("Content-type: application/zip");
    readfile($nombreArchivo);
?>
