<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../models/PacientesModel.php";

    // Autocompletar: datos ya registrados para la cédula escrita en el formulario.
    api_lectura();

    $cedula = post_entero('cedula');
    header("Content-Type: application/json; charset=utf-8");
    if ($cedula === null) {
        echo "[]";
        exit;
    }

    $Pacientes = new Pacientes();
    echo json_encode($Pacientes -> datosPorCedula($cedula, areas_visibles()));
?>
