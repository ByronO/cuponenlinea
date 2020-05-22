<a href="?controlador=Usuario&accion=Inicio"> Cerrar Sesión </a>
<a href="?controlador=Cliente&accion=vistadatobanco"> Registrar Datos Bancarios </a>
<a href="?controlador=Clientecontacto&accion=vistainsertarcontactos"> Ingresar Contacto </a>
<a href="?controlador=Cliente&accion=vistarecomendarclientecupon"> Recomendar Cupones </a>

<table>
    <thead>
    <th>Banco</th>
    <th>Tarjeta</th>
    <th>Fecha de inscripción</th>
    </thead>
    
    <tbody>
<?php foreach($vars['cuentas'] as $key => $value){ 
        if($value->getclientedatobancarioid() != 0){?>
            <tr>
                <td><?php echo $value->getclientedatobancariobanco()?></td>
                <td> <?php echo $value->getclientedatobancarionumerotarjeta()?> </td>
                <td> <?php echo $value->getclientedatobancariofechainscripcion()?> </td>
         <td> <a href="?controlador=Datobancario&accion=borrar&id=<?php echo $value->getclientedatobancarioid(); ?>">Borrar</a></td>
            </tr>
<?php   }
    } ?>
    </tbody>
</table>