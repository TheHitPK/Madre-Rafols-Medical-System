<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/estudios.php";

    api_escritura();
    requerir_admin_api();

    // Respuestas: 1 = restaurado, 2 = la factura ya se registró de nuevo para ese paciente, 4 = datos inválidos, 0 = no está en la papelera
    $modelos = modelos_estudio();
    $modulo  = post_texto('modulo', 20);
    $id      = post_entero('id');
    if (!isset($modelos[$modulo]) || $id === null) {
        responder("4");
    }

    $modelo    = $modelos[$modulo];
    $resultado = $modelo -> restaurar($id);
    if ($resultado === 1) {
        $estudio = $modelo -> obtener($id);
        auditar('restaurar', $modelo -> tabla(), $id, $modelo -> describir($estudio), null, $modelo -> datosAuditables($estudio));
    }
    echo $resultado;
?>
