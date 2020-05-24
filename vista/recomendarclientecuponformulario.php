
<div>
    <label for="clientereceptorid">¿A quien vamos a Recomendar?</label>
    <select required id="clientereceptorid" name="clientereceptorid">
    <?php
    foreach($vars['clientesAmigos'] as $key => $value){ ?>
    <option value="<?php echo $value->getclienteid(); ?>" <?php { ?> selected <?php }?>> 
        <?php echo $value->getclientecorreo(); ?> 
    </option>
    <?php
    }
    ?>
</select>
</div>

<div>
    <label for="cuponrecomendadoid">Cupón a Recomendar</label>
    <select required id="cuponrecomendadoid" name="cuponrecomendadoid">
    <?php
    foreach($vars['cuponesrecomendar'] as $key => $value){ ?>
    <option value="<?php echo $value->getcuponid(); ?>" <?php { ?> selected <?php }?>> 
        <?php echo $value->getcuponnombre(); ?> 
    </option>
    <?php
    }
    ?>
</select>
</div>