<?php
include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cliente.php';
include 'domain/clientedatobancario.php';
include 'domain/clienterecomendarcupon.php';

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

    public function insertarclienterecomendarcupon(clienterecomendarcupon $clienterecomendarcupon) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(clienterecomendarcuponid) AS id FROM " . TBL_CUPONRECOMENDAR);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $cuponrecomendadoid = $clienterecomendarcupon->getcuponrecomendadoid();
        $clienteemisorid = $clienterecomendarcupon->getclienteemisorid();
        $clientereceptorid = $clienterecomendarcupon->getclientereceptorid();
    
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_CUPONRECOMENDAR ."(clienterecomendarcuponid,cuponrecomendadoid,clienteemisorid,clientereceptorid,cuponrecomendadoestado,cupondescuento) 
        VALUES('$id','$cuponrecomendadoid','$clienteemisorid','$clientereceptorid',0,5);");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;

        
         
    } // insertar

    public function obtenertodoclientes() {

        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT clienteid,clientecorreo FROM " . TBL_CLIENTE . " WHERE clienteestado=1 and clienteid!=".$_SESSION['count'].";");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $clientes = [];
        while ($fila = $resultado->fetch_array()) {
            $cliente = new cliente($fila['clienteid'],$fila['clientecorreo'],1,1,1,1);
  
            array_push($clientes, $cliente);
        }
      return $clientes;
         
    } // obtenerTodos
    
    
    public function obtenercuponesrecomendados($id) {

        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
      
        $consulta = $mysql->prepare("select c.cuponnombre AS cuponrecomendadoid,e.clientecorreo As clienteemisorid
        from tbcupon c join tbclienterecomendarcupon r
        on c.cuponid=r.cuponrecomendadoid
        join tbcliente e
        on e.clienteid=r.clienteemisorid WHERE clientereceptorid=".$id.";");
        
        $consulta->execute();
   
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $clienterecomendarcupones = [];
        while ($fila = $resultado->fetch_array()) {
            $clienterecomendarcupon = new clienterecomendarcupon(1,$fila['cuponrecomendadoid'],$fila['clienteemisorid'],1,1,1);
  
            array_push($clienterecomendarcupones, $clienterecomendarcupon);
        }
      return $clienterecomendarcupones;
         
    } // obtenerTodos
  
}
?>

