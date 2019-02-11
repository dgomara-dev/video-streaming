<?php
    class Cripto {
       
        function encriptar($clave, $mensaje) {
            $identificador = mcrypt_module_open("cast-128", "", "ecb", "");     // Identificador con metodo de encriptado cast-128 y modo de cifrado ecb
            $longitud = mcrypt_enc_get_iv_size($identificador);                 // Longitud de un posible vector para cript/descrip
            $vector = mcrypt_create_iv ($longitud, MCRYPT_RAND);                // Crea el vector con valores aleatorios de soporte para la encriptación
            mcrypt_generic_init($identificador, $clave, $vector);               // Operaciones necesarias para llevar a cabo la encr/des
            $cifrado = mcrypt_generic($identificador, $mensaje);                // Realizar la encriptación
            mcrypt_generic_deinit($identificador);                              // Limpieza de memoria
            mcrypt_module_close($identificador);                                // Cierre de cifrado
            return base64_encode($cifrado);                                     // Necesario convertirlo a base64, puede haber caráteres extraños
        }
        
        function desencriptar($clave, $mensajeCifrado) {
            $texto = base64_decode($mensajeCifrado);
            $identificador = mcrypt_module_open("cast-128", "", "ecb", "");
            $longitud = mcrypt_enc_get_iv_size($identificador);
            $vector = mcrypt_create_iv ($longitud, MCRYPT_RAND);
            mcrypt_generic_init($identificador, $clave, $vector);
            $mensajeDescifrado = mdecrypt_generic($identificador, $texto);      // Realizar la desencriptación
            mcrypt_generic_deinit($identificador);
            mcrypt_module_close($identificador);
            return $mensajeDescifrado;
        }
   }
?>
