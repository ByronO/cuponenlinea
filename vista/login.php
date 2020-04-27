<!DOCTYPE html>

<?php
    $title = 'Log In';
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
            <?php if(isset($title)){ ?>
        <title> <?php echo $title; ?></title>
            <?php } else { ?>
        <title> Proyecto Gestión </title>
            <?php } ?>
    </head>
    <body>
    <a href="?controlador=Usuario&accion=loginView"> Iniciar Sesión </a>
    
<h1> Iniciar Sesión</h1>

<form method="post" enctype="multipart/form-data" action="?controlador=Usuario&accion=verificar">
    <div>
        <label for="usuario">Nombre de usuario</label>
        <input required type="text" name="usuario" id="usuario" />
    </div>
    <div>
        <label for="contra">Contraseña</label>
        <input required type="text" name="contra" id="contra" />
    </div>
    <input type="submit" value="Iniciar Sesion" name="create" id="create"/>
</form>

<?php 
if(!isset($vars))
    echo 'No hay vars';
if (isset($vars['mensaje'])){
    echo '<p style="color: red">' . $vars['mensaje'] . '</p>';
}

?>

<?php
    include rutaVista.'footer.php';
?>

