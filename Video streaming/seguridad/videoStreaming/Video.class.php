<?php
    class Video {
        private $codigo;
        private $titulo;
        private $cartel;
        private $descargable;
        private $sinopsis;
        private $video;
        private $tematicas;
        private $ruta;
        
        function __construct($codigo, $titulo, $cartel, $descargable, $sinopsis, $video, $tematicas, $ruta) {
            $this -> codigo = $codigo;
            $this -> titulo = $titulo;
            $this -> cartel = $cartel;
            $this -> descargable = $descargable;
            $this -> sinopsis = $sinopsis;
            $this -> video = $video;
            $this -> tematica = $tematicas;
            $this -> ruta = $ruta;
        }
        
        function __get($atributo) {
            if (!isset($this -> $atributo)) {
                return null;    
            }
            return $this -> $atributo;
        }
        
        function __set($atributo, $valor) {
            $this -> $atributo = $valor;
        } 
    }
?>