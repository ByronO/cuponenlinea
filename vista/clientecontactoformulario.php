<?php
if(isset($vars['contactocliente1'])){
    $clientecontacto = $vars['contactocliente1'];
    
    $id = $clientecontacto->getclientecontactoid();
    $telefono1 = $clientecontacto->getclientecontactotelefono1();
    $telefono2 = $clientecontacto->getclientecontactotelefono2();
    $correo = $clientecontacto->getclientecontactocorreo();
    $fax = $clientecontacto->getclientecontactofax();

}else{
    $id = 0;
    $telefono1 = '';
    $telefono2 = '';
    $correo='';
    $fax='';
}
?>
<input required type="hidden" name="id" id="id" value="<?php echo $id?>"/>
<div>
    <label for="tel1">Telefono 1</label>
    <input required type="text" name="tel1" id="tel1" value="<?php echo $telefono1?>"/>
</div>
<div>
    <label for="tel2">Telefono 2</label>
    <input required type="text" name="tel2" id="tel2" value="<?php echo $telefono2?>"/>
</div>
<div>
    <label for="correo">Correo Electrónico</label>
    <input required type="text" name="correo" id="correo" value="<?php echo $correo?>"/>
</div>
<div>
    <label for="fax">FAX</label>
    <input required type="text" name="fax" id="fax" value="<?php echo $fax?>"/>
</div>