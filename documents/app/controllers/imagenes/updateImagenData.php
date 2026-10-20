<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/estudios.php";
    require_once __DIR__ . "/../../core/informes.php";

    // Respuestas: 1 = OK, 2 = factura repetida, 4 = datos inválidos, 5 = informe no válido o muy grande,
    //             6 = los datos se guardaron pero el informe no se pudo guardar, 0 = error
    // Informe: un archivo nuevo reemplaza al anterior; quitar_informe=1 lo elimina; si no, queda como estaba.
    $modelo  = new Imagenes();
    $informe = null;
    $quitar  = false;

    estudio_actualizar($modelo, array(
        'validar' => function() use (&$informe, &$quitar){
            informe_validar_envio();
            $informe = informe_recibido('informe_update');
            $quitar  = post_texto('quitar_informe', 1) === '1';
        },
        'despues' => function($id) use (&$informe, &$quitar, $modelo){
            $actual = $modelo -> obtener($id);
            $archivoAnterior = $actual ? $actual['informe_archivo'] : null;

            if ($informe !== null) {
                $guardado = informe_guardar($informe);
                if ($guardado === false) {
                    return 6;
                }
                if (!$modelo -> asignarInforme($id, $guardado, usuario_actual_id())) {
                    informe_borrar($guardado['archivo']);
                    return 6;
                }
                if ($archivoAnterior) {
                    informe_borrar($archivoAnterior);
                }
            } elseif ($quitar && $archivoAnterior) {
                $modelo -> quitarInforme($id);
                informe_borrar($archivoAnterior);
            }
            return 1;
        }
    ));
?>
