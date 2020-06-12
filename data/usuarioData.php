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
    
    public function verificarcliente(usuario $usuario1) {
      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
      
      $nombre = $usuario1->getusuarionombre();
      $contra = $usuario1->getusuariocontrasenna();
      
      $consulta = $mysql->prepare("SELECT clienteid FROM " . TBL_CLIENTE . " WHERE clientecorreo='$nombre' and clientecontrasenna='$contra';");

      $consulta->execute();
      
      $resultado = $consulta->get_result();

      $consulta->close();
 
      $id = [];
      $fila = $resultado->fetch_array();
      array_push($id, $fila['clienteid']);
    return $id;
       
  } // insertar


    public function obtenerTodos() {

      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
      
      $consulta = $mysql->prepare("SELECT empresaid,empresacodigo,empresanombre,empresaubicacion,empresaotrassennas,empresacategoria,empresacedulajuridica,empresasitioweb FROM " . TBL_EMPRESA . " WHERE empresaestado=1;");
      
      $consulta->execute();
      
      $resultado = $consulta->get_result();
      
      $consulta->close();
      
      $empresas = [];
      while ($fila = $resultado->fetch_array()) {
          $empresa = new empresa($fila['empresaid'], $fila['empresacodigo'], $fila['empresanombre'],$fila['empresaubicacion'],$fila['empresaotrassennas'],1, $fila['empresacategoria'],$fila['empresacedulajuridica'],$fila['empresasitioweb']);

          array_push($empresas, $empresa);
      }
    return $empresas;
       
  } // obtenerTodos
    
    public function crearClienteSession($idCliente){
      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

      $consulta = $mysql->prepare("insert into tbclientesession (clienteid, clicksmayor, clicksmenor) values ('$idCliente','0','0');");
        
      $consulta->execute();
  
      $consulta->close();

    }

    public function eliminarClienteSession($idCliente){
      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

      $consulta = $mysql->prepare("delete from tbclientesession where clienteid = '$idCliente';");
        
      $consulta->execute();
  
      $consulta->close();

    }

    public function obtenerDatosSession(){
      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
      
      $id = $_SESSION["count"];
      $consulta = $mysql->prepare("SELECT clienteid, clicksmayor, clicksmenor from tbclientesession where clienteid='$id'");
      
      $consulta->execute();
      
      $resultado = $consulta->get_result();
      
      $consulta->close();
      
      $datos = [];
      $fila = $resultado->fetch_array();
      array_push($datos, $fila['clienteid']);
      array_push($datos, $fila['clicksmayor']);
      array_push($datos, $fila['clicksmenor']);
      return $datos;


    }
    
}
?>

  
