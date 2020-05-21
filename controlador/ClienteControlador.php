<?php
session_start();

class ClienteControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    
    public function vistaRegistro(){
        $data['mensaje'] = '';
        $this->vista->mostrar("insertarcliente.php", $data);
    }

    public function vistadatobanco(){

        require rutaData.'datobancarioData.php';
        $datobancarioData = new datobancarioData();
        $data['mensaje'] = '';
        $data['cuentas'] = $datobancarioData->obtenerCuentasId($_SESSION['count']);
        $this->vista->mostrar("insertarclientedatobancario.php", $data);
    }

    public function insertarclientenuevo(){
        require rutaData.'clienteData.php';
        $clienteData = new clienteData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['correo']) && isset($_POST['contra'])){
               
        $cliente = new cliente(0,$_POST['correo'],$_POST['contra'],1,0,0);
                
                if($clienteData->insertar($cliente)){
                    $data['mensaje'] = 'Cliente creado correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
        $data['mensaje'] = '';
        $this->vista->mostrar("insertarcliente.php", $data);
    } // insert
    
    
    public function inicio(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        $data['cupones'] = $cuponData->obtenerTodos();
        
        $this->vista->mostrar("clientevistaprincipal.php", $data);
        
    }



} // 

?>