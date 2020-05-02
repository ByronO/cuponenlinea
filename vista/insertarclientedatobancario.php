
<!DOCTYPE html>
<a href="?controlador=Datobancario&accion=vistaprincipal"> Regresar </a>
<h1>Agregar Datos Dancarios</h1>
<?php
    $title = 'Agregar Datos Bancarios';
?>
    
<form method="post" enctype="multipart/form-data" action="?controlador=Datobancario&accion=insertardatobanco">
    <?php include rutaVista . 'clientedatobancarioformulario.php'; ?>
    <input type="submit" value="Agregar" name="create" id="create"/>
</form>

<?php
    include rutaVista.'footer.php';
?>

