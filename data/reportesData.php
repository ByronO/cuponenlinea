<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cupon.php';
include 'domain/cuponVisitas.php';

class reportesData extends Conexion {

    public function RankeoporCostoDesc() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT cuponid,cuponnombre,cuponprecio,cupontipo 
        FROM ". TBL_CUPON."
        WHERE cuponestado=1
        ORDER BY cuponprecio DESC");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            
        $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], 1,1,1,1,1,1,$fila['cuponprecio'],1,1,1, $fila['cupontipo']);
        
        array_push($cupones, $cupon);
        }
      return $cupones;
         
    } // obtenerTodos
    public function Rankeomasvendidosseguncosto() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT distinct tbclientecompracupon.cuponid as id,tbcupon.cuponprecio as precio,tbcupon.cuponnombre as nombre
        FROM tbclientecompracupon JOIN tbcupon ON tbclientecompracupon.cuponid=tbcupon.cuponid
        order by tbcupon.cuponprecio desc
        limit 3");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            
    $cupon = new cupon($fila['id'], $fila['nombre'], 1,1,1,1,1,1,$fila['precio'],1,1,1,1);
        
        array_push($cupones, $cupon);
        }
      return $cupones;
         
    } // obtenerTodos
    public function Rankeomasvendidoshoy() {
      $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
      
      $consulta = $mysql->prepare("SELECT distinct tbclientecompracupon.cuponid as id,tbcupon.cuponprecio as precio,tbcupon.cuponnombre as nombre
      FROM tbclientecompracupon JOIN tbcupon ON tbclientecompracupon.cuponid=tbcupon.cuponid
      where CAST(tbclientecompracupon.fechaclientecompracupon as Date)=DATE(NOW())");
      
      $consulta->execute();
      
      $resultado = $consulta->get_result();
      
      $consulta->close();
      
      $cupones = [];

      while ($fila = $resultado->fetch_array()) {
          
        $cupon = new cupon($fila['id'], $fila['nombre'], 1,1,1,1,1,1,$fila['precio'],1,1,1,1);
      
        array_push($cupones, $cupon);
      }
    return $cupones;
       
  } // obtenerTodos
  public function Rankeomasvendidossemana() {
    $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
    
    $consulta = $mysql->prepare("SELECT distinct tbclientecompracupon.cuponid as id,tbcupon.cuponprecio as precio,tbcupon.cuponnombre as nombre
    FROM tbclientecompracupon JOIN tbcupon ON tbclientecompracupon.cuponid=tbcupon.cuponid
    where EXTRACT(week FROM tbclientecompracupon.fechaclientecompracupon)=week(CURDATE());");
    
    $consulta->execute();
    
    $resultado = $consulta->get_result();
    
    $consulta->close();
    
    $cupones = [];

    while ($fila = $resultado->fetch_array()) {
        
      $cupon = new cupon($fila['id'], $fila['nombre'], 1,1,1,1,1,1,$fila['precio'],1,1,1,1);
    
      array_push($cupones, $cupon);
    }
  return $cupones;
     
} // obtenerTodos

public function Rankeomasvisitados() {
  $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
  
  $consulta = $mysql->prepare("SELECT perfilclienteid,perfilclienteidcliente,perfilclientecupontipo,sum(perfilclientecantidadclicks) as perfilclientecantidadclicks from tbperfilciente
                                group by perfilclientecupontipo
                                ORDER BY perfilclientecantidadclicks DESC
                                LIMIT 5;");
                                
  $consulta->execute();
  
  $resultado = $consulta->get_result();
  
  $consulta->close();
  
  $cupones = [];

  while ($fila = $resultado->fetch_array()) {
      
    $cupon = new cuponVisitas($fila['perfilclientecupontipo'], $fila['perfilclientecantidadclicks']);
  
    array_push($cupones, $cupon);
  }
return $cupones;
   
} // obtenerTodos

}
?>

