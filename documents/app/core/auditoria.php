<?php
    /*
     * REGISTRO DE AUDITORÍA
     * auditar('editar', 'ecos', 15, 'Factura 123 - JUAN PÉREZ', $antes, $despues);
     *
     * Si la auditoría falla (por ejemplo, porque aún no se ejecutó migracion_02_auditoria.sql)
     * solo se registra el error en el log: la operación del usuario ya se hizo y no debe fallar por esto.
     */
    require_once __DIR__ . "/../models/AuditoriaModel.php";

    function auditar($accion, $modulo, $registroId, $descripcion, $antes = null, $despues = null, $usuario = null){
        try {
            $Auditoria = new Auditoria();
            $Auditoria -> registrar(array(
                'idUsuario'     => $usuario !== null ? $usuario['idUsuario'] : (usuario_actual_id() ?: null),
                'usuario'       => $usuario !== null ? $usuario['usuario'] : (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null),
                'accion'        => $accion,
                'modulo'        => $modulo,
                'registro_id'   => $registroId,
                'descripcion'   => function_exists('mb_substr') ? mb_substr($descripcion, 0, 255, 'UTF-8') : substr($descripcion, 0, 255),
                'datos_antes'   => $antes === null ? null : json_encode($antes, JSON_UNESCAPED_UNICODE),
                'datos_despues' => $despues === null ? null : json_encode($despues, JSON_UNESCAPED_UNICODE),
                'ip'            => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null
            ));
        } catch (Exception $exception) {
            error_log("[cardiologia] No se pudo registrar la auditoría ($accion $modulo): " . $exception -> getMessage());
        }
    }

    // Solo los campos que cambiaron, para mostrar "campo: antes -> después".
    function diferencias($antes, $despues){
        $cambios = array();
        foreach ((array)$despues as $campo => $valor) {
            $anterior = isset($antes[$campo]) ? $antes[$campo] : null;
            if ((string)$anterior !== (string)$valor) {
                $cambios[$campo] = array($anterior, $valor);
            }
        }
        return $cambios;
    }
?>
