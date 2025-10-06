function animacionImg(){
    $("#feliz").css("width", 70+"%");
    setTimeout(function(){
        $("#feliz").css("width", 120+"%");
        $("#serio").css("width", 70+"%");
        setTimeout(function(){
            $("#serio").css("width", 120+"%");
            $("#triste").css("width", 70+"%");
            setTimeout(function(){
                $("#triste").css("width", 120+"%");
            }, 1000);
        }, 1000);
    }, 1000);
}

$(document).ready(function(){
    setInterval(animacionImg, 5000);

    $('#feliz').on('click', function(){
        $('#rating').val('Buena');
        $('#formRating').submit();
    });

    $('#serio').on('click', function(){
        $('#rating').val('Regular');
        $('#formRating').submit();
    });

    $('#triste').on('click', function(){
        $('#rating').val('Deficiente');
        $('#formRating').submit();
    });

    $('#formRating').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: './phpFunctions/checkPremio.php',
            type: 'POST',
            success: function(respuesta){
                if(respuesta){
                    textoSwal = '<p class="fs-4">¡Ingresa tu teléfono y participa por un obsequio!</p><div style="margin-top: 12px"><div style="display: flex; flex-direction: row; justify-content: center;"><select class="swal2-select" style="margin: 0px; min-width: 1rem" id="cod" name="cod" required><option value="">Cod</option><option value="0412">0412</option><option value="0414">0414</option><option value="0424">0424</option><option value="0416">0416</option><option value="0426">0426</option><select><input style="margin: 0px;" class="swal2-input" type="tel" inputmode="numeric" id="tel" name="tel" step="1" placeholder="Número" maxlength="7" size="10" required></div></div>';
                } else{
                    textoSwal = '<p class="fs-4">Por favor, ingresa tu teléfono.</p><div style="margin-top: 12px"><div style="display: flex; flex-direction: row; justify-content: center;"><select class="swal2-select" style="margin: 0px; min-width: 1rem" id="cod" name="cod" required><option value="">04--</option><option value="0412">0412</option><option value="0414">0414</option><option value="0424">0424</option><option value="0416">0416</option><option value="0426">0426</option><select><input style="margin: 0px;" class="swal2-input" type="tel" inputmode="numeric" id="tel" name="tel" step="1" placeholder="Número" maxlength="7" size="10" required></div></div>';
                }

                swal.fire({
                    title: '¡Gracias!',
                    html: textoSwal,
                    allowOutsideClick: false,
                    timer: 60000, // Temporizador de 60 segundos
                    timerProgressBar: true,
                    customClass: {
                        title: 'text-success',
                        confirmButton: 'btn btn-success'
                    },
                    preConfirm: () => {
                        const cod = $('#cod').val();
                        const num = $('#tel').val();
        
                        if(!cod || !num){
                            Swal.showValidationMessage('Ambos campos son obligatorios');
                            return false;
                        }
        
                        if(!num.match(/^\d{7}$/)){
                        Swal.showValidationMessage('Formato de número incorrecto');
                            return false;
                        }
        
                        const res = {cod, num};
                        return res;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const cod = result.value.cod;
                        const tel = result.value.num;
        
                        $('#telefono').val(cod + '-' + tel);
        
                        $('#formRating').attr('action', './vistas/success.php');
                        $('#formRating').off('submit').submit();
                    }
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $('#rating').val('');
                    }
                });
            },
            error: function(){
                swal.fire({
                    title: 'Ups...',
                    html: '<p class="text-danger fs-4">¡Ocurrió un error inesperado!</p>',
                    icon: 'error',
                    allowOutsideClick: false,
                    timer: 3000, // Temporizador de 60 segundos
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    });
});