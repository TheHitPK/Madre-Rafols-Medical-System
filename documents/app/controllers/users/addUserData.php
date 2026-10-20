<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/UsersModel.php";
    require_once __DIR__ . "/../../core/auditoria.php";

    api_escritura();
    requerir_admin_api();

    // Respuestas: 1 = OK, 2 = cédula o usuario repetidos, 3 = contraseña muy corta, 4 = datos inválidos, 0 = error
    $formAddUserData = array('nombre_usuario'   => post_texto('nombre_usuario'),
                             'apellido_usuario' => post_texto('apellido_usuario'),
                             'cedula_usuario'   => post_entero('cedula_usuario'),
                             'usuario'          => post_texto('usuario', 20),
                             'password'         => isset($_POST['password']) ? (string)$_POST['password'] : '',
                             'idRol'            => post_entero('idRol'),
                             'idDepartamento'   => post_entero('idDepartamento'));

    if (!campos_completos($formAddUserData)
        || !in_array($formAddUserData['idRol'], array(ROL_ADMIN, ROL_EMPLEADO), true)
        || !in_array($formAddUserData['idDepartamento'], array(AREA_CARDIOLOGIA, AREA_IMAGENES), true)) {
        responder("4");
    }
    if (strlen($formAddUserData['password']) < PASSWORD_MIN_LENGTH) {
        responder("3");
    }

    $Users = new Users;
    $resultado = $Users -> addUserData($formAddUserData);
    if ($resultado === 1) {
        $nuevo = $Users -> obtainUserData((int)Connection::connect() -> lastInsertId());
        auditar('crear', 'usuarios', (int)$nuevo['idUsuario'], "Usuario " . $nuevo['usuario'] . " (" . $nuevo['rol'] . " - " . $nuevo['departamento'] . ")", null, $nuevo);
    }
    echo $resultado;
?>
