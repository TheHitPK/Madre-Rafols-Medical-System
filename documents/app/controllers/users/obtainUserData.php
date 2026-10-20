<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/UsersModel.php";

    api_lectura();
    requerir_admin_api();

    $idUsuario = post_entero('idUsuario');
    if ($idUsuario === null) {
        responder("4");
    }

    $Users = new Users;
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($Users -> obtainUserData($idUsuario));
?>
