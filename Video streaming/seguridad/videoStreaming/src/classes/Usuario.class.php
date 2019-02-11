<?php
    class Usuario {
        private $dni;
        private $nombre;
        private $codigosPerfil;
    
        function __construct($dni, $nombre, $codigosPerfil) {
            $this -> dni = $dni;
            $this -> nombre = $nombre;
            $this -> codigosPerfil = $codigosPerfil;
        }
    
        function __get($atributo) {
            if (!isset($this -> $atributo)) {
                return null;    
            }
            return $this -> $atributo;
        } 
    }
?>
