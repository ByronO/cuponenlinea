<?php

class EmpresacategoriaControlador{
    
    private $vista;
    
    public function __construct() {
        $this->vista=new View();
    } // constructor
    
    public function insertar(){
        require rutaData.'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();
        
        if(isset($_POST['create'])){
            if(isset($_POST['idcategoria']) && isset($_POST['nombre'])){
               
        $empresa = new empresacategoria(0,$_POST['idcategoria'],1, $_POST['nombre']);
                
                if($empresacategoriaData->insertar($empresa)){
                    $data['mensaje'] = 'Categoria creada correctamente';
                }else $data['mensaje'] = 'Error al insertar';
                
            }else $data = null;
        }else $data = null;
        
       $data['categorias'] = $empresacategoriaData->obtenerTodos();
        
        $this->vista->mostrar("insertarempresacategoria.php", $data);
    } // insert
    

    public function actualizar(){
        require rutaData.'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();
        
        if(isset($_POST['id']) && isset($_POST['idcategoria']) && isset($_POST['nombre'])){

        $empresacategoria = new empresacategoria($_POST['id'], $_POST['idcategoria'],1, $_POST['nombre']);

            if($empresacategoriaData->actualizar($empresacategoria)){
                $data['mensaje'] = 'Categoria actualizada correctamente';
            }else $data['mensaje'] = 'Error al actualizar la Categoria';

        }else $data = null;
        
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        
        $data['categoria'] = $empresacategoriaData->obtenerempresaId($id);
        
        $this->vista->mostrar("actualizarcategoriaempresa.php", $data);
    } // update
    

    public function borrar(){
        require rutaData.'empresacategoriaData.php';
        $empresacategoriaData = new empresacategoriaData();
        
        if(isset($_GET['id'])){

            if($empresacategoriaData->borrar($_GET['id'])){
                $data['mensaje'] = 'Categoria eliminada correctamente';
            }else $data['mensaje'] = 'Error al eliminar la empresa';

        }else $data = null;
        
        
        $data['categorias'] = $empresacategoriaData->obtenerTodos();
        $this->vista->mostrar("insertarempresacategoria.php", $data);
    } // delete
    
    
} // OrderController

?>