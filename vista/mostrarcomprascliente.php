
<!DOCTYPE html>
<a href="?controlador=Cliente&accion=inicio"> Regresar </a>
<h1>Ver compras Realizadas</h1>
<a href="?controlador=Reportes&accion=RankeoComprasRealizadasCliente"> Ver Graficas de Comprar Realizadas </a>
<?php
    $title = 'Ver compras Realizadas';
?>
<br><br>
<table>
    <thead>
    <th>Compra</th>
    <th>Cupón</th>
    <th>Cantidad</th>
    <th>Fecha Compra</th>
    </thead>
    
    <tbody>
<?php foreach($vars['compras'] as $key => $value){ 
        if($value->getclientecompracuponid() != 0){?>
            <tr>
                <td><?php echo $value->getclientecompracuponid()?></td>
                <td> <?php echo $value->getcuponid()?> </td>
                <td> <?php echo $value->getcantidadcupones()?> </td>
                <td> <?php echo $value->getfechaclientecompracupon()?> </td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>

<?php
    include rutaVista.'footer.php';
?>

