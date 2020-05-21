<script src="jquery-2.2.3.min.js" type="text/javascript"></script>

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
    <label for="ubicacionprovincia">Seleccione provincia</label>
    <select name="provincias" id="provincias">
        <option value=0>Seleccione provincia
        
        
        </option>
    </select>
</div>
<div>
    <label for="ubicacioncanton">Seleccione cantón</label>
    <select id="canton" name="canton"></select>
</div>
<div>
    <label for="ubicaciondistrito">Seleccione distrito</label>
    <select id="distrito" name="distrito"></select>
</div>
<div>
    <label for="otrassenas">Otras señas</label>
    <input required type="text" name="otrassenas" id="otrassenas" value=""/>
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