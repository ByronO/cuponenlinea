<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/clientecontacto.php';

class clientecontactoData extends Conexion {
    
    public function insertar(clientecontacto $clientecontacto) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(clientecontactoid) AS id FROM " . TBL_CLIENTECONTACTO);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $telefono1 = $clientecontacto->getclientecontactotelefono1();
        $telefono2 = $clientecontacto->getclientecontactotelefono2();
        $correo = $clientecontacto->getclientecontactocorreo();
        $fax = $clientecontacto->getclientecontactofax();
        $cliente= $clientecontacto->getclientecontactoclienteid();
       
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_CLIENTECONTACTO ."(clientecontactoid,clientecontactotelefono1,clientecontactotelefono2,clientecontactocorreo,clientecontactofax,clientecontactoclienteid,clientecontactoestado) 
        VALUES('$id','$telefono1',$telefono2,'$correo','$fax','$cliente',1);");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar

    public function obtenerContactoId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT clientecontactoid,clientecontactotelefono1,clientecontactotelefono2,clientecontactocorreo,clientecontactofax,clientecontactoclienteid,clientecontactoestado FROM  " . TBL_CLIENTECONTACTO . " WHERE clientecontactoclienteid=? and clientecontactoestado=1");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
       $cuentacliente = [];
        while ($fila = $resultado->fetch_array()) {
        $clientedatobancariobanco = new clientecontacto($fila['clientecontactoid'],$fila['clientecontactotelefono1'],$fila['clientecontactotelefono2'],$fila['clientecontactocorreo'],$fila['clientecontactofax'],$fila['clientecontactoclienteid'],$fila['clientecontactoestado']);
        array_push($cuentacliente, $clientedatobancariobanco);
    }
  return $cuentacliente;

    } // obtenerOrdenId

    public function obtenerActualizarContacto($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT clientecontactoid,clientecontactotelefono1,clientecontactotelefono2,clientecontactocorreo,clientecontactofax,clientecontactoclienteid,clientecontactoestado FROM  " . TBL_CLIENTECONTACTO . " WHERE clientecontactoclienteid=? and clientecontactoestado=1");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
            $clientedatobancariobanco = new clientecontacto($fila['clientecontactoid'],$fila['clientecontactotelefono1'],$fila['clientecontactotelefono2'],$fila['clientecontactocorreo'],$fila['clientecontactofax'],$fila['clientecontactoclienteid'],$fila['clientecontactoestado']);
            return $clientedatobancariobanco;
        }
        
        return null;
         
    } // obtenerOrdenId
    
    public function actualizar(clientecontacto $clientecontacto) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $id=$clientecontacto->getclientecontactoid();
        $telefono1 = $clientecontacto->getclientecontactotelefono1();
        $telefono2 = $clientecontacto->getclientecontactotelefono2();
        $correo = $clientecontacto->getclientecontactocorreo();
        $fax = $clientecontacto->getclientecontactofax();
      
        $consulta = $mysql->prepare("UPDATE " . TBL_CLIENTECONTACTO . " SET clientecontactotelefono1='$telefono1', clientecontactotelefono2='$telefono2', clientecontactocorreo='$correo' , clientecontactofax='$fax' WHERE empresacategoriaid='$id'");
 
        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
        
    } // actualizar

    public function borrar($id) {
        require_once rutaData . 'clientecontactoData.php';
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("UPDATE " . TBL_CLIENTECONTACTO . " SET clientecontactoestado=0 WHERE clientecontactoid=?");

        $consulta->bind_param("i", $id);
        
        $resultado = $consulta->execute();
        
        $consulta->close();
        
        return $resultado;
        
    } // borrar
    
}
?>


