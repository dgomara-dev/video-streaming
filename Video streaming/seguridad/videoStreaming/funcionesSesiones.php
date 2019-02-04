<?php
    function iniciarSesion() {
        session_name("SESION");
        session_cache_limiter("nocache, private");
        session_start();
        if (!isset($_SESSION["variable"])) {
            $_SESSION["variable"] = uniqid();
        }
    }

    function validarSesion(&$usuario) {
        $validado = false;
        if (isset($_SESSION["validado"]) && $_SESSION["validado"]) {
            $validado = true;
            $usuario = $_SESSION["usuario"];
        }
        return $validado;
    }
?>
