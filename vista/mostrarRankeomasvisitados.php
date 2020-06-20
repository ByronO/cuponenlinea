<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Java Smart Home Simulator</title>

  <a href="?controlador=Empresa&accion=insertar"> Inicio </a>
    <a href="?controlador=Reportes&accion=vistaprincipalRankeo"> Ranking </a>
  
<!-- Latest compiled and minified CSS -->
</head>
<body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container">
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
                type: 'column',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'Cupones más visitados'
            },
            xAxis: {
                type: 'category',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Visitas'
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
                   <?php foreach($vars['rankeomasvisitados'] as $key => $value){?>
                    data.push(['<?php echo $value->getcupontipo()?>',<?php echo $value->getcuponcantidadclicks()?>]);
                    <?php 
                     } ?>
                     return data;
                })()
            }]
        });
    });
    
});
//]]>  
</script>
</html>
