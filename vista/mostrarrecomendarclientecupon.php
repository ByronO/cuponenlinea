<table>
    <thead>
    <th>Cupones que me han Recomendado</th>
    <th>Amigo que me lo recomendó</th>
    </thead>
    
    <tbody>
<?php foreach($vars['cuponesrecomendados'] as $key => $value){ 
        if($value->getclienterecomendarcuponid() != 0){?>
            <tr>
                <td> <?php echo $value->getcuponrecomendadoid()?> </td>
                <td> <?php echo $value->getclienteemisorid()?> </td>
           </tr>
<?php   }
    } ?>
    </tbody>
</table>