<?php
    /*
     * LÓGICA COMÚN DE LOS CONTROLADORES DE ESTUDIOS (ecos, holters, mapas)
     * Los nombres de los campos del formulario siguen el patrón del front:
     *   agregar:    factura_eco,        idC_costo,        idMedico, ...
     *   actualizar: factura_eco_update, idC_costo_update, idMedico_update, ... + idEco
     *
     * Respuestas: 1 = OK, 2 = factura repetida para el paciente, 4 = datos inválidos, 0 = error
     */
    require_once __DIR__ . "/auditoria.php";
    require_once __DIR__ . "/../models/EcoModel.php";
    require_once __DIR__ . "/../models/HolterModel.php";
    require_once __DIR__ . "/../models/MapaModel.php";

    // Modelos por nombre de tabla: 'ecos' => Ecos, ...
    function modelos_estudio(){
        return array('ecos' => new Ecos(), 'holters' => new Holters(), 'mapas' => new Mapas());
    }

    function datos_estudio_desde_post($modelo, $sufijoCampo){
        $s = $modelo -> sufijo();
        $u = $sufijoCampo;
        return array('idC_costo'  => post_entero("idC_costo$u"),
                     'idMedico'   => post_entero("idMedico$u"),
                     'factura'    => post_texto("factura_$s$u", $modelo -> longitudFactura()),
                     'fecha'      => post_fecha("fecha_$s$u"),
                     'nombre'     => post_texto("nombre_paciente_$s$u"),
                     'apellido'   => post_texto("apellido_paciente_$s$u"),
                     'cedula'     => post_entero("cedula_paciente_$s$u"),
                     'n_historia' => post_entero_opcional("n_historia_paciente_$s$u"));
    }

    function validar_estudio($datos){
        $obligatorios = $datos;
        unset($obligatorios['factura']); // la factura es opcional en el formulario
        if (!campos_completos($obligatorios)) {
            responder("4");
        }
    }

    function estudio_agregar($modelo){
        api_escritura();
        $datos = datos_estudio_desde_post($modelo, "");
        validar_estudio($datos);
        $resultado = $modelo -> agregar($datos, usuario_actual_id());
        if ($resultado === 1) {
            $nuevo = $modelo -> obtener($modelo -> ultimoId());
            auditar('crear', $modelo -> tabla(), $modelo -> ultimoId(), $modelo -> describir($nuevo), null, $modelo -> datosAuditables($nuevo));
        }
        echo $resultado;
    }

    function estudio_actualizar($modelo){
        api_escritura();
        $datos = datos_estudio_desde_post($modelo, "_update");
        $datos['id'] = post_entero($modelo -> campoId());
        validar_estudio($datos);

        $anterior = $modelo -> obtener($datos['id']);
        if (!$anterior) {
            responder("0"); // no existe o está en la papelera
        }
        $resultado = $modelo -> actualizar($datos, usuario_actual_id());
        if ($resultado === 1) {
            $nuevo   = $modelo -> obtener($datos['id']);
            $cambios = diferencias($modelo -> datosAuditables($anterior), $modelo -> datosAuditables($nuevo));
            if (count($cambios) > 0) {
                auditar('editar', $modelo -> tabla(), $datos['id'], $modelo -> describir($nuevo),
                        $modelo -> datosAuditables($anterior), $modelo -> datosAuditables($nuevo));
            }
        }
        echo $resultado;
    }

    function estudio_obtener($modelo){
        api_lectura();
        $id = post_entero($modelo -> campoId());
        if ($id === null) {
            responder("4");
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($modelo -> obtener($id));
    }

    function estudio_eliminar($modelo){
        api_escritura();
        if (!puede_eliminar_estudios()) {
            responder("SIN_PERMISO", 403);
        }
        $id = post_entero($modelo -> campoId());
        if ($id === null) {
            responder("4");
        }
        $anterior  = $modelo -> obtener($id);
        $resultado = $anterior ? $modelo -> eliminar($id, usuario_actual_id()) : 0;
        if ($resultado === 1) {
            auditar('eliminar', $modelo -> tabla(), $id, $modelo -> describir($anterior), $modelo -> datosAuditables($anterior), null);
        }
        echo $resultado;
    }

    // Marca compartida: cualquier usuario con sesión puede marcar/desmarcar (como antes).
    // Con ids[] se importan de una vez las marcas que el navegador tenía guardadas localmente.
    function estudio_marcar($modelo){
        api_escritura();
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            $ids = array();
            foreach (array_slice($_POST['ids'], 0, 5000) as $id) {
                if (ctype_digit((string)$id)) {
                    $ids[] = (int)$id;
                }
            }
            echo $modelo -> marcarVarios($ids, usuario_actual_id()) >= 0 ? "1" : "0";
            return;
        }
        $id      = post_entero($modelo -> campoId());
        $marcado = post_entero('marcado');
        if ($id === null || ($marcado !== 0 && $marcado !== 1)) {
            responder("4");
        }
        echo $modelo -> marcar($id, $marcado === 1, usuario_actual_id());
    }
?>
