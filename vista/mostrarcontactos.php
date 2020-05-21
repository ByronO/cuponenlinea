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
                        <td> <?php echo $vars['contactos']->getempresacontactovalor()[$cont]?> </td>
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

    <!-- CONTACTOS DE LA EMPRESA -->
    <div class="col-sm-3" style="text-align: center">
        <h2>Agregar contacto brindados</h2>
        <form method="post" enctype="multipart/form-data" action="?controlador=Empresa&accion=actualizarContactos">
            <div class="row">
                <div class="col-sm-6">
                    <label for="criterioC">Criterio</label><br>
                    <input type="text" name="criterioC" id="criterioC" value=""/>
                </div>
                <div class="col-sm-6">
                    <label for="valor">Valor</label><br>
                    <input type="text" name="valor" id="valorC" value=""/>
                </div>
            </div>
            <br>
            <input type="button" href="javascript:;"
            onclick="actualizarContactos($('#criterioC').val(), $('#valorC').val());return false;" value="Añadir contacto">
            <br><br>
            
            <input type="submit" value="Agregar contactos" name="agregar" id="agregar"/>
            
        </form>

            <p style="color: green" id="mensaje"></p>
            
            <br><br>
            <h3>Lista de contactos agregados</h3>
            <table>
                <thead>
                <th>Criterio</th>
                <th>Contacto</th>
                </thead>
                
                <tbody id="filasC">
                    <tr>
                    </tr>
                </tbody>
            </table>


        </div>
        <!-------------------------------------------------->

    </div>