<?php
    require("./../../smarty/libs/Smarty.class.php");

    class Pantalla extends Smarty {
        
        function __construct($path) {
            date_default_timezone_set("europe/madrid");
            parent::__construct();
            $this -> template_dir = $path."/templates/";
            $this -> compile_dir = $path."/templates_c/";
            $this -> config_dir = $path."/configs/";
            $this -> cache_dir = $path."/cache/";
        }

        function mostrarPantalla($nombrePantalla, $parametros) {
            foreach ($parametros as $variable => $valor) {
                $this -> assign($variable, $valor);
            }
            $this -> display($nombrePantalla);
        }
    }
?>
