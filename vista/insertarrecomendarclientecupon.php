<!DOCTYPE html>

<?php
    $title = 'Agregar Recomendar Cupon';
?>
<a href="?controlador=Clientecontacto&accion=vistaprincipal"> Regresar </a>
    
<h1>Recomendar Cupón</h1>

<form method="post" enctype="multipart/form-data" action="?controlador=Cliente&accion=clienterecomendarcupon">
    <?php include rutaVista . 'recomendarclientecuponformulario.php'; ?>
    <input type="submit" value="Enviar Cupón" name="create" id="create"/>
</form>

<?php
  include rutaVista.'mostrarrecomendarclientecupon.php'; 
?> 

<?php
    include rutaVista.'footer.php';
?>

