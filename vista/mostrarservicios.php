<!DOCTYPE html>

<?php
    $title = 'Lista servicios Empresa';
    include rutaVista.'header.php';
?>
    
<div class = "row">
    <div class= "col-sm-3">
        <h2>Lista de servicios de la empresa</h2>
        <br><br>
        <table style="width: 100%">
            <thead>

            <th>Criterio</th>
            <th>Servicio</th>
            <th>Imagen</th>
            </thead>
            
            <tbody id="filas" style="text-align: left">
                <?php 
                $cont = 0;
                $encontro = 0;
                foreach($vars['servicios']->getserviciocriterio() as $value){ 
                    $encontro = 0;
                    if($vars['servicios']->getserviciocriterio()[$cont] != ""){
                    ?>
                    <tr>
                        <td> <?php echo $vars['servicios']->getserviciocriterio()[$cont]?> </td>
                        <td> <?php echo $vars['servicios']->getserviciovalor()[$cont]?> </td>
                        <?php 
                            foreach($vars['imagenes'] as $imagen){
                                if($vars['servicios']->getserviciovalor()[$cont] == $imagen->getserviciovalor()){
                                    $encontro = 1;
                        ?>
                                    <td> <img src="<?php echo $imagen->getruta() ?>" width="75" height="75"></td>
                        <?php 
                                }
                            }
                            if($encontro == 0){
                        ?>
                            <td> <a href="?controlador=Empresa&accion=agregarImagen&valor=<?php echo $vars['servicios']->getserviciovalor()[$cont]; ?>">Agregar Imagen</a></td>
                        <?php
                            }
                         ?>
                        <td> <a href="?controlador=Empresa&accion=eliminarServicio&criterio=<?php echo $vars['servicios']->getserviciocriterio()[$cont]; ?>">Borrar</a></td>
                    </tr>
            <?php   }
                    $cont ++;
                } ?>
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

    <!-- SERVICIOS DE LA EMPRESA -->
    <div class="col-sm-3" style="text-align: center">
        <h2>Agregar servicios brindados</h2>
        <form method="post" enctype="multipart/form-data" action="?controlador=Empresa&accion=actualizarServicios">
            <div class="row">
                <div class="col-sm-6">
                    <label for="criterio">Criterio</label><br>
                    <input type="text" name="criterio" id="criterioN" value=""/>
                </div>
                <div class="col-sm-6">
                    <label for="valor">Valor</label><br>
                    <input type="text" name="valor" id="valorN" value=""/>
                </div>
            </div>
            <br>
            <input type="button" href="javascript:;"
            onclick="actualizarServicios($('#criterioN').val(), $('#valorN').val());return false;" value="Añadir servicio">
            <br><br>
            
            <input type="submit" value="Agregar servicios" name="agregar" id="agregar"/>
            
        </form>

            <p style="color: green" id="mensaje"></p>
            
            <br><br>
            <h3>Lista de servicios agregados</h3>
            <table>
                <thead>
                <th>Criterio</th>
                <th>Servicio</th>
                </thead>
                
                <tbody id="filasN">
                    <tr>
                    </tr>
                </tbody>
            </table>


    </div>
        <!-------------------------------------------------->

</div>