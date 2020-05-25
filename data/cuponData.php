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
    
    public function insertarCupon($cuponid, $cuponnombre, $empresaid, $serviciovalor,$cuponrutaimagen, $cupondescripcion, $cupondetallesadicionales,$cupontipo,$cuponrestricciones,$cuponprecio, $cuponestado, $cuponfechainicio, $cuponfechafin) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
               
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_CUPON ."(cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion, cupondetallesadicionales, cupontipo, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin) 
                            VALUES('$cuponid','$cuponnombre','$empresaid','$serviciovalor','$cuponrutaimagen','$cupondescripcion','$cupondetallesadicionales','$cupontipo','$cuponrestricciones','$cuponprecio','$cuponestado','$cuponfechainicio','$cuponfechafin');");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
    

    public function obtenerTodos() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion,cupontipo, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin FROM " . TBL_CUPON);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            //$valores = explode(",", $fila['serviciovalor']);
            $valores =$fila['serviciovalor'];
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
        
            array_push($cupones, $cupon);
        }
      return $cupones;
         
    } // obtenerTodos

    public function obtenerTodosFiltrado() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $idC = $_SESSION['count'];
        $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                        join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                            join tbempresaturistica e on c.empresaid = e.empresaid
                                                join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                    where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%')
                                                        order by p.perfilclientecantidadclicks DESC;");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            //$valores = explode(",", $fila['serviciovalor']);
            $valores =$fila['serviciovalor'];
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
        
            array_push($cupones, $cupon);
        }

        $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                        join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                            join tbempresaturistica e on c.empresaid = e.empresaid
                                                join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                    where p.perfilclienteidcliente = '$idC' and cl.clientedireccion not like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%')
                                                        order by p.perfilclientecantidadclicks DESC;");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();

        while ($fila = $resultado->fetch_array()) {
            //$valores = explode(",", $fila['serviciovalor']);
            $valores =$fila['serviciovalor'];
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
        
            array_push($cupones, $cupon);
        }

        $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion,cupontipo, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin FROM " . TBL_CUPON);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();


        while ($fila = $resultado->fetch_array()) {
            $existe = 0;
            foreach($cupones as $cupon){
                if($cupon->getcuponid() == $fila['cuponid']){
                    $existe = 1;
                }
            }

            if($existe == 0){
                $valores =$fila['serviciovalor'];
                $cuponN = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
            
                array_push($cupones, $cuponN);
            }
        }

      return $cupones;
         
    } // obtenerTodos    

    public function obtenerCupon($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin, cupontipo FROM " . TBL_CUPON . "  WHERE cuponid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
            $valores = explode(",", $fila['serviciovalor']);
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
            
        }
        return $cupon;
         
    }   

    public function obtenerDetallesCupon($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT c.cuponid, c.cuponnombre, e.empresaid, e.empresanombre, e.empresasitioweb, e.empresaubicacion, e.empresaotrassennas, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin, c.cupontipo FROM " . TBL_CUPON . " c
                                    JOIN tbempresaturistica e ON c.empresaid = e.empresaid
                                     WHERE cuponid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $detalles = [];
        if($fila = $resultado->fetch_assoc()) {
            $valores = explode(",", $fila['serviciovalor']);
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
            
            $empresa = new empresa($fila['empresaid'], '', $fila['empresanombre'],$fila['empresaubicacion'],$fila['empresaotrassennas'],1, '','',$fila['empresasitioweb']);

            array_push($detalles, $cupon);
            array_push($detalles, $empresa);
        }

        return $detalles;
         
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


