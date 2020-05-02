<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cupon.php';


class cuponData extends Conexion {

    public function generarId(){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

        $ultimoId = $mysql->prepare("SELECT MAX(cuponid) AS id FROM " . TBL_CUPON);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
        return $id;
    }
    
    public function insertarCupon($cuponid, $cuponnombre, $empresaid, $serviciovalor,$cuponrutaimagen, $cupondescripcion, $cupondetallesadicionales,$cuponrestricciones,$cuponprecio, $cuponestado) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
               
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_CUPON ."(cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado) 
                            VALUES('$cuponid','$cuponnombre','$empresaid','$serviciovalor','$cuponrutaimagen','$cupondescripcion','$cupondetallesadicionales','$cuponrestricciones','$cuponprecio','$cuponestado');");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
    

    public function obtenerTodos() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado FROM " . TBL_CUPON);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            //$valores = explode(",", $fila['serviciovalor']);
            $valores =$fila['serviciovalor'];
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado']);
        
            array_push($cupones, $cupon);
        }
      return $cupones;
         
    } // obtenerTodos

    public function obtenerCupon($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado FROM " . TBL_CUPON . "  WHERE cuponid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
            $valores = explode(",", $fila['serviciovalor']);
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado']);
            
        }

        return $cupon;
         
    }   
    
    public function obtenerServicioId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT servicioid FROM " . TBL_SERVICIO . "  WHERE empresaid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
            $servicio = $fila['servicioid'];            
        }

        return $servicio;
         
    } 

    
    public function borrar($id) {
        require_once rutaData . 'cuponData.php';
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("UPDATE " . TBL_cupon . " SET cuponestado=0 WHERE cuponid=?");

        $consulta->bind_param("i", $id);
        
        $resultado = $consulta->execute();
        
        $consulta->close();
        
        return $resultado;
        
    } // borrar
    
}
?>


