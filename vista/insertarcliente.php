<!DOCTYPE html>
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

<a href="?controlador=Usuario&accion=Inicio"> Regresar </a>
<?php
    $title = 'Agregar Cliente';
?>

<script>

    var array = new Array();
    var arrayC = new Array();
    var arrayD = new Array();
    var stringUbicacion;
    var arrayUbicacion= new Array();
    function agregarU(ubicacion,id) {
        var parametros = {
            "ubicacion": ubicacion,
            "id":id
        };
        $.ajax(
            {
                data: parametros,
                url: '?controlador=Cliente&accion=agregarUbicacion',
                type: 'post',
                success: function (response) {
                    //alert(response)
                }
            }
        );
    }   
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            url: "https://ubicaciones.paginasweb.cr/provincias.json",
            data: {},
            success: function (data) {
                var html = "<select>";
               
                for(key in data) {
                    html += "<option value='"+key+"'>"+data[key]+"</option>";
                    array.push(data[key]);
                }
                html += "</select";
                $('#provincias').html(html);
                 
            }
        });
        
        
        $("#provincias").click(function(){
            
            $("#provincias option:selected").each(function(){
                id_pro = $(this).val();
                agregarU(array[id_pro-1],0);
            })
            
        });
        $("#provincias").change(function(){
            $("#distrito").find('option').remove().end().append(
                '<option value= "whatever"></option>').val('whatever');

            $("#provincias option:selected").each(function(){
                id_provincia= $(this).val();
                //alert(id_provincia);
                $.post("vista/getcanton.php", { id_provincia: id_provincia
                }, function(data){
                    $.ajax({
                        dataType: "json",
                        url: "https://ubicaciones.paginasweb.cr/provincia/"+id_provincia+"/cantones.json",
                        data: {},
                        success: function (data) {
                            var html = "<select>";
                            for(key in data) {
                                html += "<option value='"+key+"'>"+data[key]+"</option>";
                                arrayC.push(data[key]);
                            }
                            html += "</select";
                            $('#canton').html(html);
                            
                        }
                    });
                });
                
            });
            $("#canton").click(function(){
            
                $("#canton option:selected").each(function(){
                    id_proC = $(this).val();
                    agregarU(arrayC[id_proC-1],1);
                })
            }); 
        })
        $("#canton").change(function(){
            $("#canton option:selected").each(function(){
                id_canton= $(this).val();
                //alert(id_provincia);
                $.post("vista/getcanton.php", { id_canton: id_canton
                }, function(data){
                    $.ajax({
                        dataType: "json",
                        url:"https://ubicaciones.paginasweb.cr/provincia/"+id_provincia+"/canton/"+id_canton+"/distritos.json",
                        data: {},
                        success: function (data) {
                            var html = "<select>";
                            for(key in data) {
                                html += "<option value='"+key+"'>"+data[key]+"</option>";
                                arrayD.push(data[key]);
                            }
                            html += "</select";
                            $('#distrito').html(html);
                        }
                    });
                });
            });
            $("#distrito").click(function(){
            
                $("#distrito option:selected").each(function(){
                    id_proD = $(this).val();
                    agregarU(arrayD[id_proD-1],2);
                })
            });
        })
    });

</script>
    
<form method="post" enctype="multipart/form-data" action="?controlador=Cliente&accion=insertarclientenuevo">
    <div>
        <label for="correo">Correo</label>
        <input required type="text" name="correo" id="correo" value=""/>
    </div>
    <div>
        <label for="contra">Contraseña</label>
        <input required type="text" name="contra" id="contra" value=""/>
    </div>
    <div>
    <label for="ubicacionprovincia">Seleccione provincia</label>
    <select name="provincias" id="provincias">
        <option value=0>Seleccione provincia</option>
    </select>
    </div>
    <div>
        <label for="ubicacioncanton">Seleccione cantón</label>
        <select id="canton" name="canton"></select>
    </div>
    <div>
        <label for="ubicaciondistrito">Seleccione distrito</label>
        <select id="distrito" name="distrito"></select>
    </div>
    <input type="submit" value="Agregar" name="create" id="create"/>
</form>


<?php
    include rutaVista.'footer.php';
?>

