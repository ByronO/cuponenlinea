<table>
    <thead>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Acronimo</th>
    </thead>
    
    <tbody>
<?php foreach($vars['categorias'] as $key => $value){ 
        if($value->getempresacategoriacodigo() != 0){?>
            <tr>
                <td> 
                 <a href="?controlador=Empresacategoria&accion=actualizar&id=<?php echo $value->getempresacategoriaid(); ?>">
                       <?php echo $value->getempresacategoriacodigo()?>
                </a>
                </td>
                <td> <?php echo $value->getempresacategorianombre()?> </td>
                <td> <?php echo $value->getempresacategoriaacronimo()?> </td>
         <td> <a href="?controlador=Empresacategoria&accion=borrar&id=<?php echo $value->getempresacategoriaid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>