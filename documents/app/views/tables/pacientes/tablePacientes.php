<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/PacientesModel.php";
    api_lectura();

    $termino = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
    $termino = function_exists('mb_substr') ? mb_substr($termino, 0, 60, 'UTF-8') : substr($termino, 0, 60);
    $longitud = function_exists('mb_strlen') ? mb_strlen($termino, 'UTF-8') : strlen($termino);

    if ($longitud < 3) {
        echo '<div class="alert alert-info mb-0"><i class="fa-solid fa-circle-info"></i> Escriba al menos 3 caracteres: la cédula completa o parte del nombre o apellido.</div>';
        exit;
    }

    $Pacientes = new Pacientes();
    $estudios  = $Pacientes -> historial($termino);
    $colores   = array('ecos' => 'bg-primary', 'holters' => 'bg-success', 'mapas' => 'bg-warning text-dark');
?>
    <?php if (count($estudios) === 500) { ?>
        <div class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation"></i> Se muestran los primeros 500 resultados. Afine la búsqueda.</div>
    <?php } ?>
    <table class="table table-hover text-center display compact nowrap animate__animated animate__fadeIn" style="width: 100%;" id="tablePacientes">
        <thead class="text-light" style="background-color: #001d3d;">
            <tr>
                <th class="text-center">Estudio</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Factura</th>
                <th class="text-center">Paciente</th>
                <th class="text-center">Cédula</th>
                <th class="text-center">Nº de historia</th>
                <th class="text-center">Centro de Costo</th>
                <th class="text-center">Médico</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($estudios as $estudio) {
                    echo '<tr>'
                       . '<td><span class="badge ' . $colores[$estudio['modulo']] . '">' . e($estudio['tipo']) . '</span></td>'
                       . '<td>' . e($estudio['fecha']) . '</td>'
                       . '<td>' . e($estudio['factura']) . '</td>'
                       . '<td class="text-uppercase">' . e($estudio['nombre'] . " " . $estudio['apellido']) . '</td>'
                       . '<td>' . e($estudio['cedula']) . '</td>'
                       . '<td>' . e($estudio['n_historia']) . '</td>'
                       . '<td class="text-uppercase">' . e($estudio['c_costo']) . '</td>'
                       . '<td class="text-uppercase">' . e($estudio['medico']) . '</td>'
                       . "</tr>\n";
                }
            ?>
        </tbody>
    </table>

    <script>
        initTablaSimple(<?php echo json_encode(array('id' => 'tablePacientes', 'titulo' => 'Historial de estudios - ' . $termino, 'orden' => array(array(1, 'desc'))), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);?>);
    </script>
