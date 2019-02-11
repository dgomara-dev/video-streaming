<?php
    class VideosBD {
        const IP = "localhost";
        const USUARIO = "videos";
        const CLAVE = "videos";
        const BD = "videos";
        
        function crearCanal() {
            $canal = new mysqli(VideosBD::IP, VideosBD::USUARIO, VideosBD::CLAVE, VideosBD::BD);
            if ($canal -> connect_errno) {
                die("ERROR: No se ha podido establecer conexión con la base de datos.");
            }
            $canal -> set_charset("utf8");
            return $canal;
        }   
    } 
?>
