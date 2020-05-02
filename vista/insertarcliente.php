<!DOCTYPE html>
<a href="?controlador=Usuario&accion=Inicio"> Devuelta </a>
<?php
    $title = 'Agregar Cliente';
?>
    
<form method="post" enctype="multipart/form-data" action="?controlador=Cliente&accion=insertarclientenuevo">
    <?php include rutaVista . 'clientenuevoregistroformulario.php'; ?>
    <input type="submit" value="Agregar" name="create" id="create"/>
</form>


<?php
    include rutaVista.'footer.php';
?>

