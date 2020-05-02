<?php
include rutaVista.'header.php';
?>

<form method="post" action="?controlador=Empresa&accion=agregarImagenServicio" enctype="multipart/form-data">
<?php
    if(isset($vars['servicio'])){
        $servicio = $vars['servicio'];
        $id = $servicio->getservicioid();

    }else{
        $id = 0;
    }
    if(isset($vars['valor'])){
        $valor = $vars['valor'];

    }else{
        $valor = '';
    }
    ?>
    <h1>Agregar imagen al servicio <?php echo $valor ?> </h1>

    <input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
    <input required type="hidden" name="valor" id="valor" value="<?php echo $valor?>"/>
    
    <label>Seleccione la imágen</label>
    <input type="file" class="form-control" style="margin-bottom: 30px" accept="image/png, .jpeg, .jpg, image/gif" id="imagen" name="imagen">
    
    
    <input type="submit" value="Agregar imagen" name="update" id="update"/>
    </form>


<?php
include rutaVista.'footer.php';
?>

