<?php
    class Funciones {
        
        function iniciarSesion() {
            session_cache_limiter("nocache");
            session_start();
        }

        
        function validarSesion() {
            if (isset($_SESSION["validado"]) && $_SESSION["validado"] == true) {
                return true;
            }
            return false;         
        }
        
        
        function getNombre() {
            if (!isset($_SESSION["dni"])) {
                die("ERROR DE SERVIDOR: No se ha podido recibir el dni de usuario.");
            }
            $dni = $_SESSION["dni"];
            $videosBD = new VideosBD();
            $canal = $videosBD -> crearCanal();
            $consulta = $canal -> prepare("SELECT nombre FROM usuarios WHERE dni = ?");
            $consulta -> bind_param("s", $dni);
            $consulta -> execute();
            $consulta -> bind_result($nombre); 
            $consulta -> fetch();
            $canal -> close();        
            return $nombre;
        }
        
        
        function getPerfiles() {
            if (!isset($_SESSION["dni"])) {
                die("ERROR DE SERVIDOR: No se ha podido recibir el dni de usuario.");
            }
            $dni = $_SESSION["dni"];
            $videosBD = new VideosBD();
            $canal = $videosBD -> crearCanal();
            $consulta = $canal -> prepare("SELECT codigo_perfil FROM perfil_usuario WHERE dni = ?");
            $consulta -> bind_param("s", $dni);
            $consulta -> execute();
            $consulta -> bind_result($codigo);
            $codigos = array();
            while ($consulta -> fetch()) {    
                array_push($codigos, $codigo);
            }       
            $consulta = $canal -> prepare("SELECT descripcion FROM perfil WHERE codigo = ?");
            $perfiles = array();
            for ($i=0; $i<count($codigos); $i++) {
                $consulta -> bind_param("s", $codigos[$i]);
                $consulta -> execute();
                $consulta -> bind_result($descripcion);
                $consulta -> fetch();
                array_push($perfiles, $descripcion);
            }
            $canal -> close();        
            return $perfiles;
        }   
    }
?>
