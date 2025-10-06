function refreshList(){
    $.ajax({
        url: "../phpFunctions/addList.php",
        type: "POST",
        dataType: "json",
        success: function(result){
            console.log(result);
            let rows = '';
            let fecha = '';
            let hora = '';
            let tel = '';
            let rat = '';
            let tabla = $('#tablaRatings').DataTable();
            
            if(tabla.rows().count()<result.ratings.length){
                result.ratings.forEach((item, index) =>{
                    fecha = item.date;
                    hora = item.time;
                    if(item.tel != null){
                        tel = item.tel;
                    } else{
                        tel = '';
                    }
                    rat = item.rating;
                    switch(rat){
                        case "Buena":
                            rows += '<tr><td>' + fecha + '</td><td>' + hora + '</td><td>' + tel + '</td><td style="color: #00BF63">' + rat + '</td></tr>';
                            break;
                        case "Regular":
                            rows += '<tr><td>' + fecha + '</td><td>' + hora + '</td><td>' + tel + '</td><td style="color: #ffd013">' + rat + '</td></tr>';
                            break;
                        case "Deficiente":
                            rows += '<tr><td>' + fecha + '</td><td>' + hora + '</td><td>' + tel + '</td><td style="color: #FF3131">' + rat + '</td></tr>';
                            break;
                    }
                });
                $("#LR").empty().append(rows);
                tabla.clear().rows.add($("#LR tr")).draw();
            }
        },
        error: function(){
            console.log("FALLOOOOOOOOOOOOOOOOOOO");
        }
    });
};

function getContadores(){
    $.ajax({
        url: "../phpFunctions/contadores.php",
        dataType: 'json',
        type: "POST",
        success: function(result){
            console.log(result);
            let diario = result["Diario"];
            let mensual = result["Mensual"];
            $(".contadores-contaner").empty();
            $(".contadores-contaner").html("<p>Hoy: " + diario + "</p><p>Este mes: " + mensual + "</p>");
            $(".contadores-contaner").css({
                'display': 'flex',
                'flex-direction': 'row',
                'justify-content': 'space-evenly',
                'align-items': 'center',
                'font-size': '30px',
            });
            $(".contadores-contaner p").css({
                'display': 'inline-block',
                'margin': '6px 0px'
            });
        },
        error: function(){
            console.log("FALLOOOOOOOOOOOOOOOOOOO");
        }
    });
};

function getPorcentajes(){
    $.ajax({
        url: "../phpFunctions/porcentajes.php",
        dataType: 'json',
        type: "POST",
        success: function(result){
            console.log(result);
            if (result["totales"]>0){
                let pMal = (result["malas"]/result["totales"])*100;
                let pReg = (result["regulares"]/result["totales"])*100;
                let pBien = (result["buenas"]/result["totales"])*100;
                $(".per-bar").html("<p class='per-bien'></p><p class='per-regular'></p><p class='per-mal'></p><div class='bien'></div><div class='regular'></div><div class='mal'></div>");
                $('.per-bar').css({
                    'margin-left': 'auto',
                    'margin-right': 'auto',
                    'height': '65px',
                    'width': '80%',
                    'display': 'grid',
                    'grid-template-rows': '1fr 1fr',
                    'transition': '0.3s',
                    'grid-template-columns': pBien+"% "+pReg+"% "+pMal+"%",
                    "opacity": "1"
                });
                $(".per-mal").empty();
                $(".per-regular").empty();
                $(".per-bien").empty();
                if(pMal.toFixed(2)>0){
                    $(".per-mal").html(pMal.toFixed(2)+"%");
                }
                if(pReg.toFixed(2)>0){
                    $(".per-regular").html(pReg.toFixed(2)+"%");
                }
                if(pBien.toFixed(2)>0){
                    $(".per-bien").html(pBien.toFixed(2)+"%");
                }
            } else{
                $('.per-bar').css({
                    'margin-left': '',
                    'margin-right': '',
                    'height': '',
                    'width': '',
                    'display': '',
                    'grid-template-rows': '',
                    'transition': '0.3s',
                    'grid-template-columns': '',
                    "opacity": "0"
                });
                $(".per-bar").empty();
            }
        },
        error: function(){
            console.log("FALLOOOOOOOOOOOOOOOOOOO");
        }
    });
}

function getFechaHora(){
    $.ajax({
        url: "../phpFunctions/getFechaHora.php",
        dataType: 'json',
        type: "POST",
        success: function(result){
            console.log(result);
            $(".fecha-actual").html(result["fecha"]+"</br>"+result["hora"]);
        },
        error: function(){
            console.log("FALLOOOOOOOOOOOOOOOOOOO");
        }
    });
}

function actualizarHistorial(){
    $.ajax({
        url: "../controladorJson/moverAHistorial.php",
        type: "POST",
        success: function(){
        },
        error: function(){
            console.log("FALLOOOOOOOOOOOOOOOOOOO");
        }
    });
}

$(document).ready(function(){
    let tabla = $('#tablaRatings').DataTable({
        dom: '<"dt-buttons"B><"dataTables_filter"f>rt', // Define la posición de los botones
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="bi bi-file-earmark-excel-fill" style="color: green"></i>',
                className: 'boton-dataTable' // Añadir clase personalizada
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bi bi-file-earmark-pdf-fill" style="color: red"></i>',
                className: 'boton-dataTable' // Añadir clase personalizada
            }
        ],
        language: {
            url: '../../dataTableES.json',
        },
        pageLength: -1,
        order: [] //no hay ordenamiento inicial.
    });

    actualizarHistorial();
    refreshList();
    getPorcentajes();
    getContadores();
    getFechaHora();

    setInterval(actualizarHistorial, 3600000); // Consultar cada hora (3600000 milisegundos)
    setInterval(refreshList, 5000); // Consultar cada 5 segundos (5000 milisegundos)
    setInterval(getPorcentajes, 5000); // Consultar cada 5 segundos (5000 milisegundos)
    setInterval(getContadores, 5000); // Consultar cada 5 segundos (5000 milisegundos)
    setInterval(getFechaHora, 5000); // Consultar cada 5 segundos (5000 milisegundos)
});