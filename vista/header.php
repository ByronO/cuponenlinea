<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

        <script type="text/javascript" src="publico/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="publico/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

            <?php if(isset($title)){ ?>
        <title> <?php echo $title; ?></title>
            <?php } else { ?>
        <title> Proyecto Gestion </title>
            <?php } ?>
    </head>
    <body>
        <a href="?controlador=Empresa&accion=insertar"> Empresa </a>
        <a href="?controlador=Usuario&accion=Inicio"> Cerrar Sesión </a>
        




