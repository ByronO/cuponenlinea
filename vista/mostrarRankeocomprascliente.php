<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Java Smart Home Simulator</title>
  <a href="?controlador=Cliente&accion=inicio"> Regresar </a>
  
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

<div id="container1">
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
                type: 'line',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'Historial Total Compras de Cupones'
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
                name: 'Ranking por Cantidad',
                data: (function() {
                   var data = [];
                   <?php foreach($vars['rankeoporComprasRealizadas'] as $key => $value){?>
                    data.push(['<?php echo $value->getcuponid()?>',<?php echo $value->getcantidadcupones()?>]);
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

<script type='text/javascript'>
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container1').highcharts({
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
                text: 'Historial Compras por Categorias de Cupones'
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
                name: 'Ranking por Categoria',
                data: (function() {
                   var data = [];
                   <?php foreach($vars['rankeoporComprasRealizadasCategoria'] as $key => $value){?>
                    data.push(['<?php echo $value->getcuponid()?>',<?php echo $value->getcantidadcupones()?>]);
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
