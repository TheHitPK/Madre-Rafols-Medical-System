<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../core/estudios.php";
    api_lectura();
    requerir_admin_api();

    $Auditoria = new Auditoria();
    $movimientos = $Auditoria -> listar(2000);

    // Estudios que siguen en la papelera (para ofrecer "Restaurar" solo donde corresponde).
    $enPapelera = array();
    foreach (modelos_estudio() as $tabla => $modelo) {
        $enPapelera[$tabla] = array_flip($modelo -> idsEliminados());
    }

    $acciones = array('crear'           => array('Creado', 'bg-success'),
                      'editar'          => array('Editado', 'bg-warning text-dark'),
                      'eliminar'        => array('Eliminado', 'bg-danger'),
                      'restaurar'       => array('Restaurado', 'bg-info text-dark'),
                      'activar'         => array('Activado', 'bg-success'),
                      'desactivar'      => array('Desactivado', 'bg-secondary'),
                      'login'           => array('Inicio de sesión', 'bg-light text-dark'),
                      'login_fallido'   => array('Login fallido', 'bg-danger'),
                      'login_inactivo'  => array('Login inactivo', 'bg-secondary'),
                      'login_bloqueado' => array('Login bloqueado', 'bg-dark'),
                      'ver_informe'     => array('Informe consultado', 'bg-light text-dark'));
    $modulos  = array('ecos' => 'Ecos', 'holters' => 'Holters', 'mapas' => 'Mapas', 'usuarios' => 'Usuarios',
                      'medicos' => 'Médicos', 'c_costo' => 'Centros de costo', 'sesion' => 'Sesión',
                      'imagenes' => 'Imágenes', 'tipos_estudio' => 'Tipos de estudio');
    $campos   = array('fecha' => 'Fecha', 'factura' => 'Factura', 'nombre' => 'Nombre', 'apellido' => 'Apellido',
                      'cedula' => 'Cédula', 'n_historia' => 'Nº historia', 'centro_costo' => 'Centro de costo', 'medico' => 'Médico',
                      'nombre_usuario' => 'Nombre', 'apellido_usuario' => 'Apellido', 'cedula_usuario' => 'Cédula',
                      'usuario' => 'Usuario', 'rol' => 'Rol', 'estado' => 'Estado', 'contraseña' => 'Contraseña',
                      'tipo_estudio' => 'Tipo de estudio', 'informe' => 'Informe médico', 'departamento' => 'Área');
    $ocultos  = array('idUsuario', 'idRol', 'idEstado', 'idDepartamento');
    $ofrecidos = array();
?>
    <table class="table table-hover display compact animate__animated animate__fadeIn" style="width: 100%;" id="tableAuditoria">
        <thead class="text-light" style="background-color: #001d3d;">
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Módulo</th>
                <th>Detalle</th>
                <th>Equipo (IP)</th>
                <th><span class="visually-hidden">Acciones</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($movimientos as $m) {
                    $accion = isset($acciones[$m['accion']]) ? $acciones[$m['accion']] : array($m['accion'], 'bg-light text-dark');
                    $detalle = e($m['descripcion']);

                    // En las ediciones se muestran los campos que cambiaron.
                    if ($m['accion'] === 'editar' && $m['datos_antes'] !== null && $m['datos_despues'] !== null) {
                        $lista = array();
                        foreach (diferencias(json_decode($m['datos_antes'], true), json_decode($m['datos_despues'], true)) as $campo => $valores) {
                            if (in_array($campo, $ocultos, true)) {
                                continue;
                            }
                            $nombreCampo = isset($campos[$campo]) ? $campos[$campo] : $campo;
                            $lista[] = '<li><strong>' . e($nombreCampo) . ':</strong> ' . e($valores[0]) . ' <i class="fa-solid fa-arrow-right" role="img" aria-label="cambió a"></i>' . e($valores[1]) . '</li>';
                        }
                        if (count($lista) > 0) {
                            $detalle .= '<ul class="mb-0 small">' . implode('', $lista) . '</ul>';
                        }
                    }

                    // "Restaurar" solo en la eliminación más reciente de un estudio que sigue en la papelera.
                    $boton = '';
                    $clave = $m['modulo'] . ':' . $m['registro_id'];
                    if ($m['accion'] === 'eliminar' && isset($enPapelera[$m['modulo']][(int)$m['registro_id']]) && !isset($ofrecidos[$clave])) {
                        $ofrecidos[$clave] = true;
                        $boton = '<button type="button" class="btn btn-sm btn-info text-dark shadow" onclick="restaurarEstudio(\'' . e($m['modulo']) . '\', ' . (int)$m['registro_id'] . ')"><i class="fa-solid fa-trash-arrow-up" aria-hidden="true"></i> Restaurar</button>';
                    }

                    echo '<tr>'
                       . '<td data-order="' . (int)$m['idAuditoria'] . '">' . e($m['fecha']) . '</td>'
                       . '<td>' . e($m['usuario']) . '</td>'
                       . '<td><span class="badge ' . $accion[1] . '">' . e($accion[0]) . '</span></td>'
                       . '<td>' . e(isset($modulos[$m['modulo']]) ? $modulos[$m['modulo']] : $m['modulo']) . '</td>'
                       . '<td style="white-space: normal;">' . $detalle . '</td>'
                       . '<td>' . e($m['ip']) . '</td>'
                       . '<td>' . $boton . '</td>'
                       . "</tr>\n";
                }
            ?>
        </tbody>
    </table>

    <script>
        initTablaSimple({ id: 'tableAuditoria', titulo: 'Registro de auditoría', orden: [[0, 'desc']] });
    </script>
