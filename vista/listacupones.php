<!DOCTYPE html>

<?php
    $title = 'Lista cupones';
    include rutaVista.'header.php';
?>

<div class = "row">
    <div class= "col-sm-6">
        <div class="row">
            <h2>Orioridad al mostrar al cliente</h2>
            <div class="col-sm-3">
                <select class="form-control" style="width: 200px" name="prioridad" id="prioridad">
                    <option value="1">Cupones más cercanos</option>
                    <option value="2">Cupones más buscados</option>
                </select>
            </div>            
            <div class="col-sm-6">
                <input type="button" class="btn btn-success" onclick="establecerPrioridad($('#prioridad').val());return false;" value="Establecer"/>
            </div>
        </div>
        <br><p style="color: green" id="mensaje"></p>
        <h2>Lista de cupones</h2>
        <br><br>
        <table style="width: 100%">
            <thead>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Detalles</th>
                <th>Servicios</th>
                <th>Tipo</th>
                <th>Fecha Inicio</th>
                <th>Fechas fin</th>
                <th>Restricciones</th>
                <th>Precio</th>
                <th>Estado</th>
            </thead>
            
            <tbody id="filas" style="text-align: left">
                
                <?php 
                foreach($vars['cupones'] as $cupon){ 
                    ?>
                    <tr>
                        <td> <img src="<?php echo $cupon->getcuponrutaimagen() ?>" width="75" height="75"></td>
                        <td> <?php echo $cupon->getcuponnombre()?> </td>
                        <td> <?php echo $cupon->getcupondescripcion()?> </td>
                        <td> <?php echo $cupon->getcupondetallesadicionales()?> </td>
                        <td> <a href="?controlador=Cupon&accion=verServicios&id=<?php echo  $cupon->getcuponid(); ?>"><?php echo  $cupon->getserviciovalor(); ?></a></td>
                        <td> <?php echo $cupon->getcupontipo()?> </td>
                        <td> <?php echo $cupon->getcuponfechainicio()?> </td>
                        <td> <?php echo $cupon->getcuponfechafin()?> </td>
                        <td> <?php echo $cupon->getcuponrestricciones()?> </td>
                        <td> $<?php echo $cupon->getcuponprecio()?> </td>
                        <?php 
                            if($cupon->getcuponestado() == 1){
                        ?>
                                <td> Disponible </td>
                        <?php 
                            }else{
                        ?>
                           <td> No disponible </td>
                        <?php
                            }
                         ?>
                        <!-- <td> <a href="?controlador=Cupon&accion=eliminarServicio&criterio=<?php  ?>">Borrar</a></td> -->
                    </tr>
        <?php  } ?>
                
            </tbody>
            
        </table>
        <?php 
            if(!isset($vars))
                echo 'No hay vars';
            if (isset($vars['mensaje'])){
                echo '<p style="color: red">' . $vars['mensaje'] . '</p>';
            }
        ?>

    </div>
        <!-------------------------------------------------->

</div>