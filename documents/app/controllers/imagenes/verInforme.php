<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/estudios.php";
    require_once __DIR__ . "/../../core/informes.php";
    require_once __DIR__ . "/../../core/auditoria.php";

    // Abre (PDF) o descarga (Word) el informe de un estudio: verInforme.php?id=15
    // Solo con sesión y acceso al área de Imágenes. Cada consulta queda en la auditoría.
    api_lectura();
    requerir_area_api(AREA_IMAGENES);

    $id = isset($_GET['id']) && ctype_digit((string)$_GET['id']) ? (int)$_GET['id'] : 0;
    $modelo  = new Imagenes();
    $estudio = $id > 0 ? $modelo -> obtener($id) : false;
    $ruta    = $estudio ? informe_ruta($estudio['informe_archivo']) : false;

    if ($ruta === false) {
        if ($estudio && $estudio['informe_archivo']) {
            error_log("[cardiologia] Falta el archivo del informe del estudio de imágenes $id: " . $estudio['informe_archivo']);
        }
        http_response_code(404);
        header("Content-Type: text/plain; charset=utf-8");
        echo "El informe no existe o fue eliminado.";
        exit;
    }

    auditar('ver_informe', 'imagenes', $id, "Informe consultado: " . $estudio['informe_nombre'] . " - " . $modelo -> describir($estudio));
    informe_enviar($ruta, $estudio['informe_nombre']);
?>
