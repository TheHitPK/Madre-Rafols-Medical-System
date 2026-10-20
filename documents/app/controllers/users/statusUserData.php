<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/UsersModel.php";
    require_once __DIR__ . "/../../core/auditoria.php";

    api_escritura();
    requerir_admin_api();

    $idUsuario = post_entero('idUsuario');

    // No se puede desactivar al administrador principal ni a uno mismo.
    if ($idUsuario === null || es_super_admin($idUsuario) || $idUsuario === usuario_actual_id()) {
        responder("4");
    }

    $Users = new Users;
    $status = $Users -> obtainUserStatus($idUsuario);
    if (!$status) {
        responder("0");
    }

    // Responde el estado ANTERIOR (1 o 2), como espera el front.
    $estadoActual = (int)$status[0];
    $nuevoEstado  = ($estadoActual === ESTADO_ACTIVO) ? ESTADO_INACTIVO : ESTADO_ACTIVO;
    $Users -> changeUserStatus($idUsuario, $nuevoEstado);
    $usuario = $Users -> obtainUserData($idUsuario);
    auditar($nuevoEstado === ESTADO_ACTIVO ? 'activar' : 'desactivar', 'usuarios', $idUsuario, "Usuario " . $usuario['usuario'] . " -> " . $usuario['estado']);
    echo $estadoActual;
?>
