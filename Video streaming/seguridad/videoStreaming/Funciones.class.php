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
        
        
        function cambiarPerfil($perfil) {
            //TODO
        }
        
        
        // Devuelve el nombre el usuario activo (ej. Andrés Izquierdo García)
        function getNombreUsuario() {
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
        
        
        // Devuelve un ARRAY con TODOS los codigo_perfil del usuario activo
        function getCodigosPerfil() {
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
            $canal -> close();        
            return $codigos;          
        }        
        
        
        // Devuelve un STRING con la descripción de UN codigo_perfil
        function getDescripcion($codigo_perfil) {
            $videosBD = new VideosBD();
            $canal = $videosBD -> crearCanal();
            $consulta = $canal -> prepare("SELECT descripcion FROM perfil WHERE codigo = ?");
            $consulta -> bind_param("s", $codigo_perfil);
            $consulta -> execute();
            $consulta -> bind_result($descripcion);
            $consulta -> fetch();
            $canal -> close();
            return $descripcion;
        }
        
        
        // Devuelve un ARRAY con los carteles de UN codigo_perfil
        function getCarteles($codigo_perfil) {
            $videosBD = new VideosBD();
            $canal = $videosBD -> crearCanal();
            $consulta = $canal -> prepare("SELECT cartel FROM videos WHERE codigo_perfil = ?");
            $consulta -> bind_param("s", $codigo_perfil);
            $consulta -> execute();
            $consulta -> bind_result($cartel);
            $carteles = array();
            while ($consulta -> fetch()) {    
                array_push($carteles, $cartel);
            }
            $canal -> close();        
            return $carteles;            
        }
    }
?>
