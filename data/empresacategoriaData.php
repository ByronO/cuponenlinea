<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/empresacategoria.php';

class empresacategoriaData extends Conexion {
    
    public function insertar(empresacategoria $empresacategoria) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(empresacategoriaid) AS id FROM " . TBL_EMPRESACATEGORIA);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $codigo = $empresacategoria->getempresacategoriacodigo();
        $categoria = $empresacategoria->getempresacategorianombre();
        $acronimo = $empresacategoria->getempresacategoriaacronimo();
       
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_EMPRESACATEGORIA ."(empresacategoriaid,empresacategoriacodigo,empresacategoriaestado,empresacategorianombre,empresacategoriaacronimo) 
        VALUES('$id','$codigo',1,'$categoria','$acronimo');");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
    
    public function actualizar(empresacategoria $empresacategoria) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $id = $empresacategoria->getempresacategoriaid();
        $codigo = $empresacategoria->getempresacategoriacodigo();
        $nombre = $empresacategoria->getempresacategorianombre();
        $acronimo = $empresacategoria->getempresacategoriaacronimo();
      
        $consulta = $mysql->prepare("UPDATE " . TBL_EMPRESACATEGORIA . " SET empresacategoriacodigo='$codigo', empresacategorianombre='$nombre', empresacategoriaacronimo='$acronimo' WHERE empresacategoriaid='$id'");
 
        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
        
    } // actualizar
      public function obtenerEmpresaId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empresacategoriaid,empresacategoriacodigo,empresacategorianombre,empresacategoriaacronimo FROM  " . TBL_EMPRESACATEGORIA . " WHERE empresacategoriaid=?");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
        $empresacategoria = new empresacategoria($fila['empresacategoriaid'], $fila['empresacategoriacodigo'],1, $fila['empresacategorianombre'],$fila['empresacategoriaacronimo']);
            return $empresacategoria;
        }
        
        return null;
         
    } // obtenerOrdenId
    public function obtenerTodos() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empresacategoriaid,empresacategoriacodigo,empresacategorianombre,empresacategoriaacronimo FROM " . TBL_EMPRESACATEGORIA . " WHERE empresacategoriaestado=1;");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $empresacategorias = [];
        while ($fila = $resultado->fetch_array()) {
        $empresacategoria = new empresacategoria($fila['empresacategoriaid'], $fila['empresacategoriacodigo'],1, $fila['empresacategorianombre'],$fila['empresacategoriaacronimo']);
     
    array_push($empresacategorias, $empresacategoria);
        }
      return $empresacategorias;
         
    } // obtenerTodos

    
    public function borrar($id) {
        require_once rutaData . 'empresacategoriaData.php';
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("UPDATE " . TBL_EMPRESACATEGORIA . " SET empresacategoriaestado=0 WHERE empresacategoriaid=?");

        $consulta->bind_param("i", $id);
        
        $resultado = $consulta->execute();
        
        $consulta->close();
        
        return $resultado;
        
    } // borrar
    
}
?>


