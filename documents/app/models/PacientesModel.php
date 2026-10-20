<?php
    require_once "Connection.php";

    /*
     * BÚSQUEDA DE PACIENTES EN TODOS LOS ESTUDIOS (ecos, holters, mapas, imágenes)
     * No existe una tabla de pacientes: la cédula no identifica a una sola persona
     * (hay menores registrados con la cédula de un familiar), así que cada estudio conserva
     * el nombre tal como se registró y aquí solo se consulta el historial.
     * $areas: áreas que el usuario puede ver (un empleado de Imágenes no ve los ecos, y al revés).
     */
    class Pacientes extends Connection{
        // Subconsulta que une los estudios de las áreas indicadas con columnas comunes (sin la papelera).
        private function estudiosUnidos($areas){
            $partes = array();
            if (in_array(AREA_CARDIOLOGIA, $areas, true)) {
                foreach (array('ecos' => array('idEco', 'eco', 'Ecocardiograma'),
                               'holters' => array('idHolter', 'holter', 'Holter'),
                               'mapas' => array('idMapa', 'mapa', 'MAPA')) as $tabla => $c) {
                    list($id, $s, $etiqueta) = $c;
                    $partes[] = "SELECT '$etiqueta' AS tipo, '$tabla' AS modulo, $id AS id,
                                        fecha_$s AS fecha, factura_$s AS factura,
                                        nombre_paciente_$s AS nombre, apellido_paciente_$s AS apellido,
                                        cedula_paciente_$s AS cedula, n_historia_paciente_$s AS n_historia,
                                        idC_costo, idMedico
                                 FROM $tabla WHERE eliminado_en IS NULL";
                }
            }
            if (in_array(AREA_IMAGENES, $areas, true)) {
                $partes[] = "SELECT T.tipo_estudio AS tipo, 'imagenes' AS modulo, I.idImagen AS id,
                                    I.fecha_imagen AS fecha, I.factura_imagen AS factura,
                                    I.nombre_paciente_imagen AS nombre, I.apellido_paciente_imagen AS apellido,
                                    I.cedula_paciente_imagen AS cedula, I.n_historia_paciente_imagen AS n_historia,
                                    I.idC_costo, I.idMedico
                             FROM imagenes I
                             INNER JOIN tipos_estudio T ON I.idTipoEstudio = T.idTipoEstudio
                             WHERE I.eliminado_en IS NULL";
            }
            if (count($partes) === 0) {
                return "(SELECT NULL AS tipo, NULL AS modulo, NULL AS id, NULL AS fecha, NULL AS factura, NULL AS nombre,
                                NULL AS apellido, NULL AS cedula, NULL AS n_historia, NULL AS idC_costo, NULL AS idMedico FROM DUAL WHERE 1 = 0)";
            }
            return "(" . implode(" UNION ALL ", $partes) . ")";
        }

        // Datos ya registrados para una cédula (distintas formas en que se escribió el nombre),
        // del uso más reciente al más antiguo. Sirve para autocompletar el formulario.
        public function datosPorCedula($cedula, $areas){
            $buscarSQL = "SELECT MAX(TRIM(E.nombre)) AS nombre, MAX(TRIM(E.apellido)) AS apellido,
                                 MAX(E.n_historia) AS n_historia, MAX(E.fecha) AS ultima_fecha, COUNT(*) AS estudios
                          FROM " . self::estudiosUnidos($areas) . " E
                          WHERE E.cedula = :cedula
                          GROUP BY UPPER(TRIM(E.nombre)), UPPER(TRIM(E.apellido))
                          ORDER BY ultima_fecha DESC
                          LIMIT 5";
            $query_buscar = Connection::connect() -> prepare($buscarSQL);
            $query_buscar -> bindValue(":cedula", $cedula, PDO::PARAM_INT);
            $query_buscar -> execute();
            return $query_buscar -> fetchAll(PDO::FETCH_ASSOC);
        }

        // Historial: por cédula exacta (solo dígitos) o por nombre/apellido (contiene el texto).
        public function historial($termino, $areas){
            $porCedula = ctype_digit($termino);
            $historialSQL = "SELECT E.tipo, E.modulo, E.id, E.fecha, E.factura, E.nombre, E.apellido, E.cedula, E.n_historia,
                                    B.c_costo, C.medico
                             FROM " . self::estudiosUnidos($areas) . " E
                             INNER JOIN c_costo B ON E.idC_costo = B.idC_costo
                             INNER JOIN medicos C ON E.idMedico = C.idMedico
                             WHERE " . ($porCedula
                                 ? "E.cedula = :termino"
                                 : "CONCAT(E.nombre, ' ', E.apellido) LIKE :termino OR CONCAT(E.apellido, ' ', E.nombre) LIKE :termino2") . "
                             ORDER BY E.fecha DESC, E.id DESC
                             LIMIT 500";
            $query_historial = Connection::connect() -> prepare($historialSQL);
            if ($porCedula) {
                $query_historial -> bindValue(":termino", (int)$termino, PDO::PARAM_INT);
            } else {
                $patron = "%" . str_replace(array('\\', '%', '_'), array('\\\\', '\\%', '\\_'), $termino) . "%";
                $query_historial -> bindValue(":termino", $patron, PDO::PARAM_STR);
                $query_historial -> bindValue(":termino2", $patron, PDO::PARAM_STR);
            }
            $query_historial -> execute();
            return $query_historial -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
