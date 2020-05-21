<?php

include 'domain/servicio.php';
include 'domain/imagenservicio.php';

session_start();

if (!isset($_SESSION['serviciosC'])) {
    $_SESSION['serviciosC'] = array();
}

class CuponControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function insertar(){
        require rutaData.'empresaData.php';
        $empresaData = new empresaData();

        if(isset($_GET['id'])){
            $idempresa = $_GET['id'];

            $data['servicios'] = $empresaData->obtenerEmpresaServicio($idempresa);
            $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());

            unset($_SESSION['criterios']);
            unset($_SESSION['servicios']);
            unset($_SESSION['serviciosC']);
            $this->vista->mostrar("insertarcupon.php", $data);
        }
    }

    public function verCupones(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        $data['cupones'] = $cuponData->obtenerTodos();
        
        $this->vista->mostrar("listacupones.php", $data);

        
    }

    public function verServicios(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        require rutaData.'empresaData.php';
        $empresaData = new empresaData();


        $id = $_GET['id'];

        $data['cupon'] = $cuponData->obtenerCupon($id);

        $data['imagenes'] = $empresaData->obtenerImageneServicio($cuponData->obtenerServicioId($data['cupon']->getempresaid()));
        

        $this->vista->mostrar("mostrarservicioscupon.php", $data);

        
    }

    public function insertarCupon(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK && isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileName = $_FILES['imagen']['name'];
            $fileSize = $_FILES['imagen']['size'];
            $fileType = $_FILES['imagen']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $id = $cuponData->generarId();
            // sanitize file-name
            $newFileName = $id . $_POST['nombre'] . '.' . $fileExtension;

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'png', 'jpeg');


            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory in which the uploaded file will be moved
                $uploadFileDir = './publico/imgs/';
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    
                    $cont = 0;
                    $servicio = "";
                    foreach ($_SESSION['serviciosC'] as $se) {
                        $servicio .= $_SESSION['serviciosC'][$cont] . ',';
                        
                        $cont++;
                    }

                    $cuponData->insertarCupon($id,$_POST['nombre'], $_POST['empresaid'],$servicio, $dest_path, $_POST['descripcion'], $_POST['detalles'], $_POST['restricciones'],$_POST['precio'], 1, $_POST['fechainicio'] , $_POST['fechafin']);
                    

                    require rutaData.'empresaData.php';
                    $empresaData = new empresaData();
                    $data['servicios'] = $empresaData->obtenerEmpresaServicio($_POST['empresaid']);
                    $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());
                    $data['mensaje'] = 'Cupon creado correctamente';
                    unset($_SESSION['serviciosC']);
                    $this->vista->mostrar("insertarcupon.php", $data);
                }

            }else{
                $data['servicios'] = $empresaData->obtenerEmpresaServicio($_POST['empresaid']);
                $data['imagenes'] = $empresaData->obtenerImageneServicio($data['servicios']->getservicioid());
                $data['mensaje'] = 'Extension de imagen invalida';
                unset($_SESSION['serviciosC']);
                $this->vista->mostrar("insertarcupon.php", $data);
            }
        }   
    } // insert
        

    public function borrar(){
        require rutaData.'cuponData.php';
        $cuponData = new cuponData();
        
        if(isset($_GET['id'])){

            if($cuponData->borrar($_GET['id'])){
                $data['mensaje'] = 'Categoria eliminada correctamente';
            }else $data['mensaje'] = 'Error al eliminar la empresa';

        }else $data = null;
        
        
        $data['categorias'] = $cuponData->obtenerTodos();
        $this->vista->mostrar("insertarempresacategoria.php", $data);
    } // delete
    


    public function agregarServicio()
    {
        $servicio = $_POST['servicio'];
        $cont = 0;
        $encontro1 = 0;

        $cont = 0;
        foreach ($_SESSION['serviciosC'] as $se) {
            if ( $se == $servicio) {
                $encontro1 = 1;
            }
            $cont++;
        }

        if ($encontro1 == 0 ) {
            $_SESSION['serviciosC'][$cont] = $servicio;
            echo "Servicio agregado";
        } else {
            echo "Algunos de los valores ya fueron agregados";
        }
    }


    
} // OrderController

?>