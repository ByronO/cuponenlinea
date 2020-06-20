<?php

include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/cupon.php';
include 'domain/compra.php';


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

    public function obtenerComprasId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT c.clientecompracuponid,c.clienteid,p.cuponnombre,c.cantidadcupones,c.fechaclientecompracupon FROM  " . TBL_COMPRA . " c JOIN tbcupon p ON p.cuponid = c.cuponid  WHERE clienteid=?");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
       $compras = [];
        while ($fila = $resultado->fetch_array()) {
        $compra = new compra($fila['clientecompracuponid'],$fila['clienteid'],$fila['cuponnombre'],$fila['cantidadcupones'] ,$fila['fechaclientecompracupon']);
        array_push($compras, $compra);
        }
    return $compras;

    } // obtenerOrdenId
    
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

    public function insertarcompracupon(compra $compra) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(clientecompracuponid) AS id FROM " . TBL_COMPRA);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }
    
        $cliente = $compra->getclienteid();
        $cupon = $compra->getcuponid();
        $cantidad = $compra->getcantidadcupones();

        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_COMPRA ."(clientecompracuponid,clienteid,cuponid,cantidadcupones,fechaclientecompracupon)
        VALUES('$id','$cliente','$cupon','$cantidad',NOW());");

        $resultado = $consulta->execute();
        
        $consulta->close();
   
        return $resultado;
         
    } // insertar
    
    public function establecerPrioridad($prioridad) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        if($prioridad == 1){
            $consulta = $mysql->prepare("UPDATE tbcriterioprioridad SET prioridadubicacion=1, prioridadclicks=0 where id = 1");
            $resultado = $consulta->execute();
            
            $consulta->close();
        }else{
            $consulta = $mysql->prepare("UPDATE tbcriterioprioridad SET prioridadubicacion=0, prioridadclicks=1 where id = 1");
            $resultado = $consulta->execute();
            
            $consulta->close();
        }
        
         
    } 
    
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

    public function obtenerCuponesRecomendados() {
        $id = $_SESSION['count'];

        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("select c.cupontipo  from tbclientecompracupon tc 
                                        JOIN tbcupon c ON tc.cuponid = c.cuponid
                                    WHERE tc.fechaclientecompracupon between DATE_SUB(NOW(),INTERVAL 1 MONTH) AND NOW() and clienteid = '$id'
                                    GROUP BY c.cupontipo ORDER BY count(c.cupontipo) desc limit 2;");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();

        $tipos = [];
        
        while ($fila = $resultado->fetch_array()) {    
            array_push($tipos, $fila['cupontipo']);
        }

        $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                        WHERE c.cupontipo = '$tipos[0]' limit 2");
        
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
                                        WHERE c.cupontipo = '$tipos[1]' limit 2");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();

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
        $consulta = $mysql->prepare("select prioridadubicacion, prioridadclicks from tbcriterioprioridad where id=1");
        $consulta->execute();
        $resultado = $consulta->get_result();
        $consulta->close();

        $fila = $resultado->fetch_array();
        $ubicacionP = $fila['prioridadubicacion'];
        $cupones = [];
        $idC = $_SESSION['count'];
        if($ubicacionP == 1){
            //DISTRITO
            
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 3),'%')
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

            //CANTON
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%') and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 2),'%')
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    //$valores = explode(",", $fila['serviciovalor']);
                    $valores =$fila['serviciovalor'];
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
            }

            //PROVINCIA
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%')
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
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
                $existe = 0;
                foreach($cupones as $cupon){
                    if($cupon->getcuponid() == $fila['cuponid']){
                        $existe = 1;
                    }
                }

                if($existe == 0){
                    //$valores = explode(",", $fila['serviciovalor']);
                    $valores =$fila['serviciovalor'];
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
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


        }else{
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' 
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    //$valores = explode(",", $fila['serviciovalor']);
                    $valores =$fila['serviciovalor'];
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
            }

            //DISTRITO
            $idC = $_SESSION['count'];
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 3),'%')
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    //$valores = explode(",", $fila['serviciovalor']);
                    $valores =$fila['serviciovalor'];
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
            }
            

            //CANTON
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%') and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 2),'%')
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    //$valores = explode(",", $fila['serviciovalor']);
                    $valores =$fila['serviciovalor'];
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
            }

            //PROVINCIA
            $consulta = $mysql->prepare("select c.cuponid,c.cuponnombre, c.empresaid, c.serviciovalor, c.cuponrutaimagen, c.cupondescripcion,cupontipo, c.cupondetallesadicionales, c.cuponrestricciones, c.cuponprecio, c.cuponestado, c.cuponfechainicio, c.cuponfechafin from tbcupon c 
                                            join tbperfilciente p on c.cupontipo = p.perfilclientecupontipo
                                                join tbempresaturistica e on c.empresaid = e.empresaid
                                                    join tbcliente cl on cl.clienteid = p.perfilclienteidcliente
                                                        where p.perfilclienteidcliente = '$idC' and cl.clientedireccion like concat('%', SUBSTRING_INDEX(e.empresaubicacion, ',', 1),'%')
                                                            order by p.perfilclientecantidadclicks DESC;");
            
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
                    $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
                
                    array_push($cupones, $cupon);
                }
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
            
        }
        
        

      return $cupones;
         
    } // obtenerTodos 


    public function obtenerTodosFiltradoSession() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

        $id = $_SESSION["count"];
        $consulta = $mysql->prepare("SELECT clienteid, clicksmayor, clicksmenor from tbclientesession where clienteid='$id'");
      
        $consulta->execute();
        $resultado = $consulta->get_result();
        $consulta->close();
        
        $fila = $resultado->fetch_array();
        if($fila['clicksmayor'] > $fila['clicksmenor']){
            
            $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion,cupontipo, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin FROM " . TBL_CUPON . " ORDER BY cuponprecio DESC;");
        
            $consulta->execute();            
            $resultado = $consulta->get_result();            
            $consulta->close();

        }else{
            $consulta = $mysql->prepare("SELECT cuponid, cuponnombre, empresaid, serviciovalor, cuponrutaimagen, cupondescripcion,cupontipo, cupondetallesadicionales, cuponrestricciones, cuponprecio, cuponestado, cuponfechainicio, cuponfechafin FROM " . TBL_CUPON. " ORDER BY cuponprecio ASC;");
        
            $consulta->execute();            
            $resultado = $consulta->get_result();            
            $consulta->close();

        }
        
        $cupones = [];

        while ($fila = $resultado->fetch_array()) {
            //$valores = explode(",", $fila['serviciovalor']);
            $valores =$fila['serviciovalor'];
            $cupon = new cupon($fila['cuponid'], $fila['cuponnombre'], $fila['empresaid'],$valores, $fila['cuponrutaimagen'], $fila['cupondescripcion'],$fila['cupondetallesadicionales'], $fila['cuponrestricciones'], $fila['cuponprecio'],$fila['cuponestado'], $fila['cuponfechainicio'], $fila['cuponfechafin'], $fila['cupontipo']);
        
            array_push($cupones, $cupon);
        }
      return $cupones;
         
    } // obtenerTodos

    public function obtenerPromedioPreciosCupon() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT (sum(cuponprecio)/count(cuponid)) as promedio from tbcupon");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {
            $data = $fila['promedio'];
        }
        return $data;
         
    }      

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
    
}
?>


