<!DOCTYPE html>

<?php
    $title = 'Agregar Empresa';
    include rutaVista.'header.php';
?>
    
<h1>Crear cupón</h1>

<div class = "row">
    <div class= "col-sm-4">
        <h2>Datos básicos</h2>
        <form method="post" enctype="multipart/form-data" action="?controlador=Cupon&accion=insertarCupon" enctype="multipart/form-data">
            <?php
                if(isset($vars['cupon'])){
                    $cupon = $vars['cupon'];
                    
                    $id = $cupon->getcuponid();
                    $empresaid = $cupon->getempresaid();
                    $nombre = $cupon->getcuponnombre();
                    $descripcion = $cupon->getcupondescripcion();
                    $detalles = $cupon->getcupondetalles();
                    $restricciones = $cupon->getcuponrestricciones();
                    $precio = $cupon->getcuponprecio();
                    $estado = $cupon->getcuponestado();
                    

                }else{
                    $id = 0;
                    $nombre = '';
                    $descripcion = '';
                    $detalles = '';
                    $restricciones = '';
                    $precio = '';
                    $estado = '';
                }
            ?>
            <input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
            <input required type="hidden" name="empresaid" id="empresaid" value="<?php echo $vars['servicios']->getempresaid()?>"/>

            <div>
                <label for="nombre">Nombre de cupón</label>
                <input required type="text" name="nombre" id="nombre" value="<?php echo $nombre?>"/>
            </div>
            <div>
                <label for="descripcion">Descripción</label>
                <input required type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion?>"/>
            </div>
            <div>
                <label for="detalles">Detalles</label>
                <input required type="text" name="detalles" id="detalles" value="<?php echo $detalles?>"/>
            </div>
            <div>
                <label for="restricciones">Restricciones</label>
                <input required type="text" name="restricciones" id="restricciones" value="<?php echo $restricciones?>"/>
            </div>
            <div>
                <label for="precio">Precio</label>
                <input required type="number" name="precio" id="precio" value="<?php echo $precio?>"/>
            </div>

            <label>Seleccione la imágen</label>
            <input require type="file" class="form-control" style="margin-bottom: 30px" accept="image/png, .jpeg, .jpg, image/gif" id="imagen" name="imagen">

            <input type="submit" value="Agregar" name="create" id="create"/>
        </form>
        <?php 
        if(!isset($vars))
            echo 'No hay vars';
        if (isset($vars['mensaje'])){
            echo '<p style="color: green">' . $vars['mensaje'] . '</p>';
        }
        ?>

            <br><br><br>
            <p style="color: green" id="mensaje2"></p>
            
            <h3>Lista de servicios agregados</h3>
            <table>
                <thead>
                <th>Servicio</th>
                </thead>
                
                <tbody id="filasC">
                </tbody>
            </table>

        
    </div>

    <!-- SERVICIOS DE LA EMPRESA -->
    <div class="col-sm-4" style="text-align: center">
        <h2>Servicios brindados por esta empresa</h2>
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
                            <td> Sin Imagen</td>
                        <?php
                            }
                         ?>
                        <td> <input type="button" href="javascript:;" onclick="agregarServicioCupon('<?php echo $vars['servicios']->getserviciovalor()[$cont]?>');return false;" value="Añadir al cupón"></td>
                    </tr>
            <?php   }
                    $cont ++;
                } ?>
            </tbody>
        </table>

    </div>
    <!-------------------------------------------------->

   <!-------------------------------------------------

      
    <div class="col-sm-3" style="text-align: center">
        <h2>Contactos</h2>
        <div class="row">
        </div>
        <br>
    </div>
</div>-->

<?php
    include rutaVista.'footer.php';
?>


