<!DOCTYPE html>
<?php
    $title = 'Inicio';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

        <script type="text/javascript" src="publico/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="publico/js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery.js"></script>
            <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
        <script src="http://code.highcharts.com/stock/highstock.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

            <?php if(isset($title)){ ?>
        <title> <?php echo $title; ?></title>
            <?php } else { ?>
        <title> Proyecto Gestion </title>
            <?php } ?>
    </head>
    <body>


<a href="?controlador=Cliente&accion=inicio"> Inicio </a>
<a href="?controlador=Cliente&accion=vistadatobanco"> Registrar Datos Bancarios </a>
<a href="?controlador=Clientecontacto&accion=vistainsertarcontactos"> Ingresar Contacto </a>
<a href="?controlador=Cupon&accion=vistacomprascliente"> Ver Compras Realizadas </a>
<a href="?controlador=Cliente&accion=vistarecomendarclientecupon"> Recomendar Cupones </a>
<a href="?controlador=Usuario&accion=Inicio"> Cerrar Sesión </a>


<!-- CUPONES -->
<center>
<h2>Lista de cupones</h2>
</center>

<section id="pricing" class="pricing">
    <div class="container">

        <div class="row">
            <?php 
            foreach($vars['cupones'] as $cupon){ 
                ?>

          <div class="col-lg-3 col-md-6" style="text-align: center; display: inline-block">
            <div class="box" data-aos="fade-right">
                <h3><?php echo $cupon->getcuponnombre()?> </h3>
                <img src="<?php echo $cupon->getcuponrutaimagen() ?>" style="border-radius: 10px" width="150" height="150" >
                <h3><?php echo $cupon->getcupondescripcion()?> </h3>
                <h4><?php echo $cupon->getcupontipo()?> </h4>
                <h4><?php echo $cupon->getcupondetallesadicionales()?> </h4>
                
                <h3>$<?php echo $cupon->getcuponprecio()?><span> / persona</span></h3>
                
                <br>
                <div class="btn-wrap">
                <a href="?controlador=Cliente&accion=verDetallesCupon&id=<?php echo  $cupon->getcuponid(); ?>" class="btn-success form-control" style="width = 50%;">Comprar Ahora!</a>
                </div>
            </div>
          </div>
            <?php  } ?>
            
        </div>
    </div>
</section><!-- End Pricing Section -->


<!-- RECOMENDADOS -->
<br><br><br>
<center>
<h2>Cupones recomendados para ti!</h2>
</center>

<section id="pricing" class="pricing">
    <div class="container">

        <div class="row">
            <?php 
            foreach($vars['cuponesRecomendados'] as $cupon){ 
                ?>

          <div class="col-lg-3 col-md-6" style="text-align: center; display: inline-block">
            <div class="box" data-aos="fade-right">
                <h3><?php echo $cupon->getcuponnombre()?> </h3>
                <img src="<?php echo $cupon->getcuponrutaimagen() ?>" style="border-radius: 10px" width="150" height="150" >
                <h3><?php echo $cupon->getcupondescripcion()?> </h3>
                <h4><?php echo $cupon->getcupontipo()?> </h4>
                <h4><?php echo $cupon->getcupondetallesadicionales()?> </h4>
                
                <h3>$<?php echo $cupon->getcuponprecio()?><span> / persona</span></h3>
                
                <br>
                <div class="btn-wrap">
                <a href="?controlador=Cliente&accion=verDetallesCupon&id=<?php echo  $cupon->getcuponid(); ?>" class="btn-success form-control" style="width = 50%;">Comprar Ahora!</a>
                </div>
            </div>
          </div>
            <?php  } ?>
            
        </div>
    </div>
</section>


<br><br><br>


<div class = "row">
    <div class= "col-sm-3"></div>
    <div class= "col-sm-6">
    <h2>Datos de sesion</h2>
        <br>
        <table style="width: 100%">
            <thead>
                <th>cliente id</th>
                <th>Clicks mayor</th>
                <th>Clicks menor</th>
            </thead>
            
            <tbody id="filas" style="text-align: left">
                
                    <tr>                       
                        <td> <?php echo $vars['datosS'][0]?> </td>
                        <td> <?php echo $vars['datosS'][1]?> </td>
                        <td> <?php echo $vars['datosS'][2]?> </td>
                    </tr>
      
                
            </tbody>
            
        </table>

    </div>
    
        <!-------------------------------------------------->

</div>
<br><br><br>

<div class="row">

<div class="col-sm-6" id="container2">
</div>


<div class="col-sm-6" id="container">
</div>
</div>

<script type='text/javascript'>
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container').highcharts({
            chart: {
                type: 'bar',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'Los cupones más vendidos en la semana'
            },
            xAxis: {
                type: 'category',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', Date.now()) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: true
            },
            series: [{
                name: 'Ranking por Costo',
                data: (function() {
                   var data = [];

                   <?php foreach($vars['rankeomasvendidossemana'] as $key => $value){?>
                    data.push(['<?php echo $value->getcuponnombre()?>',<?php echo $value->getcuponprecio()?>]);
                    <?php 
                     } ?>
                                    return data;
                })()
            }]
        });
    });
    
});
//]]>  

$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container2').highcharts({
            chart: {
                type: 'line',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'Cupones más vendidos Hoy'
            },
            xAxis: {
                type: 'category',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', Date.now()) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: true
            },
            series: [{
                name: 'Ranking por Costo',
                data: (function() {
                   var data = [];
                   <?php foreach($vars['rankeomasvendidoshoy'] as $key => $value){?>
                    data.push(['<?php echo $value->getcuponnombre()?>',<?php echo $value->getcuponprecio()?>]);
                    <?php 
                     } ?>
                                    return data;
                })()
            }]
        });
    });
    
});
</script>

