<?php
    require_once("./../../../seguridad/videoStreaming/sesionCerrar-s.php");
    header("Location: ./../login.php?mensaje=".urlencode("Se ha cerrado la sesión."));
?>