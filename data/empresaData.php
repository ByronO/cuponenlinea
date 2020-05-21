<?php


include_once("libs/Constantes.php");
include_once 'libs/Conexion.php';
include_once 'libs/Carpetas.php';
include 'domain/empresa.php';


class empresaData extends Conexion {
    
    public function insertar(empresa $empresa) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $ultimoId = $mysql->prepare("SELECT MAX(empresaid) AS id FROM " . TBL_EMPRESA);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }

        $codigo = $empresa->getempresacodigo();
        $nombre = $empresa->getempresanombre();
        $ubicacion = $empresa->getempresaubicacion();
        $tipo = $empresa->getempresacategoria();
        $cedula= $empresa->getempresacedula();
        $sitio= $empresa->getempresasitioweb();
        
        $consulta = 
        $mysql->prepare
        ("INSERT INTO ". TBL_EMPRESA ."(empresaid,empresacodigo,empresanombre,empresaubicacion,empresaestado,empresacategoria,empresacedulajuridica,empresasitioweb) VALUES('$id','$tipo$id','$nombre','$ubicacion',1,'$tipo','$cedula','$sitio');");


        $resultado = $consulta->execute();
        
        $consulta->close();

        //INSERTAR SERVICIOS LIGADOS
        $ultimoIdS = $mysql->prepare("SELECT MAX(servicioid) AS id FROM " . TBL_SERVICIO);
        $ultimoIdS->execute();
        $idS = 1;
        if ($fila = $ultimoIdS->get_result()->fetch_row()) {
            $idS = trim($fila[0]) + 1;
        }


        $cont = 0;
        $criterio = "";
        $servicio = "";
        foreach ($_SESSION['servicios'] as $se) {
            $criterio .= $_SESSION['criterios'][$cont] . ',';
            $servicio .= $_SESSION['servicios'][$cont] . ',';
            
            $cont++;
        }

        $consulta = $mysql->prepare("INSERT INTO ". TBL_SERVICIO ."(servicioid, serviciocriterio, serviciovalor, empresaid) 
                                            VALUES('$idS','$criterio','$servicio','$id');");

        $resultado = $consulta->execute();
            
        $consulta->close();

        unset($_SESSION['criterios']);
        unset($_SESSION['servicios']);
        //----------------------------------------


        //INSERTAR CONTACTOS LIGADOS 
        $ultimoIdC = $mysql->prepare("SELECT MAX(empresacontactoid) AS id FROM " . TBL_EMPRESACONTACTO);
        $ultimoIdC->execute();
        $idC = 1;
        if ($fila = $ultimoIdC->get_result()->fetch_row()) {
            $idC = trim($fila[0]) + 1;
        }
        $cont = 0;
        $criterioC = "";
        $contacto = "";
            
        foreach ($_SESSION['contactos'] as $se) {
            $criterioC .= $_SESSION['criteriosContacto'][$cont] . ',';
            $contacto .= $_SESSION['contactos'][$cont] . ',';
                
            $cont++;
        }
        $consulta = $mysql->prepare("INSERT INTO ". TBL_EMPRESACONTACTO ."(empresacontactoid, empresacontactocriterio, empresacontactovalor, empresaid) 
                                        VALUES('$idC','$criterioC','$contacto','$id');");

        $resultado = $consulta->execute();
         
        $consulta->close();

        unset($_SESSION['criteriosContacto']);
        unset($_SESSION['contactos']);
        //---------------------------
   
        return $resultado;
         
    } // insertar
    
    public function actualizar(empresa $empresa) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $id = $empresa->getempresaid();
        $codigo = $empresa->getempresacodigo();
        $nombre = $empresa->getempresanombre();
        $ubicacion = $empresa->getempresaubicacion();
        $tipo = $empresa->getempresacategoria();
        $cedula= $empresa->getempresacedula();
        $sitio= $empresa->getempresasitioweb();
      
        $consulta = $mysql->prepare("UPDATE " . TBL_EMPRESA . " SET empresacodigo='$codigo', empresanombre='$nombre', empresaubicacion='$ubicacion', 
        empresacategoria='$tipo', empresacedulajuridica='$cedula', empresasitioweb='$sitio' WHERE empresaid='$id'");

 
        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
        
    } // actualizar

    public function obtenerTodos() {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empresaid,empresacodigo,empresanombre,empresaubicacion,empresacategoria,empresacedulajuridica,empresasitioweb FROM " . TBL_EMPRESA . " WHERE empresaestado=1;");

        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $empresas = [];
        while ($fila = $resultado->fetch_array()) {
            $empresa = new empresa($fila['empresaid'], $fila['empresacodigo'], $fila['empresanombre'],$fila['empresaubicacion'],1, $fila['empresacategoria'],$fila['empresacedulajuridica'],$fila['empresasitioweb']);

            array_push($empresas, $empresa);
        }
      return $empresas;
         
    } // obtenerTodos
    
    public function obtenerEmpresaId($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empresaid,empresacodigo,empresanombre,empresaubicacion,empresacategoria,empresacedulajuridica,empresasitioweb FROM  " . TBL_EMPRESA . " WHERE empresaid=?");
        $consulta->bind_param("i", $id);
        
        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        if($fila = $resultado->fetch_assoc()) {

            $empresa = new empresa($fila['empresaid'], $fila['empresacodigo'], $fila['empresanombre'],$fila['empresaubicacion'],1, $fila['empresacategoria'],$fila['empresacedulajuridica'],$fila['empresasitioweb']);
            return $empresa;
        }
        
        return null;
         
    } 
    
    public function borrar($id) {
        require_once rutaData . 'empresaData.php';
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("UPDATE " . TBL_EMPRESA . " SET empresaestado=0 WHERE empresaid=?");

        $consulta->bind_param("i", $id);
        
        $resultado = $consulta->execute();
        
        $consulta->close();
        
        return $resultado;
        
    } // borrar


    public function obtenerEmpresaServicio($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT servicioid, serviciocriterio, serviciovalor FROM  " . TBL_SERVICIO . " WHERE empresaid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result()->fetch_array();
        
        $consulta->close();
        /*
        $servicios = [];
        while ($fila = $resultado->fetch_array()) {
            $servicio = new servicio($fila['servicioid'], $fila['servivciocriterio'], $fila['serviciovalor'],$id);
            
            array_push($servicios, $servicio);
        }
        
        return $servicios; 
         */
        $criterios = explode(",", $resultado[1]);
        $valores = explode(",", $resultado[2]);

        $servicios = new servicio($resultado[0],$criterios, $valores,$id);

        return $servicios;
    } 

    public function obtenerServicio($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT servicioid, serviciocriterio, serviciovalor FROM  " . TBL_SERVICIO . " WHERE servicioid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result()->fetch_array();
        
        $consulta->close();
        /*
        $servicios = [];
        while ($fila = $resultado->fetch_array()) {
            $servicio = new servicio($fila['servicioid'], $fila['servivciocriterio'], $fila['serviciovalor'],$id);
            
            array_push($servicios, $servicio);
        }
        
        return $servicios; 
         */
        $criterios = explode(",", $resultado[1]);
        $valores = explode(",", $resultado[2]);

        $servicios = new servicio($resultado[0],$criterios, $valores,$id);

        return $servicios;
    } 

    public function obtenerEmpresaContacto($id) {
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT empesacontactoid, empresacontactocriterio, empesacontactovalor FROM  " . TBL_EMPRESACONTACTO . " WHERE empresaid='$id'");
        
        $consulta->execute();
        
        $resultado = $consulta->get_result()->fetch_array();
        
        $consulta->close();
        /*
        $servicios = [];
        while ($fila = $resultado->fetch_array()) {
            $servicio = new servicio($fila['servicioid'], $fila['servivciocriterio'], $fila['serviciovalor'],$id);
            
            array_push($servicios, $servicio);
        }
        
        return $servicios; 
         */
        $criterios = explode(",", $resultado[1]);
        $valores = explode(",", $resultado[2]);
        
        $contactos = new contacto($resultado[0],$criterios,$valores,$id);
        return $contactos;
    }

    public function eliminarServicio($id, $criterios, $valores){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

        $consulta = $mysql->prepare("UPDATE " . TBL_SERVICIO . " SET serviciocriterio='$criterios', serviciovalor = '$valores' WHERE servicioid='$id'");

        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
    }

    public function actualizarServicio($id, $criterios, $valores){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

        $consulta = $mysql->prepare("SELECT serviciocriterio, serviciovalor FROM  " . TBL_SERVICIO . " WHERE servicioid='$id'");
        $consulta->execute();
        $resultado = $consulta->get_result()->fetch_array();
        
        $consulta->close();

        $criteriosNuevos = $resultado[0] .',' . $criterios;
        $valoresNuevos = $resultado[1]  .',' . $valores; 

        $consulta = $mysql->prepare("UPDATE " . TBL_SERVICIO . " SET serviciocriterio='$criteriosNuevos', serviciovalor = '$valoresNuevos' WHERE servicioid='$id'");

        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
    }

    public function agregarImagenServicio($idS, $valor, $ruta){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);

        $ultimoId = $mysql->prepare("SELECT MAX(id) AS id FROM " . TBL_SERVICIOIMAGEN);
        $ultimoId->execute();
        $id = 1;
        if ($fila = $ultimoId->get_result()->fetch_row()) {
            $id = trim($fila[0]) + 1;
        }

        $consulta = $mysql->prepare("INSERT INTO ". TBL_SERVICIOIMAGEN ."(id, servicioid, serviciovalor, ruta) 
                                    VALUES('$id', '$idS', '$valor','$ruta');");

        $resultado = $consulta->execute();

        $consulta->close();
                            
    }

    public function obtenerImageneServicio($id){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("SELECT id, servicioid, serviciovalor, ruta FROM " . TBL_SERVICIOIMAGEN . " WHERE servicioid='$id';");

        $consulta->execute();
        
        $resultado = $consulta->get_result();
        
        $consulta->close();
        
        $imagenes = [];
        while ($fila = $resultado->fetch_array()) {
            $imagen = new imagenservicio($fila['id'], $fila['servicioid'], $fila['serviciovalor'],$fila['ruta']);

            array_push($imagenes, $imagen);
        }
      return $imagenes;


    }

    public function eliminarContacto($id, $criterios, $valores){
        $mysql = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->db);
        
        $consulta = $mysql->prepare("UPDATE " . TBL_EMPRESACONTACTO . " SET empresacontactocriterio='$criterios', empesacontactovalor = '$valores' WHERE empesacontactoid='$id'");

        $resultado = $consulta->execute();
        
        $consulta->close();

        
        return $resultado;
    }
}
?>