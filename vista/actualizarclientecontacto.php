<?php

?>

<h1>Actualizar Contacto</h1>

<form method="post" action="?controlador=Clientecontacto&accion=actualizar">
    <?php
    include rutaVista.'clientecontactoformulario.php';
    ?>
    <input type="submit" value="Actualizar" name="update" id="update"/>
</form>

<?php 
if(!isset($vars))
    echo 'No hay vars';
if (isset($vars['mensaje'])){
    echo '<p style="color: red">' . $vars['mensaje'] . '</p>';
}
?>

<?php
include rutaVista.'footer.php';
?>

