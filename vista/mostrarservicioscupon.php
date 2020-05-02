<!DOCTYPE html>

<?php
    $title = 'Lista servicios Empresa';
    include rutaVista.'header.php';
?>
    
<div class = "row">
    <div class= "col-sm-6">
        <h2>Lista de servicios del cupon <?php echo $vars['cupon']->getcuponnombre()?> </h2>
        <br><br>
        <table style="width: 50%">
            <thead>
            <th>Servicio</th>
            <th>Imagen</th>
            </thead>
            
            <tbody id="filas" style="text-align: left">
                <?php 
                $cont = 0;
                $encontro = 0;
                foreach($vars['cupon']->getserviciovalor() as $value){ 
                    $encontro = 0;
                    if($vars['cupon']->getserviciovalor()[$cont] != ""){
                    ?>
                    <tr>
                        <td> <?php echo $vars['cupon']->getserviciovalor()[$cont]?> </td>
                        <?php 
                            foreach($vars['imagenes'] as $imagen){
                                if($vars['cupon']->getserviciovalor()[$cont] == $imagen->getserviciovalor()){
                                    $encontro = 1;
                        ?>
                                    <td> <img src="<?php echo $imagen->getruta() ?>" width="75" height="75"></td>
                        <?php 
                                }
                            }
                            if($encontro == 0){
                        ?>
                            <td>Sin Imagen</a></td>
                        <?php
                            }
                         ?>
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

    
        <!-------------------------------------------------->

</div>