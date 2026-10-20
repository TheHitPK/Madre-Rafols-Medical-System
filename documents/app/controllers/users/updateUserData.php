<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/UsersModel.php";
    require_once __DIR__ . "/../../core/auditoria.php";

    api_escritura();
    requerir_admin_api();

    // Respuestas: 1 = OK, 2 = cédula o usuario repetidos, 3 = contraseña muy corta, 4 = datos inválidos, 0 = error
    $formUpdateUserData = array('idUsuario'               => post_entero('idUsuario'),
                                'nombre_usuario_update'   => post_texto('nombre_usuario_update'),
                                'apellido_usuario_update' => post_texto('apellido_usuario_update'),
                                'cedula_usuario_update'   => post_entero('cedula_usuario_update'),
                                'usuario_update'          => post_texto('usuario_update', 20),
                                'idRol_update'            => post_entero('idRol_update'),
                                'idDepartamento_update'   => post_entero('idDepartamento_update'));

    if (!campos_completos($formUpdateUserData)
        || !in_array($formUpdateUserData['idRol_update'], array(ROL_ADMIN, ROL_EMPLEADO), true)
        || !in_array($formUpdateUserData['idDepartamento_update'], array(AREA_CARDIOLOGIA, AREA_IMAGENES), true)
        || $formUpdateUserData['idUsuario'] === SUPER_ADMIN_ID) {
        responder("4");
    }

    // Contraseña opcional: vacía = se mantiene la actual.
    $formUpdateUserData['password_update'] = isset($_POST['password_update']) ? (string)$_POST['password_update'] : '';
    if ($formUpdateUserData['password_update'] !== '' && strlen($formUpdateUserData['password_update']) < PASSWORD_MIN_LENGTH) {
        responder("3");
    }

    $Users = new Users;
    $anterior  = $Users -> obtainUserData($formUpdateUserData['idUsuario']);
    $resultado = $Users -> updateUserData($formUpdateUserData);
    if ($resultado === 1 && $anterior) {
        $nuevo = $Users -> obtainUserData($formUpdateUserData['idUsuario']);
        $cambioPassword = $formUpdateUserData['password_update'] !== '';
        if ($cambioPassword) {
            // Nunca se guarda la contraseña ni su hash en la auditoría: solo que cambió.
            $anterior['contraseña'] = '(sin cambios)';
            $nuevo['contraseña']    = '(cambiada)';
        }
        if (count(diferencias($anterior, $nuevo)) > 0) {
            auditar('editar', 'usuarios', (int)$nuevo['idUsuario'], "Usuario " . $nuevo['usuario'] . ($cambioPassword ? " (contraseña cambiada)" : ""), $anterior, $nuevo);
        }
    }
    echo $resultado;
?>
