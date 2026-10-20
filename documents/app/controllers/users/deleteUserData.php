<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/UsersModel.php";
    require_once __DIR__ . "/../../core/auditoria.php";

    api_escritura();
    requerir_admin_api();

    $idUsuario = post_entero('idUsuario');

    // No se puede eliminar al administrador principal ni a uno mismo.
    if ($idUsuario === null || $idUsuario === SUPER_ADMIN_ID || $idUsuario === usuario_actual_id()) {
        responder("4");
    }

    $Users = new Users;
    $anterior  = $Users -> obtainUserData($idUsuario);
    $resultado = $Users -> deleteUserData($idUsuario);
    if ($resultado === 1 && $anterior) {
        auditar('eliminar', 'usuarios', $idUsuario, "Usuario " . $anterior['usuario'], $anterior, null);
    }
    echo $resultado;
?>
