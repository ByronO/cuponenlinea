<table>
    <thead>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Ubicación</th>
    <th>Tipo</th>
    </thead>
    
    <tbody>
<?php foreach($vars['empresas'] as $key => $value){ 
        if($value->getempresacodigo() != 0){?>
            <tr>
                <td> 
                    <a href="?controlador=Empresa&accion=actualizar&id=<?php echo $value->getempresaid(); ?>">
                        <?php echo $value->getempresacodigo()?>
                    </a>
                </td>
                <td> <?php echo $value->getempresanombre()?> </td>
                <td> <?php echo $value->getempresaubicacion()?> </td>
                <td> <?php echo $value->getempresatipo()?> </td>
                <td> <a href="?controlador=Empresa&accion=obtenerServiciosEmpresa&id=<?php echo $value->getempresaid(); ?>">Servicios</a> </td>
                <td> <a href="?controlador=Empresa&accion=obtenerContactosEmpresa&id=<?php echo $value->getempresaid(); ?>">Contactos</a> </td>
                <td> <a href="?controlador=Empresa&accion=borrar&id=<?php echo $value->getempresaid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>