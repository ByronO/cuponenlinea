<?php
session_start();
class DatobancarioControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor

    public function vistaprincipal(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        $data['cupones'] = $cuponData->obtenerTodos();
        $data['mensaje'] = '';
        $this->vista->mostrar("clientevistaprincipal.php", $data);
    }

    public function insertardatobanco(){
        require rutaData.'datobancarioData.php';
        $datobancarioData = new datobancarioData();

        require rutaData.'UsuarioData.php';
        $usuarioData = new usuarioData();

        if(isset($_POST['create'])){
            if(isset($_POST['tarjeta']) && isset($_POST['contra'])){
               
                $usuario = new usuario($_POST['usuario'], $_POST['contra']);

                if(is_numeric($usuarioData->verificarcliente($usuario)[0])) {
            
        $clientedatobancariobanco = new clientedatobancario(0,$_POST['banco'], $_POST['tarjeta'],0,$_SESSION['count'],0);
               
                if($datobancarioData->insertardatobanco($clientedatobancariobanco)){
                    $data['mensaje'] = 'ingresado correctamente';
                }else $data['mensaje'] = 'Error al insertar';

                }else {

                    $data['mensaje'] = 'Datos incorrectos';
                    $this->vista->mostrar("login.php", $data);
            }
      
            }else $data = null;
        }else $data = null;
        $data['cuentas'] = $datobancarioData->obtenerCuentasId($_SESSION['count']);  
        $data['mensaje'] = '';
        $this->vista->mostrar("clientevistaprincipal.php", $data);
    } // insert

    public function borrar(){
        require rutaData.'datobancarioData.php';
        $datobancarioData = new datobancarioData();
        
        if(isset($_GET['id'])){

            if($datobancarioData->borrar($_GET['id'])){
                $data['mensaje'] = 'Cuenta eliminada correctamente';
            }else $data['mensaje'] = 'Error al eliminar la cuenta';

        }else $data = null;
        $data['cuentas'] = $datobancarioData->obtenerCuentasId($_SESSION['count']);  
        $this->vista->mostrar("clientevistaprincipal.php", $data);
    } // delete

} // OrderController

?>