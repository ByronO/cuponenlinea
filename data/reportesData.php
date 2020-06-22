<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cupon.php';
include 'domain/cuponVisitas.php';
include 'domain/compra.php';

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


  public function RankeoTotalGanancia() {
    $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
    
    $consulta = $mysql->prepare("select sum(p.cuponprecio) as ganancia
    from tbclientecompracupon c JOIN tbcupon p on p.cuponid=c.cuponid");
    
    $consulta->execute();
    
    $resultado = $consulta->get_result();
    
    $consulta->close();
    
    $cupones = [];

    while ($fila = $resultado->fetch_array()) {
        
      $cupon = new cupon(1,1,1,1,1,1,1,1,$fila['ganancia'],1,1,1,1);
    
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

public function obtenerComprasId($id) {
  $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
  
  $consulta = $mysql->prepare("SELECT c.clientecompracuponid,c.clienteid,n.cuponnombre,count(c.cuponid) as cantidad,c.fechaclientecompracupon
  FROM  tbclientecompracupon c JOIN tbcliente p ON p.clienteid = c.clienteid 
  join tbcupon n on c.cuponid= n.cuponid
  WHERE c.clienteid=?
  group by n.cuponnombre");

  $consulta->bind_param("i", $id);
  
  $consulta->execute();
  
  $resultado = $consulta->get_result();
  
 $compras = [];
  while ($fila = $resultado->fetch_array()) {
  $compra = new compra($fila['clientecompracuponid'],$fila['clienteid'],$fila['cuponnombre'],$fila['cantidad'] ,$fila['fechaclientecompracupon']);
  array_push($compras, $compra);
  }
return $compras;

} // obtenerOrdenId

public function obtenerComprasCategoriaId($id) {
  $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
  
  $consulta = $mysql->prepare("SELECT n.cupontipo,c.clienteid,n.cuponnombre,count(c.cuponid) as cantidad,c.fechaclientecompracupon
  FROM  tbclientecompracupon c JOIN tbcliente p ON p.clienteid = c.clienteid 
  join tbcupon n on c.cuponid= n.cuponid
  WHERE c.clienteid=?
  group by n.cupontipo");

  $consulta->bind_param("i", $id);
  
  $consulta->execute();
  
  $resultado = $consulta->get_result();
  
 $compras = [];
  while ($fila = $resultado->fetch_array()) {
  $compra = new compra($fila['cupontipo'],$fila['clienteid'],$fila['cuponnombre'],$fila['cantidad'] ,$fila['fechaclientecompracupon']);
  array_push($compras, $compra);
  }
return $compras;

} // obtenerOrdenId

}
?>

