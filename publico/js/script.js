

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