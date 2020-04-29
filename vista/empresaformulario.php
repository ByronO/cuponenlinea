<?php
if(isset($vars['empresa'])){
    $empresa = $vars['empresa'];
    
    $id = $empresa->getempresaid();
    $codigo = $empresa->getempresacodigo();
    $nombre = $empresa->getempresanombre();
    $ubicacion = $empresa->getempresaubicacion();
    $tipo = $empresa->getempresacategoria();

}else{
    $id = 0;
    $codigo = '';
    $nombre = '';
    $ubicacion = '';
    $tipo = '';
}
?>
<input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
<div>
    <label for="idempresa">Codigo</label>
    <input required type="text" name="idempresa" id="idempresa" value="<?php echo $codigo?>"/>
</div>
<div>
    <label for="nombre">Nombre</label>
    <input required type="text" name="nombre" id="nombre" value="<?php echo $nombre?>"/>
</div>
<div>
    <label for="ubicacion">Ubicación</label>
    <input required type="text" name="ubicacion" id="ubicacion" value="<?php echo $ubicacion?>"/>
</div>
<div>
    <label for="tipo">Categorías</label>
    <select required id="tipo" name="tipo">
    <?php
    foreach($vars['categorias'] as $key => $value){ ?>
        <option value="<?php echo $value->getempresacategorianombre(); ?>" <?php if($value->getempresacategorianombre() == $tipo){ ?> selected <?php }?>> 
        <?php echo $value->getempresacategorianombre(); ?> 
    </option>
    <?php
    }
    ?>
</select>
  <a href="?controlador=Empresacategoria&accion=insertar"> Categorías </a>
</div>