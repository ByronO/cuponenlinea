<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/usuario.php';
include 'domain/empresa.php';

class usuarioData extends Conexion {
    

    public function verificar(usuario $usuario1) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $nombre = $usuario1->getusuarionombre();
        $contra = $usuario1->getusuariocontrasenna();
        
        $consulta = $mysql->prepare("SELECT usuarioid FROM " . TBL_USUARIO . " WHERE usuariocorreo='$nombre' and usuariocontrasenna='$contra';");

        $consulta->execute();
        
        $resultado = $consulta->get_result();

        $consulta->close();
   
        $id = [];
        $fila = $resultado->fetch_array();
        array_push($id, $fila['usuarioid']);
      return $id;
         
    } // insertar
    

    public function obtenerTodos() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empresaid,empresacodigo,empresanombre,empresaubicacion,empresacategoria FROM " . TBL_EMPRESA . " WHERE empresaestado=1;");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $empresas = [];
        while ($fila = $resultado->fetch_array()) {
            $empresa = new empresa($fila['empresaid'], $fila['empresacodigo'], $fila['empresanombre'],  $fila['empresaubicacion'],1, $fila['empresacategoria']);

            array_push($empresas, $empresa);
        }
      return $empresas;
         
    } // obtenerTodos
    
    
    
}
?>


