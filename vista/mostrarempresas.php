<table>
    <thead>
    <th>CodigoEmpre</th>
    <th>Nombre</th>
    <th>Ubicación</th>
    <th>Categoria</th>
    <th>Cedula Juridica</th>
    <th>Sitio Web</th>
    </thead>
    
    <tbody>
<?php foreach($vars['empresas'] as $key => $value){ 
        if($value->getempresacodigo() != null){?>
            <tr>
                <td> 
                    <a href="?controlador=Empresa&accion=actualizar&id=<?php echo $value->getempresaid(); ?>">
                        <?php echo $value->getempresacodigo()?>
                    </a>
                </td>
                <td> <?php echo $value->getempresanombre()?> </td>
                <td> <?php echo $value->getempresaubicacion()?> </td>
                <td> <?php echo $value->getempresacategoria()?> </td>
                <td> <?php echo $value->getempresacedula()?> </td>
                <td> <?php echo $value->getempresasitioweb()?> </td>
                <td> <a href="?controlador=Empresa&accion=obtenerServiciosEmpresa&id=<?php echo $value->getempresaid(); ?>">Servicios</a> </td>
                <td> <a href="?controlador=Empresa&accion=obtenerContactosEmpresa&id=<?php echo $value->getempresaid(); ?>">Contactos</a> </td>
                <td> <a href="?controlador=Cupon&accion=insertar&id=<?php echo $value->getempresaid(); ?>">Agregar cupón</a> </td>
                <td> <a href="?controlador=Empresa&accion=borrar&id=<?php echo $value->getempresaid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>