<?php
    require("./../../../seguridad/videoStreaming/src/sesionCerrar-s.php");
    header("Location: ./../login.php?mensaje=".urlencode("Se ha cerrado la sesión."));
?>
