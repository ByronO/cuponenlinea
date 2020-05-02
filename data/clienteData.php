<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cliente.php';
include 'domain/clientedatobancario.php';

class clienteData extends Conexion {
    
    public function insertar(cliente $cliente) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(clienteid) AS id FROM " . TBL_CLIENTE);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $correo = $cliente->getclientecorreo();
        $contra = $cliente->getclientecontrasenna();
       
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_CLIENTE ."(clienteid,clientecorreo,clientecontrasenna,clienteestado,clientefechainscripcion,clientefechadedesafiliacion) 
        VALUES('$id','$correo','$contra',1,NOW(),NOW());");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
   
}
?>

