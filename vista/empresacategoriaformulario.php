<?php
if(isset($vars['categoria'])){
    $empresa = $vars['categoria'];
    
    $id = $empresa->getempresacategoriaid();
    $codigo = $empresa->getempresacategoriacodigo();
    $nombre = $empresa->getempresacategorianombre();
    $acronimo = $empresa->getempresacategoriaacronimo();

}else{
    $id = 0;
    $codigo = '';
    $nombre = '';
    $acronimo='';
}
?>
<input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
<div>
    <label for="idcategoria">Codigo</label>
    <input required type="text" name="idcategoria" id="idcategoria" value="<?php echo $codigo?>"/>
</div>
<div>
    <label for="nombre">Nombre</label>
    <input required type="text" name="nombre" id="nombre" value="<?php echo $nombre?>"/>
</div>
<div>
    <label for="acronimo">Acrónimo</label>
    <input required type="text" name="acronimo" id="acronimo" value="<?php echo $acronimo?>"/>
</div>

