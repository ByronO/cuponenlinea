<?php

include 'domain/servicio.php';
include 'domain/imagenservicio.php';
include 'domain/contacto.php';
session_start();

if (!isset($_SESSION['criterios'])) {
    $_SESSION['criterios'] = array();
}

if (!isset($_SESSION['servicios'])) {
    $_SESSION['servicios'] = array();
}

if (!isset($_SESSION['servicioE'])) {
    $_SESSION['servicioE'] = array();
}
//variables en session de contacto
if (!isset($_SESSION['criteriosContacto'])) {
    $_SESSION['criteriosContacto'] = array();
}
if (!isset($_SESSION['contactos'])) {
    $_SESSION['contactos'] = array();
}
if (!isset($_SESSION['contactoE'])) {
    $_SESSION['contactoE'] = array();
}
class EmpresaControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function insertar(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['nombre']) && isset($_POST['ubicacion'])){
                
                $empresa = new empresa(0,0, $_POST['nombre'],$_POST['ubicacion'],1, $_POST['tipo'],$_POST['cedula'],$_POST['sitio']);
                
                if($empresaData->insertar($empresa)){
                    $data['mensaje'] = 'Empresa creada correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;

        require_once rutaData . 'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();

        $data['categorias'] = $empresacategoriaData->obtenerTodos();
        
        $data['empresas'] = $empresaData->obtenerTodos();

        unset($_SESSION['criterios']);
        unset($_SESSION['servicios']);
        unset($_SESSION['servicioE']);
        unset($_SESSION['criteriosContacto']);
        unset($_SESSION['contactos']);
        unset($_SESSION['contactoE']);
        unset($_SESSION['serviciosC']);
        
        $this->vista->mostrar("insertarempresa.php", $data);

        
    } // insert
    
    public function actualizar(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();
        
        if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['ubicacion'])){

            $empresa = new empresa($_POST['id'], 0, $_POST['nombre'], $_POST['ubicacion'],1, $_POST['tipo'],$_POST['cedula'],$_POST['sitio']);

            if($empresaData->actualizar($empresa)){
                $data['mensaje'] = 'Empresa actualizada correctamente';
            }else $data['mensaje'] = 'Error al actualizar la empresa';

        }else $data = null;
        
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        
        require_once rutaData . 'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();

        $data['categorias'] = $empresacategoriaData->obtenerTodos();
        

        $data['empresa'] = $empresaData->obtenerempresaId($id);
        
        $this->vista->mostrar("actualizarEmpresa.php", $data);
    } // update
    
    public function borrar(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();
        
        if(isset($_GET['id'])){

            if($empresaData->borrar($_GET['id'])){
                $data['mensaje'] = 'Empresa eliminada correctamente';
            }else $data['mensaje'] = 'Error al eliminar la empresa';

        }else $data = null;
        
        require_once rutaData . 'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();

        $data['categorias'] = $empresacategoriaData->obtenerTodos();
        
        $data['empresas'] = $empresaData->obtenerTodos();
        $this->vista->mostrar("insertarempresa.php", $data);
    } // delete
    
    // SERCIVIOS
    public function agregarServicio()
    {
        $criterio = $_POST['criterio'];
        $servicio = $_POST['servicio'];
        $cont = 0;
        $encontro1 = 0;
        $encontro2 = 0;

        foreach ($_SESSION['criterios'] as $cr) {
            if ( $_SESSION['criterios'][$cont] == $criterio) {
                $encontro1 = 1;
            }
            $cont++;
        }
        $cont = 0;
        foreach ($_SESSION['servicios'] as $se) {
            if ( $_SESSION['servicios'][$cont] == $servicio) {
                $encontro2 = 1;
            }
            $cont++;
        }

        if ($encontro1 == 0 && $encontro2 == 0) {
            $_SESSION['criterios'][$cont] = $criterio;
            $_SESSION['servicios'][$cont] = $servicio;
            echo "Servicio agregado";
        } else {
            echo "Algunos de los valores ya fueron agregados";
        }
    }


    public function obtenerServiciosEmpresa(){
        
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        if(isset($_GET['id'])){
            $idempresa = $_GET['id'];

            $data['servicios'] = $empresaData->obtenerEmpresaServicio($idempresa);
            $_SESSION['servicioE'][0] = $data['servicios'];

            $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());

            unset($_SESSION['criterios']);
            unset($_SESSION['servicios']);
            $this->vista->mostrar("mostrarservicios.php", $data);
        }

    }
    
    public function eliminarServicio(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        if(isset($_GET['criterio'])){

            $criterioB = $_GET['criterio'];
            $cont = 0;
            $criteriosNuevos = "";
            $serviciosNuevos = "";

            $servicio = $empresaData->obtenerServicio($_SESSION['servicioE'][0]->getservicioid());
            foreach ($servicio->getserviciocriterio() as $cr) {
               
                if ($cr == $criterioB) {
                   
                }else{
                    $criteriosNuevos .= $servicio->getserviciocriterio()[$cont] . ',';
                    $serviciosNuevos .= $servicio->getserviciovalor()[$cont] . ',';
                }
                $cont++;
            }

            if($empresaData->eliminarServicio($_SESSION['servicioE'][0]->getservicioid(), $criteriosNuevos, $serviciosNuevos)){
                $data['mensaje'] = 'Servicio eliminado correctamente';
            }else $data['mensaje'] = 'Error al eliminar el servicio';

        }else $data = null;
        
        $data['servicios'] = $empresaData->obtenerEmpresaServicio($_SESSION['servicioE'][0]->getempresaid());
        $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());
        $this->vista->mostrar("mostrarservicios.php", $data);
    }

    public function actualizarServicios(){        
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        $cont = 0;
        $criteriosNuevos = "";
        $serviciosNuevos = "";

        $cont = 0;
        foreach ($_SESSION['servicios'] as $se) {
            $criteriosNuevos .= $_SESSION['criterios'][$cont] . ',';
            $serviciosNuevos .= $_SESSION['servicios'][$cont] . ',';
            
            $cont++;
        }

        if($empresaData->actualizarServicio($_SESSION['servicioE'][0]->getservicioid(), $criteriosNuevos, $serviciosNuevos)){
            $data['mensaje'] = 'Servicios agregados correctamente';
        }else $data['mensaje'] = 'Error al agregar servicios a la empresa';

        unset($_SESSION['criterios']);
        unset($_SESSION['servicios']);
        $data['servicios'] = $empresaData->obtenerEmpresaServicio($_SESSION['servicioE'][0]->getempresaid());
        $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());
        $this->vista->mostrar("mostrarservicios.php", $data);

    }

    public function agregarImagen(){

        $valor = $_GET['valor'];

        $data['valor'] = $valor;
        $data['servicio'] = $_SESSION['servicioE'][0];

        $this->vista->mostrar("seleccionarimagen.php", $data);

    }


    public function agregarImagenServicio(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        $id = $_POST['id'];
        $valor = $_POST['valor'];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileName = $_FILES['imagen']['name'];
            $fileSize = $_FILES['imagen']['size'];
            $fileType = $_FILES['imagen']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = $id . $valor . '.' . $fileExtension;

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'png', 'jpeg');


            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory in which the uploaded file will be moved
                $uploadFileDir = './publico/imgs/';
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {

                    $empresaData->agregarImagenServicio($id, $valor, $dest_path);
                    
                    $data['servicios'] = $_SESSION['servicioE'][0];
                    $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());

                    $this->vista->mostrar("mostrarservicios.php", $data);
                }

            }else{
                $data['valor'] = $valor;
                $data['servicio'] = $_SESSION['servicioE'][0];

                $this->vista->mostrar("seleccionarimagen.php", $data);
                echo "<script>
                alert('Extension invalida');</script>";
            }
        }   
    }


    // CONTACTOS
    
    public function eliminarContacto(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        if(isset($_GET['criterio'])){

            $criterioB = $_GET['criterio'];
            $cont = 0;
            $criteriosNuevos = "";
            $contactosNuevos = "";

            foreach ($_SESSION['contactoE'] as $se) {
               
                if ($_SESSION['contactoE'][0]->getempresacontactocriterio()[$cont] == $criterioB) {
                   
                }else{
                    $criteriosNuevos .= $_SESSION['contactoE'][0]->getempresacontactocriterio()[$cont] . ',';
                    $contactosNuevos .= $_SESSION['contactoE'][0]->getempesacontactovalor()[$cont] . ',';
                }
                $cont++;
            }

            if($empresaData->eliminarContacto($_SESSION['contactoE'][0]->getempesacontactoid(), $criteriosNuevos, $contactosNuevos)){
                $data['mensaje2'] = 'Contacto eliminado correctamente';
            }else $data['mensaje2'] = 'Error al eliminar la empresa';

        }else $data = null;
        $data['contactos'] = $empresaData->obtenerEmpresaContacto($_SESSION['contactoE'][0]->getempresaid());
        $this->vista->mostrar("mostrarcontactos.php", $data);
    }
    
    
    
    public function agregarContacto()
    {
        $criterioC = $_POST['criterioC'];
        $contacto = $_POST['contacto'];
        $cont = 0;
        $encontro1 = 0;
        $encontro2 = 0;

        foreach ($_SESSION['criteriosContacto'] as $cr) {
            if ( $_SESSION['criteriosContacto'][$cont] == $criterioC) {
                $encontro1 = 1;
            }
            $cont++;
        }
        $cont = 0;
        foreach ($_SESSION['contactos'] as $se) {
            if ( $_SESSION['contactos'][$cont] == $contacto) {
                $encontro2 = 1;
            }
            $cont++;
        }

        if ($encontro1 == 0 && $encontro2 == 0) {
            $_SESSION['criteriosContacto'][$cont] = $criterioC;
            $_SESSION['contactos'][$cont] = $contacto;
            echo "Contacto agregado";
        } else {
            echo "Alguno de los valores ya fueron agregados";
        }
    }
    public function obtenerContactosEmpresa(){
        
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        if(isset($_GET['id'])){
            $idempresa = $_GET['id'];

            $data['contactos'] = $empresaData->obtenerEmpresaContacto($idempresa);
            $_SESSION['contactoE'][0] = $data['contactos'];
            $this->vista->mostrar("mostrarcontactos.php", $data);
        }

    }



    public function actualizarContactos(){



    }
} // OrderController

?>