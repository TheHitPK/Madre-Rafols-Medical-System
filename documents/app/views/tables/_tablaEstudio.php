<?php
    if (!isset($tablaEstudio)) { exit; } // solo se usa incluido, nunca directamente
    /*
     * TABLA COMÚN DE ESTUDIOS (ecos, holters, mapas)
     * Se incluye desde tables/<modulo>/table<Modulo>s.php, que define $tablaEstudio:
     *   modelo  -> instancia del modelo (Ecos, Holters, Mapas)
     *   id      -> id HTML de la tabla (tableEcos)
     *   nombre  -> nombre usado en las funciones JS y modales (Eco -> obtainEcoData, #updateEcoModal)
     *   opciones-> opciones de initTablaEstudio (título del reporte, formato del PDF)
     *
     * Las filas se envían como datos (JSON) y DataTables solo dibuja las que están a la vista.
     * Con miles de registros, enviarlas como HTML hacía que el navegador tardara ~8 segundos en mostrar la tabla.
     * La búsqueda, el orden, el filtro de fechas y las exportaciones siguen usando TODOS los registros.
     */
    $nombre = $tablaEstudio['nombre'];

    $filas = array();
    foreach ($tablaEstudio['modelo'] -> listar() as $registro) {
        $filas[] = array('id'          => (int)$registro['id'],
                         'factura'     => (string)$registro['factura'],
                         'fecha'       => $registro['fecha'],
                         'c_costo'     => $registro['c_costo'],
                         'paciente'    => trim($registro['nombre'] . " " . $registro['apellido']),
                         'cedula'      => (string)$registro['cedula'],
                         'n_historia'  => (string)$registro['n_historia'],
                         'medico'      => $registro['medico'],
                         'marcado'     => (bool)$registro['marcado'],
                         'marcado_por' => $registro['marcado_por'],
                         'marcado_en'  => $registro['marcado_en']);
    }

    $opcionesTabla = array_merge(array('id'            => $tablaEstudio['id'],
                                       'nombre'        => $nombre,
                                       'modulo'        => strtolower($nombre),
                                       'modalNuevo'    => "#add{$nombre}Modal",
                                       'modalFiltro'   => "#filter{$nombre}Modal",
                                       'campoId'       => $tablaEstudio['modelo'] -> campoId(),
                                       'urlMarcar'     => "../controllers/" . $tablaEstudio['modelo'] -> tabla() . "/mark{$nombre}Data.php",
                                       'puedeEliminar' => puede_eliminar_estudios(),
                                       'datos'         => $filas), $tablaEstudio['opciones']);

    // JSON_HEX_* impide que un dato con "</script>" o comillas rompa el bloque <script>.
    $json = json_encode($opcionesTabla, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
?>
    <table class="table table-hover text-center display compact nowrap animate__animated animate__fadeIn" style="width: 100%;" id="<?php echo e($tablaEstudio['id']);?>">
        <thead class="text-light" style="background-color: #001d3d;">
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Factura</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Centro de Costo</th>
                <th class="text-center">Paciente</th>
                <th class="text-center">Cédula</th>
                <th class="text-center">Nº de historia</th>
                <th class="text-center">Médico</th>
                <th class="text-center"></th>
            </tr>
        </thead>
    </table>

    <script>
        initTablaEstudio(<?php echo $json;?>);
    </script>
