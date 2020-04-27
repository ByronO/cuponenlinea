<!DOCTYPE html>

<?php
    $title = 'Agregar Categoria';
    include rutaVista.'header.php';
?>
    
<h1>Agregar Categoria</h1>

<form method="post" enctype="multipart/form-data" action="?controlador=Empresacategoria&accion=insertar">
    <?php include rutaVista . 'empresacategoriaformulario.php'; ?>
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
  include rutaVista.'mostrarempresacategorias.php'; 
?> 

<?php
    include rutaVista.'footer.php';
?>

