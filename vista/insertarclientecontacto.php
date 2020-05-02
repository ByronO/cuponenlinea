<!DOCTYPE html>

<?php
    $title = 'Agregar Contacto';
   
?>
    
<a href="?controlador=Clientecontacto&accion=vistaprincipal"> Regresar </a>
<h1>Agregar Contacto</h1>

<form method="post" enctype="multipart/form-data" action="?controlador=Clientecontacto&accion=insertar">
    <?php include rutaVista . 'clientecontactoformulario.php'; ?>
    <input type="submit" value="Agregar" name="create" id="create"/>
</form>

<?php 
if(!isset($vars))
    echo 'No hay vars';
if (isset($vars['mensaje'])){
    echo '<p style="color: red">' . $vars['mensaje'] . '</p>';
}

?>

<?php
  include rutaVista.'mostrarclientecontacto.php'; 
?> 

<?php
    include rutaVista.'footer.php';
?>
