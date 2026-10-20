<?php
    /*
     * LÓGICA COMÚN DE LOS CONTROLADORES DE CATÁLOGOS (centros de costo, médicos)
     * Campos del formulario: agregar -> medico | actualizar -> idMedico + medico_update
     *
     * Respuestas: 1 = OK, 2 = nombre repetido, 3 = tiene estudios asociados, 4 = datos inválidos, 0 = error
     */
    require_once __DIR__ . "/auditoria.php";

    function catalogo_agregar($modelo, $soloAdmin = false){
        api_escritura();
        if ($soloAdmin) {
            requerir_admin_api();
        }
        $nombre = post_texto($modelo -> campo(), 150);
        if ($nombre === '') {
            responder("4");
        }
        $resultado = $modelo -> agregar($nombre);
        if ($resultado === 1) {
            auditar('crear', $modelo -> tabla(), (int)Connection::connect() -> lastInsertId(), $nombre, null, array('nombre' => $nombre));
        }
        echo $resultado;
    }

    function catalogo_actualizar($modelo, $soloAdmin = false){
        api_escritura();
        if ($soloAdmin) {
            requerir_admin_api();
        }
        $id     = post_entero($modelo -> campoId());
        $nombre = post_texto($modelo -> campo() . "_update", 150);
        if ($id === null || $nombre === '') {
            responder("4");
        }
        $anterior  = $modelo -> obtener($id);
        $resultado = $modelo -> actualizar($id, $nombre);
        if ($resultado === 1 && $anterior && $anterior[$modelo -> campo()] !== $nombre) {
            auditar('editar', $modelo -> tabla(), $id, $nombre,
                    array('nombre' => $anterior[$modelo -> campo()]), array('nombre' => $nombre));
        }
        echo $resultado;
    }

    function catalogo_obtener($modelo){
        api_lectura();
        $id = post_entero($modelo -> campoId());
        if ($id === null) {
            responder("4");
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($modelo -> obtener($id));
    }

    function catalogo_eliminar($modelo){
        api_escritura();
        requerir_admin_api();
        $id = post_entero($modelo -> campoId());
        if ($id === null) {
            responder("4");
        }
        $anterior  = $modelo -> obtener($id);
        $resultado = $modelo -> eliminar($id);
        if ($resultado === 1 && $anterior) {
            auditar('eliminar', $modelo -> tabla(), $id, $anterior[$modelo -> campo()], array('nombre' => $anterior[$modelo -> campo()]), null);
        }
        echo $resultado;
    }
?>
