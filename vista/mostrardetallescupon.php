<!DOCTYPE html>
<?php
    $title = 'Inicio';
?>
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


<a href="?controlador=Cliente&accion=inicio"> Inicio </a>
<a href="?controlador=Usuario&accion=Inicio"> Cerrar Sesión </a>

<?php 
    $cupon = $vars['cupon'];
    $empresa = $vars['empresa'];
?>
<center>
<h2><?php echo $cupon->getcuponnombre()?></h2>

<br><br>
</center>

<section id="pricing" class="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6" >
                <div >
                    <div class="row">
                        <div class="col-sm-7">
                            <img src="<?php echo $cupon->getcuponrutaimagen() ?>" class="responsive" style="border-radius: 5px" width="100%" height="400px" >

                            <h3>Descripción:  </h3>
                            <h4  ALIGN="justify"><?php echo $cupon->getcupondescripcion()?> tan pronto sea posible, andate para Jacó y relajate pasándola genial en la playa y todas sus actividades que esta zona te ofrece con un 60% de descuento en Jaco Lodge.

                                Jaco Lodge se ubica en el soleado y alegre destino de Jacó Beach en el Pacífico, a 10 minutos caminando de la playa y el centro de la localidad. Disfrutá de un hospedaje para 2 personas en una habitación con cama King size,
                                 aire acondicionado, TV por cable, mini refrigerador y baño privado. Además, obtendrás un brazalete con beneficios y accesos gratis al Club de Playa Jaco Blú por un grandioso precio de sólo ₡19.879. No esperés más, comprá este Titicupon con vigencia hasta por  6 meses.</h4>

                            <br>

                            <h3>Detalles adicionales:  </h3>
                            <h4  ALIGN="justify"><?php echo $cupon->getcupondetallesadicionales()?>, el hotel cuenta con piscina, parqueo gratuito sin necesidad de reservar y Wi-Fi de cortesía, permite el ingreso de mascotas con un costo adicional de ₡10.000 por una o dos noches, y ₡2.500 por noche adicional.</h4>
                            <br>

                            <h3>Restricciones:  </h3>
                            <h4  ALIGN="justify"><?php echo $cupon->getcuponrestricciones()?> </h4>
                            <br>

                        </div>
                        <div class="col-sm-5">

                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>Tipo de cupón  </h3>
                                    <h4><?php echo $cupon->getcupontipo()?></h4>
                                </div>
                                <div class="col-sm-5">
                                    <h3>Precio </h3>
                                    <h4>$<?php echo $cupon->getcuponprecio()?></h4>
                                </div>
                            </div>
                            
                            <h3>Lo que necesitas saber: </h3>
                            <h4>Periodo para usar tu cupón:</h4>
                             <h4>Del <?php echo $cupon->getcuponfechainicio()?> al <?php echo $cupon->getcuponfechafin()?></h4>

                            <br>
                            <h4>Empresa: <?php echo $empresa->getempresanombre()?></h4>
                            <h4>Dirección: <?php echo $empresa->getempresaubicacion() . ', '. $empresa->getempresaotrassenas()?></h4>
                            <h4>Conoce más en: <a href=""><?php echo $empresa->getempresasitioweb()?></a></h4>

                            <br>
                            <h3>Servicios incluidos: </h3>
                            
                            <?php 
                            $cont = 0;
                            $encontro = 0;
                            foreach($vars['cupon']->getserviciovalor() as $value){ 
                                $encontro = 0;
                                if($vars['cupon']->getserviciovalor()[$cont] != ""){
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                    <br><h3><?php echo $vars['cupon']->getserviciovalor()[$cont]?></h3> </div>
                                    <?php 
                                        foreach($vars['imagenes'] as $imagen){
                                            if($vars['cupon']->getserviciovalor()[$cont] == $imagen->getserviciovalor()){
                                                $encontro = 1;
                                    ?>
                                                <div class="col-sm-6"> <img class="responsive" style="border-radius: 5px" width="100%" height="120px" src="<?php echo $imagen->getruta() ?>"></div>
                                                
                                    <?php 
                                            }
                                        }
                                        if($encontro == 0){
                                    ?>
                                        <div class="col-sm-6">Sin Imagen</a></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <br>
                            <?php   }
                                $cont ++;
                            } ?>

                            <form method="post" enctype="multipart/form-data" action="?controlador=Cupon&accion=insertarcompracupon">
                            <label for="cantidadcupones">Cantidad a comprar: </label>
                            <input required type="number" name="cantidadcupones" id="cantidadcupones" value="1"/>
                            <input required type="text" name="idcuponcompra" id="idcuponcompra" style="display: none" value="<?php echo $cupon->getcuponid()?>"/>
                            <input class="btn-success form-control" style="width = 40%; margin-top: 15px; text-align:center" type="submit" value="Comprar Ahora!" name="create" id="create"/>
                            </form>
                            
                            <br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Pricing Section -->
