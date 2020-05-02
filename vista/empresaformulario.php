<?php
if(isset($vars['empresa'])){
    $empresa = $vars['empresa'];
    
    $id = $empresa->getempresaid();
    $codigo = $empresa->getempresacodigo();
    $nombre = $empresa->getempresanombre();
    $ubicacion = $empresa->getempresaubicacion();
    $tipo = $empresa->getempresacategoria();
    $cedula = $empresa->getempresacedula();
    $sitio = $empresa->getempresasitioweb();

}else{
    $id = 0;
    $codigo = '';
    $nombre = '';
    $ubicacion = '';
    $tipo = '';
    $cedula = '';
    $sitio = '';
}
?>
<input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
<div>
    <label for="nombre">Nombre</label>
    <input required type="text" name="nombre" id="nombre" value="<?php echo $nombre?>"/>
</div>
<div>
    <label for="ubicacion">Ubicación</label>
    <input required type="text" name="ubicacion" id="ubicacion" value="<?php echo $ubicacion?>"/>
</div>
<div>
    <label for="tipo">Categoría</label>
    <select required id="tipo" name="tipo">
    <?php
    foreach($vars['categorias'] as $key => $value){ ?>
    <option value="<?php echo $value->getempresacategoriaacronimo(); ?>" <?php if($value->getempresacategoriaacronimo() == $tipo){ ?> selected <?php }?>> 
        <?php echo $value->getempresacategorianombre(); ?> 
    </option>
    <?php
    }
    ?>
</select>
  <a href="?controlador=Empresacategoria&accion=insertar"> Categorías </a>
</div>
<div>
    <label for="cedula">Cedula Juridica</label>
    <input required type="text" name="cedula" id="cedula" value="<?php echo $cedula?>"/>
</div>
<div>
    <label for="sitio">Sitio Web</label>
    <input required type="text" name="sitio" id="sitio" value="<?php echo $sitio?>"/>
</div>