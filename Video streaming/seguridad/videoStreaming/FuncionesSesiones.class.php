<?php
    class FuncionesSesiones {
        
        function iniciarSesion() {
            session_name("SESION");
            session_cache_limiter("nocache, private");
            session_start();
            if (!isset($_SESSION["variable"])) {
                $_SESSION["variable"] = uniqid();
            }
        }

        function validarSesion(&$dni) {
            $validado = false;
            if (isset($_SESSION["validado"]) && $_SESSION["validado"]) {
                $validado = true;
                $dni = $_SESSION["dni"];
            }
            return $validado;
        }
    }  
?>
