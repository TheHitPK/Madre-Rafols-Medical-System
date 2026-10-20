function userLogin(){
    $.ajax({
        type:"POST",
        data:$('#formLogin').serialize(),
        url:"documents/app/controllers/sessions/userLogin.php",
        success:function(estado){
            estado = String(estado).trim();

            if (estado == 'Activo') {
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
