<table>
    <thead>
    <th>Código</th>
    <th>Telefono 1</th>
    <th>Telefono 2</th>
    <th>Correo</th>
    <th>Fax</th>
    </thead>
    
    <tbody>
<?php foreach($vars['contactocliente'] as $key => $value){ 
        if($value->getclientecontactoid() != 0){?>
            <tr>
                <td> 
                 <a href="?controlador=Clientecontacto&accion=actualizar&id=<?php echo $value->getclientecontactoid(); ?>">
                       <?php echo $value->getclientecontactoid()?>
                </a>
                </td>
                <td> <?php echo $value->getclientecontactotelefono1()?> </td>
                <td> <?php echo $value->getclientecontactotelefono2()?> </td>
                <td> <?php echo $value->getclientecontactocorreo()?> </td>
                <td> <?php echo $value->getclientecontactofax()?> </td>
         <td> <a href="?controlador=Clientecontacto&accion=borrar&id=<?php echo $value->getclientecontactoid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>
