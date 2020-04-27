<!DOCTYPE html>

<?php
    $title = 'Lista contactos Empresa';
    include rutaVista.'header.php';
?>
    
<div class = "row">
    <div class= "col-sm-3">
        <h2>Lista de contactos de la empresa</h2>
        <br><br>
        <table>
            <thead>

            <th>Criterio</th>
            <th>Contacto</th>
            </thead>
            
            <tbody id="filas">
                <?php 
                $cont = 0;
                foreach($vars['contactos']->getempresacontactocriterio() as $value){ 
                    if($vars['contactos']->getempresacontactocriterio()[$cont] != ""){
                    ?>
                    <tr>
                        <td> <?php echo $vars['contactos']->getempresacontactocriterio()[$cont]?> </td>
                        <td> <?php echo $vars['contactos']->getempesacontactovalor()[$cont]?> </td>
                        <td> <a href="?controlador=Empresa&accion=eliminarContacto&criterio=<?php echo $vars['contactos']->getempresacontactocriterio()[$cont]; ?>">Borrar</a></td>
                    </tr>
            <?php   }
                    $cont ++;
                } ?>
            </tbody>
        </table>
        <?php 
            if(!isset($vars))
                echo 'No hay vars';
            if (isset($vars['mensaje2'])){
                echo '<p style="color: red">' . $vars['mensaje2'] . '</p>';
            }
        ?>

    </div>

    <!-- SERVICIOS DE LA EMPRESA -->
    <div class="col-sm-3" style="text-align: center">
        <h2>Agregar contactos brindados</h2>
        <form method="post" enctype="multipart/form-data" action="?controlador=Empresa&accion=actualizarServicios">
            <div class="row">
                <div class="col-sm-6">
                    <label for="criterioNC">Criterio</label><br>
                    <input required type="text" name="criterioNC" id="criterioNC" value=""/>
                </div>
                <div class="col-sm-6">
                    <label for="valorNC">Valor</label><br>
                    <input required type="text" name="valorNC" id="valorNC" value=""/>
                </div>
            </div>
            <br>
            <input type="button" href="javascript:;"
            onclick="actualizarServicios($('#criterioNC').val(), $('#valorNC').val());return false;" value="Añadir contacto">
            <!--<input type="submit" value="Añadir servicio" name="agregar" id="agregar"/>
                -->
        </form>

            <p style="color: green" id="mensaje2"></p>
            
            <br><br>
            <h3>Lista de contactos agregados</h3>
            <table>
                <thead>
                <th>Criterio</th>
                <th>Contacto</th>
                </thead>
                
                <tbody id="filasNC">
                    <tr>
                    </tr>
                </tbody>
            </table>


        </div>
        <!-------------------------------------------------->

    </div>