
<!DOCTYPE html>
<a href="?controlador=Datobancario&accion=vistaprincipal"> Regresar </a>
<h1>Agregar Datos Dancarios</h1>
<?php
    $title = 'Agregar Datos Bancarios';
?>
    
<form method="post" enctype="multipart/form-data" action="?controlador=Datobancario&accion=insertardatobanco">
    <?php include rutaVista . 'clientedatobancarioformulario.php'; ?>
    <input type="submit" value="Agregar" name="create" id="create"/>

    <br><br>
<table>
    <thead>
    <th>Banco</th>
    <th>Tarjeta</th>
    <th>Fecha de inscripción</th>
    </thead>
    
    <tbody>
<?php foreach($vars['cuentas'] as $key => $value){ 
        if($value->getclientedatobancarioid() != 0){?>
            <tr>
                <td><?php echo $value->getclientedatobancariobanco()?></td>
                <td> <?php echo $value->getclientedatobancarionumerotarjeta()?> </td>
                <td> <?php echo $value->getclientedatobancariofechainscripcion()?> </td>
         <td> <a href="?controlador=Datobancario&accion=borrar&id=<?php echo $value->getclientedatobancarioid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>
</form>

<?php
    include rutaVista.'footer.php';
?>

