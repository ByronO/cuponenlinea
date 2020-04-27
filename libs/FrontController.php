<?php

    class FrontController{
        
        static function main(){
            require 'libs/View.php';
            require 'libs/Constantes.php';
            
            if(!empty($_GET['controlador']))
                $nombreControlador=$_GET['controlador'].'Controlador';
            else 
                $nombreControlador='UsuarioControlador';
            
            if(!empty($_GET['accion']))
                $nombreAccion=$_GET['accion'];
            else 
                $nombreAccion='Inicio';
            
            $rutaControlador = rutaControlador . $nombreControlador.'.php';
            
            if(is_file($rutaControlador))
                require $rutaControlador;
            else
                die('Controlador '.$rutaControlador. ' no encontrado - 404 not found');
            
            if(is_callable(array($nombreControlador, $nombreAccion))==FALSE){
                trigger_error($nombreControlador.'->'.$nombreAccion.' no existe', E_USER_NOTICE);
                return FALSE;
            }
            
            $controlador=new $nombreControlador();
            $controlador->$nombreAccion();
            
        } // main
        
    } // fin de clase 

?>