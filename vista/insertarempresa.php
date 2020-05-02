<!DOCTYPE html>

<?php
    $title = 'Agregar Empresa';
    include rutaVista.'header.php';
?>
    
<h1>Agregar Empresa</h1>

<div class = "row">
    <div class= "col-sm-4">
        <h2>Datos básicos</h2>
        <form method="post" enctype="multipart/form-data" action="?controlador=Empresa&accion=insertar">
            <?php include rutaVista . 'empresaformulario.php'; ?>
            <input type="submit" value="Agregar" name="create" id="create"/>
        </form>
        <?php 
        if(!isset($vars))
            echo 'No hay vars';
        if (isset($vars['mensaje'])){
            echo '<p style="color: red">' . $vars['mensaje'] . '</p>';
        }
        ?>

        <br><br><br><br>
        <h3>Lista de empresas registradas</h3>
        <?php
            include rutaVista.'mostrarEmpresas.php';
        ?> 

    </div>

    <!-- SERVICIOS DE LA EMPRESA -->
    <div class="col-sm-3" style="text-align: center">
        <h2>Servicios brindados</h2>
        <div class="row">
            <div class="col-sm-6">
                <label for="criterio">Criterio</label><br>
                <input required type="text" name="criterio" id="criterio" value=""/>
            </div>
            <div class="col-sm-6">
                <label for="valor">Valor</label><br>
                <input required type="text" name="valor" id="valor" value=""/>
            </div>
        </div>
        <br>
        <input type="button" href="javascript:;"
        onclick="agregarServicio($('#criterio').val(), $('#valor').val());return false;" value="Añadir servicio">

        <p style="color: green" id="mensaje"></p>
        
        <br><br>
        <h3>Lista de servicios agregados</h3>
        <table>
            <thead>
            <th>Criterio</th>
            <th>Servicio</th>
            </thead>
            
            <tbody id="filas">
                <tr>
                </tr>
            </tbody>
        </table>


    </div>
    <!-------------------------------------------------->

   <!-------------------------------------------------->

      <!-- CONTACTOS DE LA EMPRESA -->
      <div class="col-sm-3" style="text-align: center">
        <h2>Contactos</h2>
        <div class="row">
            <div class="col-sm-6">
                <label for="criterioC">Criterio</label><br>
                <input required type="text" name="criterioC" id="criterioC" value=""/>
            </div>
            <div class="col-sm-6">
                <label for="valorC">Valor</label><br>
                <input required type="text" name="valorC" id="valorC" value=""/>
            </div>
        </div>
        <br>
        <input type="button" href="javascript:;"
        onclick="agregarContacto($('#criterioC').val(), $('#valorC').val());return false;" value="Añadir contacto">

        <p style="color: green" id="mensaje2"></p>
        
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
</div>






<?php
    include rutaVista.'footer.php';
?>

