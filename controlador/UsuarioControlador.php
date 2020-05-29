<?php
session_start();


class UsuarioControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function Inicio()
    {
        require rutaData.'usuarioData.php';
        $usuarioData = new usuarioData();

        $usuarioData->eliminarClienteSession($_SESSION['count']);

        unset($_SESSION['count']);
        unset($_SESSION['criterios']);
        unset($_SESSION['servicios']);
        unset($_SESSION['promedio']);

        


        $this->vista->mostrar('inicio.php', null);
        
    }
    public function login(){
        $data['mensaje'] = '';
        $this->vista->mostrar("login.php", $data);
    }

    public function insertar(){
        require rutaData.'clienteData.php';
        $empresacategoriaData = new clienteData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['usuario']) && isset($_POST['contra'])){
               
        $empresa = new clientenuevo(0,$_POST['usuario'],$_POST['contra'],1,0,0);
                
                if($empresacategoriaData->insertar($empresa)){
                    $data['mensaje'] = 'Categoria creada correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
        
    } // insert

    public function verificar(){

        require rutaData.'usuarioData.php';
        $usuarioData = new usuarioData();

        

        if(isset($_POST['create'])){
            if(isset($_POST['usuario']) && isset($_POST['contra'])){
                
                $usuario = new usuario($_POST['usuario'], $_POST['contra']);
              
                
                if(is_numeric($usuarioData->verificar($usuario)[0])){
                      require_once rutaData . 'empresacategoriaData.php';
                      $empresacategoriaData = new empresacategoriaData();

                    $data['categorias'] = $empresacategoriaData->obtenerTodos();
                    $data['empresas'] = $usuarioData->obtenerTodos();
                    $this->vista->mostrar("insertarempresa.php", $data);
                }
                elseif(is_numeric($usuarioData->verificarcliente($usuario)[0])) {
                    $data['usuarioinicio'] = $usuarioData->verificarcliente($usuario);   
                    $clienteconfir = implode(" ", $data['usuarioinicio']);
                    $_SESSION['count'] = $clienteconfir;

                    require rutaData.'cuponData.php';
                    $cuponData = new cuponData();

                    $data['cupones'] = $cuponData->obtenerTodosFiltrado();

                    $_SESSION['promedio'] = $cuponData->obtenerPromedioPreciosCupon();

                    //CREA LA SESSION DEL USUARIO EN LA TABLA
                    $usuarioData->crearClienteSession($_SESSION['count']);

                     /////////
                    $data['datosS'] = $usuarioData->obtenerDatosSession();
                    /////////
                    
                    $data['mensaje'] = '';
                    $this->vista->mostrar("clientevistaprincipal.php", $data);
                }else {

                    $data['mensaje'] = 'Datos incorrectos';
                    $this->vista->mostrar("login.php", $data);
                
            }
            }else $data = null;
        }else $data = null;
    } // insert
} // OrderController

?>