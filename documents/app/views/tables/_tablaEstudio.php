<?php
    if (!isset($tablaEstudio)) { exit; } // solo se usa incluido, nunca directamente
    /*
     * TABLA COMÚN DE ESTUDIOS (ecos, holters, mapas)
     * Se incluye desde tables/<modulo>/table<Modulo>s.php, que define $tablaEstudio:
     *   modelo  -> instancia del modelo (Ecos, Holters, Mapas)
     *   id      -> id HTML de la tabla (tableEcos)
     *   nombre  -> nombre usado en las funciones JS y modales (Eco -> obtainEcoData, #updateEcoModal)
     *   opciones-> opciones de initTablaEstudio (título del reporte, formato del PDF)
     */
    $registros      = $tablaEstudio['modelo'] -> listar();
    $nombre         = $tablaEstudio['nombre'];
    $puedeEliminar  = puede_eliminar_estudios();
    $opcionesTabla  = array_merge(array('id'          => $tablaEstudio['id'],
                                        'modulo'      => strtolower($nombre),
                                        'modalNuevo'  => "#add{$nombre}Modal",
                                        'modalFiltro' => "#filter{$nombre}Modal",
                                        'campoId'     => $tablaEstudio['modelo'] -> campoId(),
                                        'urlMarcar'   => "../controllers/" . $tablaEstudio['modelo'] -> tabla() . "/mark{$nombre}Data.php"), $tablaEstudio['opciones']);
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
        <tbody>
            <?php
                // Cada fila se escribe en una sola línea: con cientos de registros, la indentación
                // llegaba a ser la mitad del peso de la tabla.
                $n = 1;
                foreach ($registros as $registro) {
                    $id = (int)$registro['id'];
                    $botonEliminar = $puedeEliminar
                        ? '<span class="btn btn-sm btn-danger" onclick="delete' . $nombre . 'Data(' . $id . ')"><span class="fa-solid fa-trash"></span></span>'
                        : '';
                    echo '<tr>'
                       . '<td>' . $n . '</td>'
                       . '<td class="text-start"><input type="checkbox" class="marca" data-id="' . $id . '"'
                       .     ($registro['marcado'] ? ' checked' : '')
                       .     ($registro['marcado'] && $registro['marcado_por'] ? ' title="Marcado por ' . e($registro['marcado_por']) . ' el ' . e($registro['marcado_en']) . '"' : '')
                       .     '>&nbsp; ' . e($registro['factura']) . '</td>'
                       . '<td>' . e($registro['fecha']) . '</td>'
                       . '<td class="text-uppercase">' . e($registro['c_costo']) . '</td>'
                       . '<td class="text-uppercase">' . e($registro['nombre'] . " " . $registro['apellido']) . '</td>'
                       . '<td>' . e($registro['cedula']) . '</td>'
                       . '<td>' . e($registro['n_historia']) . '</td>'
                       . '<td class="text-uppercase">' . e($registro['medico']) . '</td>'
                       . '<td><div class="btn-group shadow">'
                       .     '<span class="btn btn-sm btn-warning" onclick="obtain' . $nombre . 'Data(' . $id . ')" data-bs-toggle="modal" data-bs-target="#update' . $nombre . 'Modal"><span class="fa-solid fa-pen-to-square"></span></span>'
                       .     $botonEliminar
                       . '</div></td>'
                       . "</tr>\n";
                    $n++;
                }
            ?>
        </tbody>
    </table>

    <script>
        initTablaEstudio(<?php echo json_encode($opcionesTabla, JSON_HEX_TAG | JSON_UNESCAPED_UNICODE);?>);
    </script>
