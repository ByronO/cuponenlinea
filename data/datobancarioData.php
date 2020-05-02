<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cliente.php';
include 'domain/clientedatobancario.php';

class datobancarioData extends Conexion {

    
    public function insertardatobanco(clientedatobancario $cliente) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(clientedatobancarioid) AS id FROM " . TBL_DATOBANCO);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $banco = $cliente->getclientedatobancariobanco();
        $tarjeta = $cliente->getclientedatobancarionumerotarjeta();
        $estado = $cliente->getclientedatobancarioestado();
        $clienteid = $cliente->getclientedatobancarioclienteid();

        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_DATOBANCO ."(clientedatobancarioid,clientedatobancariobanco,clientedatobancarionumerotarjeta,clientedatobancarioestado,clientedatobancarioclienteid,clientedatobancariofechainscripcion)
        VALUES('$id','$banco','$tarjeta',1,'$clienteid',NOW());");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
   
    public function obtenerCuentasId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT clientedatobancarioid,clientedatobancariobanco,clientedatobancarionumerotarjeta,clientedatobancarioestado,clientedatobancarioclienteid,clientedatobancariofechainscripcion FROM  " . TBL_DATOBANCO . " WHERE clientedatobancarioclienteid=?");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
       $cuentacliente = [];
        while ($fila = $resultado->fetch_array()) {
        $clientedatobancariobanco = new clientedatobancario($fila['clientedatobancarioid'],$fila['clientedatobancariobanco'],$fila['clientedatobancarionumerotarjeta'],$fila['clientedatobancarioestado'],$fila['clientedatobancarioclienteid'],$fila['clientedatobancariofechainscripcion']);
        array_push($cuentacliente, $clientedatobancariobanco);
    }
  return $cuentacliente;

    } // obtenerOrdenId

    public function borrar($id) {
        require_once rutaData . 'datobancarioData.php';
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("delete from " . TBL_DATOBANCO . " where clientedatobancarioid=?");


        $consulta->bind_param("i", $id);
        
        $resultado = $consulta->execute();
        
        $consulta->close();
        
        return $resultado;
        
    } // borrar

}
?>

