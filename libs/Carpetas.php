<?php

class Carpetas{
    
    public function __construct() {
       
    }
    
    public static function crear($ruta){
        $carpeta = rutaCarpetas . $ruta;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
    }
    
    public static function actualizar($antiguo, $nuevo){
        $carpeta = rutaCarpetas . $antiguo;
        $nuevaCarpeta = rutaCarpetas . $nuevo;
        if (file_exists($carpeta)) {
            rename($carpeta, $nuevaCarpeta);
        }
    }
    
}

?>
