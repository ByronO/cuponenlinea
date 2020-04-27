<?php
session_start();
class UsuarioControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function Inicio()
    {

        unset($_SESSION['criterios']);
        unset($_SESSION['servicios']);
        $this->vista->mostrar('inicio.php', null);
        
    }

    public function login(){
        $data['mensaje'] = '';
        $this->vista->mostrar("login.php", $data);

    }


    /*public function verificar(){
        require rutaData.'UsuarioData.php';
        $usuarioData = new usuarioData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['usuario']) && isset($_POST['contra'])){
                
                $usuario = new usuario($_POST['usuario'], $_POST['contra']);
                
                if(is_numeric($usuarioData->verificar($usuario)[0])){
                    $data['empresas'] = $usuarioData->obtenerTodos();
        
                    $this->vista->mostrar("insertarempresa.php", $data);
                }else {
                    $data['mensaje'] = 'Datos incorrectos';
                    $this->vista->mostrar("login.php", $data);
                }
            }else $data = null;
        }else $data = null;
    } // insert
*/
    public function verificar(){
        require rutaData.'UsuarioData.php';
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
                }else {
                    $data['mensaje'] = 'Datos incorrectos';
                    $this->vista->mostrar("login.php", $data);
                }
            }else $data = null;
        }else $data = null;
    } // insert
} // OrderController

?>