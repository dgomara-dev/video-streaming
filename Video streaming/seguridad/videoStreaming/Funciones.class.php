<?php
    class Funciones {
        
        function iniciarSesion() {
            session_cache_limiter("nocache");
            session_start();
        }

        
        function validarSesion() {
            if (isset($_SESSION["usuario"])) {
                return true;
            }
            return false;         
        }   
    }
?>
