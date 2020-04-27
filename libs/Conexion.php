<?php
include_once("libs/Constantes.php");
class Conexion {

    public $servidor;
    public $usuario;
    public $contrasena;
    public $db;
    public $conexion;
    public $activo;

    /* constructor */

    public function __construct() {
        /*$hostName = gethostname();*/
        $nombreHost = 'local';
        
        switch ($nombreHost) {
            case "local": //local PC
                $this->activo = true;
                $this->servidor = SERVIDOR_BD;
                $this->usuario = USUARIO_BD;
                $this->contrasena = CONTRASENA_BD;
                $this->db = NOMBRE_BD;
                break;

            default: 
                 $this->activo = false;
      			 $this->servidor = "x.x.x.x";
      			 $this->usuario = "xxxxxxx";
      			 $this->contrasena = "xxxxxxx";
      			 $this->db = "xxxxxxxxxx"; 
                break;
        }
    }

}
?>
