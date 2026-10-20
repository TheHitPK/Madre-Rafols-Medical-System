<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/estudios.php";
    require_once __DIR__ . "/../../core/informes.php";

    // Respuestas: 1 = OK, 2 = factura repetida, 4 = datos inválidos, 5 = informe no válido o muy grande,
    //             6 = el estudio se guardó pero el informe no se pudo guardar, 0 = error
    $modelo  = new Imagenes();
    $informe = null;

    estudio_agregar($modelo, array(
        'validar' => function() use (&$informe){
            informe_validar_envio();
            $informe = informe_recibido('informe');
        },
        'despues' => function($id) use (&$informe, $modelo){
            if ($informe === null) {
                return 1;
            }
            $guardado = informe_guardar($informe);
            if ($guardado === false) {
                return 6;
            }
            if (!$modelo -> asignarInforme($id, $guardado, usuario_actual_id())) {
                informe_borrar($guardado['archivo']);
                return 6;
            }
            return 1;
        }
    ));
?>
