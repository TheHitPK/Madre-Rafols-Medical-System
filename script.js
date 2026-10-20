function userLogin(){
    var $boton = $('#botonLogin');
    var entrando = false;
    if ($boton.prop('disabled')) {
        return false; // ya hay un intento en curso
    }
    $boton.prop('disabled', true).attr('aria-busy', 'true').html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> INGRESANDO...');
    $.ajax({
        type:"POST",
        data:$('#formLogin').serialize(),
        url:"documents/app/controllers/sessions/userLogin.php",
        success:function(estado){
            estado = String(estado).trim();

            if (estado == 'Activo') {
                entrando = true;
                window.location = "documents/app/views/home.php";
            }else if (estado == 'Inactivo') {
                swal({
                    icon: "warning",
                    title: "¡ADVERTENCIA!",
                    text: "Actualmente no dispone del permiso para acceder al sistema"
                });
            }else if (estado == 'Bloqueado') {
                swal({
                    icon: "warning",
                    title: "¡ACCESO BLOQUEADO!",
                    text: "Demasiados intentos fallidos. Espere unos minutos e intente de nuevo."
                });
            }else {
                $('#password').val('').focus();
                swal({
                    icon: "error",
                    title: "¡ERROR!",
                    text: "Usuario y/o contraseña incorrectos",
                    dangerMode: true
                });
            }
        },
        complete:function(){
            if (!entrando) {
                $boton.prop('disabled', false).removeAttr('aria-busy').text('INICIAR SESIÓN');
            }
        },
        error:function(){
            swal({
                icon: "error",
                title: "¡ERROR!",
                text: "No se pudo conectar con el servidor, contacte al administrador."
            });
        }
    });
    return false;
}

// Mostrar u ocultar la contraseña
$(function(){
    $('#verPassword').on('click', function(){
        var $campo = $('#password');
        var visible = $campo.attr('type') === 'text';
        $campo.attr('type', visible ? 'password' : 'text');
        $(this).attr({
            'aria-pressed': visible ? 'false' : 'true',
            'aria-label': visible ? 'Mostrar contraseña' : 'Ocultar contraseña',
            'title': visible ? 'Mostrar contraseña' : 'Ocultar contraseña'
        }).find('i').toggleClass('fa-eye', visible).toggleClass('fa-eye-slash', !visible);
        $campo.trigger('focus');
    });
});
