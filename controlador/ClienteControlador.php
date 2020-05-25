<?php
session_start();

if(!isset($_SESSION['ubicacioncompletaC'])){
    $_SESSION['ubicacioncompletaC'] = array();
}

include 'domain/servicio.php';
include 'domain/imagenservicio.php';

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

    public function vistarecomendarclientecupon(){
        require_once rutaData.'cuponData.php';
        $cuponData = new cuponData();
        $data['cuponesrecomendar'] = $cuponData->obtenerTodos();

        require_once rutaData.'clienteData.php';
        $clienteData = new clienteData();
        $data['clientesAmigos'] = $clienteData->obtenertodoclientes();
        $data['cuponesrecomendados']=$clienteData->obtenercuponesrecomendados($_SESSION['count']);

        $data['mensaje'] = '';
        $this->vista->mostrar("insertarrecomendarclientecupon.php", $data);
    }

    public function insertarclientenuevo(){
        require rutaData.'clienteData.php';
        $clienteData = new clienteData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['correo']) && isset($_POST['contra'])){
               
                   
        $cliente = new cliente(0,$_POST['correo'],$_POST['contra'],($_SESSION['ubicacioncompletaC'][0].",".$_SESSION['ubicacioncompletaC'][1].",".$_SESSION['ubicacioncompletaC'][2]), 1,0,0);
        echo $cliente->getclientedireccion();
                if($clienteData->insertar($cliente)){
                    $data['mensaje'] = 'Cliente creado correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
        $data['mensaje'] = '';
        unset($_SESSION['ubicacioncompletaC']);
        $this->vista->mostrar("insertarcliente.php", $data);
    } // insert
    
    public function clienterecomendarcupon(){
        require rutaData.'clienteData.php';
        $clienteData = new clienteData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['cuponrecomendadoid']) && isset($_POST['clientereceptorid'])){
        $emisor=$_SESSION['count'];
        $clienterecomendar = new clienterecomendarcupon(0,$_POST['cuponrecomendadoid'],$emisor,$_POST['clientereceptorid'],0,0);
               
                if($clienteData->insertarclienterecomendarcupon($clienterecomendar)){
                    $data['mensaje'] = 'Cupón recomendado correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
        require_once rutaData.'cuponData.php';
        $cuponData = new cuponData();
        $data['cuponesrecomendar'] = $cuponData->obtenerTodos();

        require_once rutaData.'clienteData.php';
        $clienteData = new clienteData();
        $data['clientesAmigos'] = $clienteData->obtenertodoclientes();
        $data['cuponesrecomendados']=$clienteData->obtenercuponesrecomendados($_SESSION['count']);

        $data['mensaje'] = '';
        $this->vista->mostrar("insertarrecomendarclientecupon.php", $data);
    } // insert
    
    public function inicio(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        $data['cupones'] = $cuponData->obtenerTodosFiltrado();
        unset($_SESSION['ubicacioncompletaC']);
        $this->vista->mostrar("clientevistaprincipal.php", $data);
        
    }

    public function agregarUbicacion()
    {
        
        $ubicacion = $_POST['ubicacion'];
        $id = $_POST['id'];

        $_SESSION['ubicacioncompletaC'][$id]=$ubicacion;
        $cont =0;
        foreach ($_SESSION['ubicacioncompleta'] as $cr) {
            echo $_SESSION['ubicacioncompleta'][$cont];
            $cont++;
        }
    }

    public function verDetallesCupon(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        require rutaData. 'clienteData.php';
        $clienteData = new clienteData();

       

        $id = $_GET['id'];

        $data['cupon'] = $cuponData->obtenerDetallesCupon($id)[0];

        $data['empresa'] = $cuponData->obtenerDetallesCupon($id)[1];

        $data['imagenes'] = $empresaData->obtenerImageneServicio($cuponData->obtenerServicioId($data['cupon']->getempresaid()));

        $clienteData->cantidadClicks($_SESSION['count'], $data['cupon']->getcupontipo());
        
        $this->vista->mostrar("mostrardetallescupon.php", $data);

    }


} // 

?>