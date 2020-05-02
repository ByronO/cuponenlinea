<?php
session_start();
class ClientecontactoControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor

    public function vistaprincipal(){
        require rutaData.'datobancarioData.php';
        $datobancarioData = new datobancarioData();

        $data['cuentas'] = $datobancarioData->obtenerCuentasId($_SESSION['count']);  
        $data['mensaje'] = '';
        $this->vista->mostrar("clientevistaprincipal.php", $data);
    }


    public function vistainsertarcontactos(){
        require rutaData.'clientecontactoData.php';
        $clientecontactoData = new clientecontactoData();
        $data['contactocliente'] = $clientecontactoData->obtenerContactoId($_SESSION['count']);  
        $data['mensaje'] = '';
        $this->vista->mostrar("insertarclientecontacto.php", $data);
    }

    public function insertar(){
        require rutaData.'clientecontactoData.php';
        $clientecontactoData = new clientecontactoData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['tel1']) && isset($_POST['tel2'])){
               
        $clientecontacto = new clientecontacto(0,$_POST['tel1'],$_POST['tel2'],$_POST['correo'],$_POST['fax'],$_SESSION['count'],1);
      
                if($clientecontactoData->insertar($clientecontacto)){
                    $data['mensaje'] = 'Contacto creado correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
    
       $data['contactocliente'] = $clientecontactoData->obtenerContactoId($_SESSION['count']);  
        $this->vista->mostrar("insertarclientecontacto.php", $data);
    } // insert
    

    public function actualizar(){
        require rutaData.'clientecontactoData.php';
        $clientecontactoData = new clientecontactoData();
        
        if(isset($_POST['id']) && isset($_POST['tel1']) && isset($_POST['tel2'])){

        $clientecontacto = new clientecontacto($_POST['id'],$_POST['tel1'],$_POST['tel2'],$_POST['correo'],$_POST['fax'],$_SESSION['count'],1);
      
            if($clientecontactoData->actualizar($clientecontacto)){
                $data['mensaje'] = 'Contacto actualizado correctamente';
            }else $data['mensaje'] = 'Error al actualizar el Contacto';

        }else $data = null;
        
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        
        $data['contactocliente1'] = $clientecontactoData->obtenerActualizarContacto($_SESSION['count']);  
        
        $this->vista->mostrar("actualizarclientecontacto.php", $data);
    } // update
    

    public function borrar(){
        require rutaData.'clientecontactoData.php';
        $clientecontactoData = new clientecontactoData();
        
        if(isset($_GET['id'])){

            if($clientecontactoData->borrar($_GET['id'])){
                $data['mensaje'] = 'Contacto eliminada correctamente';
            }else $data['mensaje'] = 'Error al eliminar la empresa';

        }else $data = null;
       
        $data['contactocliente'] = $clientecontactoData->obtenerContactoId($_SESSION['count']);  
        $this->vista->mostrar("insertarclientecontacto.php", $data);
    } // delete
    
    
} // OrderController

?>