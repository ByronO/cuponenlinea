

function agregarServicio(criterio, servicio) {
    var parametros = {
        "criterio": criterio,
        "servicio": servicio
    };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Empresa&accion=agregarServicio',
            type: 'post',
            beforeSend: function () {
                $("#mensaje").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje").html(response);
                if(response.includes("Servicio agregado") ){
                    document.getElementById("filas").innerHTML += '<tr><td>' + criterio + '</td><td> ' + servicio + '</td></tr>';
                    document.getElementById("criterio").value = "";
                    document.getElementById("valor").value = "";
                }
            }
        }
    );
}

function actualizarServicios(criterio, servicio) {
    var parametros = {
        "criterio": criterio,
        "servicio": servicio
    };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Empresa&accion=agregarServicio',
            type: 'post',
            beforeSend: function () {
                $("#mensaje").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje").html(response);
                if(!response.includes('Algunos de los valores ya fueron agregados') ){
                    document.getElementById("filasN").innerHTML += '<tr><td>' + criterio + '</td><td> ' + servicio + '</td></tr>';
                    document.getElementById("criterioN").value = "";
                    document.getElementById("valorN").value = "";
                }
            }
        }
    );
}
function agregarContacto (criterioC,contacto){
    var parametros = {
        "criterioC": criterioC,
        "contacto": contacto
    };
    $.ajax(
        {
            data: parametros,
            url:'?controlador=Empresa&accion=agregarContacto',
            type: 'post',
            beforeSend: function(){
                $("#mensaje2").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje2").html(response);
                if(!response.includes('Alguno de los valores ya fueron agregados') ){
                    document.getElementById("filasC").innerHTML += '<tr><td>' + criterioC + '</td><td> ' + contacto + '</td></tr>';
                    document.getElementById("criterioC").value = "";
                    document.getElementById("valorC").value = "";
                }
            }
        }
    );
}
function actualizarContacto(criterio, contacto) {
    var parametros = {
        "criterio": criterio,
        "contacto": contacto
    };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Empresa&accion=agregarContacto',
            type: 'post',
            beforeSend: function () {
                $("#mensaje").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje").html(response);
                if(!response.includes( 'Alguno de los valores ya fueron agregados') ){
                    document.getElementById("filasN").innerHTML += '<tr><td>' + criterio + '</td><td> ' + contacto + '</td></tr>';
                    document.getElementById("criterioN").value = "";
                    document.getElementById("valorN").value = "";
                }
            }
        }
    );
}


function agregarServicioCupon(servicio) {
    var parametros = {
        "servicio": servicio
    };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Cupon&accion=agregarServicio',
            type: 'post',
            beforeSend: function () {
                $("#mensaje").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje2").html(response);
                if(response.includes("Servicio agregado") ){
                    document.getElementById("filasC").innerHTML += '<tr><td> ' + servicio + '</td></tr>';
                }
            }
        }
    );
}


function establecerPrioridad(prioridad){
    var parametros = {
        "prioridad": prioridad
    };
    $.ajax(
        {
            data: parametros,
            url: '?controlador=Cupon&accion=establecerPrioridad',
            type: 'post',
            beforeSend: function () {
                $("#mensaje").html("Procesando, \n\ espere por favor...");
            },
            success: function (response) {
                $("#mensaje").html(response);
            }
        }
    );
}


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
                url: '?controlador=Empresa&accion=agregarUbicacion',
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