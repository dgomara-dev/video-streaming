<?php
    class Funciones {
        
        function iniciarSesion() {
            //session_cache_limiter("nocache");
            session_cache_limiter("public"); //Caché pública, para que no expire la página pelicula.php
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
