<?php
    require_once "Connection.php";

    /*
     * MODELO COMÚN DE ESTUDIOS (ecos, holters, mapas, imágenes)
     * Las tablas tienen la misma estructura y solo cambia el sufijo de las columnas
     * (factura_eco, factura_holter, factura_mapa...). Cada modelo hijo define su tabla y sufijo.
     * Un módulo con datos propios (Imágenes: tipo de estudio) los declara en camposExtra(),
     * selectExtra() y joinExtra().
     *
     * Los estudios no se borran físicamente: "eliminar" los manda a la papelera (eliminado_en)
     * y un administrador puede restaurarlos desde Auditoría.
     */
    abstract class Estudio extends Connection{
        protected $tabla;           // ecos
        protected $campoId;         // idEco
        protected $sufijo;          // eco
        protected $etiqueta;        // Ecocardiograma
        protected $longitudFactura; // tamaño de la columna factura_*
        protected $ultimoId = 0;

        public function tabla(){
            return $this -> tabla;
        }

        public function campoId(){
            return $this -> campoId;
        }

        public function sufijo(){
            return $this -> sufijo;
        }

        public function etiqueta(){
            return $this -> etiqueta;
        }

        public function longitudFactura(){
            return $this -> longitudFactura;
        }

        public function ultimoId(){
            return $this -> ultimoId;
        }

        // Área a la que pertenece el módulo (quién puede verlo).
        public function area(){
            return AREA_CARDIOLOGIA;
        }

        // Columnas enteras adicionales que llegan del formulario con el mismo nombre (idTipoEstudio).
        public function camposExtra(){
            return array();
        }

        // Columnas y uniones adicionales para el listado y el formulario de edición.
        protected function selectExtra(){
            return "";
        }

        protected function joinExtra(){
            return "";
        }

        public function columna($nombre){
            $s = $this -> sufijo;
            $columnas = array('factura'    => "factura_$s",
                              'fecha'      => "fecha_$s",
                              'nombre'     => "nombre_paciente_$s",
                              'apellido'   => "apellido_paciente_$s",
                              'cedula'     => "cedula_paciente_$s",
                              'n_historia' => "n_historia_paciente_$s");
            return $columnas[$nombre];
        }

        // Listado para la tabla, con nombres de columna genéricos. No incluye la papelera.
        public function listar(){
            $listarSQL = "SELECT A.{$this->campoId} AS id,
                                 A.{$this->columna('factura')} AS factura,
                                 A.{$this->columna('fecha')} AS fecha,
                                 A.{$this->columna('nombre')} AS nombre,
                                 A.{$this->columna('apellido')} AS apellido,
                                 A.{$this->columna('cedula')} AS cedula,
                                 A.{$this->columna('n_historia')} AS n_historia,
                                 A.marcado,
                                 A.marcado_en,
                                 M.usuario AS marcado_por,
                                 B.c_costo,
                                 C.medico
                                 {$this->selectExtra()}
                          FROM {$this->tabla} A
                          INNER JOIN c_costo B ON A.idC_costo = B.idC_costo
                          INNER JOIN medicos C ON A.idMedico = C.idMedico
                          {$this->joinExtra()}
                          LEFT JOIN usuarios M ON A.marcado_por = M.idUsuario
                          WHERE A.eliminado_en IS NULL
                          ORDER BY A.{$this->columna('fecha')} ASC, A.{$this->campoId} ASC";
            return Connection::connect() -> query($listarSQL) -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function contar(){
            return Connection::connect() -> query("SELECT COUNT(*) FROM {$this->tabla} WHERE eliminado_en IS NULL") -> fetchAll();
        }

        // Una misma factura no puede repetirse para el mismo paciente (sin contar la papelera).
        public function existeFactura($cedula, $factura, $idExcluir = 0){
            if ($factura === '') {
                return false; // la factura es opcional; sin factura no hay nada que comparar
            }
            $existeSQL = "SELECT COUNT(*)
                          FROM {$this->tabla}
                          WHERE {$this->columna('cedula')} = :cedula
                          AND {$this->columna('factura')} = :factura
                          AND {$this->campoId} <> :id
                          AND eliminado_en IS NULL";
            $query_existe = Connection::connect() -> prepare($existeSQL);
            $query_existe -> bindValue(":cedula", $cedula, PDO::PARAM_INT);
            $query_existe -> bindValue(":factura", $factura, PDO::PARAM_STR);
            $query_existe -> bindValue(":id", $idExcluir, PDO::PARAM_INT);
            $query_existe -> execute();
            return (int)$query_existe -> fetchColumn() > 0;
        }

        // Respuestas: 1 = guardado, 2 = factura repetida, 0 = error
        public function agregar($datos, $idUsuario){
            if (self::existeFactura($datos['cedula'], $datos['factura'])) {
                return 2;
            }
            $columnasExtra = "";
            $valoresExtra  = "";
            foreach ($this -> camposExtra() as $campo) {
                $columnasExtra .= "$campo, ";
                $valoresExtra  .= ":$campo, ";
            }
            $agregarSQL = "INSERT INTO {$this->tabla} ({$columnasExtra}idC_costo,
                                                       idMedico,
                                                       {$this->columna('factura')},
                                                       {$this->columna('fecha')},
                                                       {$this->columna('nombre')},
                                                       {$this->columna('apellido')},
                                                       {$this->columna('cedula')},
                                                       {$this->columna('n_historia')},
                                                       creado_por,
                                                       creado_en)
                           VALUES ({$valoresExtra}:idC_costo, :idMedico, :factura, :fecha, :nombre, :apellido, :cedula, :n_historia, :usuario, NOW())";
            $query_agregar = Connection::connect() -> prepare($agregarSQL);
            self::bindDatos($query_agregar, $datos);
            $query_agregar -> bindValue(":usuario", $idUsuario, PDO::PARAM_INT);
            if (!$query_agregar -> execute()) {
                return 0;
            }
            $this -> ultimoId = (int)Connection::connect() -> lastInsertId();
            return 1;
        }

        // Devuelve las columnas con su nombre real (factura_eco, ...) porque así las usa el JS del formulario de edición,
        // más quién creó y modificó el registro.
        public function obtener($id, $incluirEliminados = false){
            $obtenerSQL = "SELECT A.*, B.c_costo, C.medico,
                                  U1.usuario AS creado_por_usuario,
                                  U2.usuario AS modificado_por_usuario
                                  {$this->selectExtra()}
                           FROM {$this->tabla} A
                           INNER JOIN c_costo B ON A.idC_costo = B.idC_costo
                           INNER JOIN medicos C ON A.idMedico = C.idMedico
                           {$this->joinExtra()}
                           LEFT JOIN usuarios U1 ON A.creado_por = U1.idUsuario
                           LEFT JOIN usuarios U2 ON A.modificado_por = U2.idUsuario
                           WHERE A.{$this->campoId} = :id"
                           . ($incluirEliminados ? "" : " AND A.eliminado_en IS NULL");
            $query_obtener = Connection::connect() -> prepare($obtenerSQL);
            $query_obtener -> bindValue(":id", $id, PDO::PARAM_INT);
            $query_obtener -> execute();
            return $query_obtener -> fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($datos, $idUsuario){
            if (self::existeFactura($datos['cedula'], $datos['factura'], $datos['id'])) {
                return 2;
            }
            $asignacionesExtra = "";
            foreach ($this -> camposExtra() as $campo) {
                $asignacionesExtra .= "$campo = :$campo, ";
            }
            $actualizarSQL = "UPDATE {$this->tabla}
                              SET {$asignacionesExtra}idC_costo    = :idC_costo,
                                  idMedico                         = :idMedico,
                                  {$this->columna('factura')}      = :factura,
                                  {$this->columna('fecha')}        = :fecha,
                                  {$this->columna('nombre')}       = :nombre,
                                  {$this->columna('apellido')}     = :apellido,
                                  {$this->columna('cedula')}       = :cedula,
                                  {$this->columna('n_historia')}   = :n_historia,
                                  modificado_por                   = :usuario,
                                  modificado_en                    = NOW()
                              WHERE {$this->campoId} = :id
                              AND eliminado_en IS NULL";
            $query_actualizar = Connection::connect() -> prepare($actualizarSQL);
            self::bindDatos($query_actualizar, $datos);
            $query_actualizar -> bindValue(":usuario", $idUsuario, PDO::PARAM_INT);
            $query_actualizar -> bindValue(":id", $datos['id'], PDO::PARAM_INT);
            return $query_actualizar -> execute() ? 1 : 0;
        }

        // Envía el estudio a la papelera.
        public function eliminar($id, $idUsuario){
            $query_eliminar = Connection::connect() -> prepare("UPDATE {$this->tabla}
                                                                SET eliminado_en = NOW(), eliminado_por = :usuario
                                                                WHERE {$this->campoId} = :id AND eliminado_en IS NULL");
            $query_eliminar -> bindValue(":usuario", $idUsuario, PDO::PARAM_INT);
            $query_eliminar -> bindValue(":id", $id, PDO::PARAM_INT);
            $query_eliminar -> execute();
            return $query_eliminar -> rowCount() === 1 ? 1 : 0;
        }

        // Saca el estudio de la papelera. Respuestas: 1 = restaurado, 2 = su factura ya fue registrada de nuevo, 0 = no está en la papelera
        public function restaurar($id){
            $estudio = self::obtener($id, true);
            if (!$estudio || $estudio['eliminado_en'] === null) {
                return 0;
            }
            if (self::existeFactura((int)$estudio[$this -> columna('cedula')], (string)$estudio[$this -> columna('factura')], $id)) {
                return 2;
            }
            $query_restaurar = Connection::connect() -> prepare("UPDATE {$this->tabla}
                                                                 SET eliminado_en = NULL, eliminado_por = NULL
                                                                 WHERE {$this->campoId} = :id");
            $query_restaurar -> bindValue(":id", $id, PDO::PARAM_INT);
            return $query_restaurar -> execute() ? 1 : 0;
        }

        // Ids de los estudios que están en la papelera.
        public function idsEliminados(){
            return array_map('intval', Connection::connect() -> query("SELECT {$this->campoId} FROM {$this->tabla} WHERE eliminado_en IS NOT NULL") -> fetchAll(PDO::FETCH_COLUMN));
        }

        // Marca compartida (checkbox). Todos los equipos ven la misma.
        public function marcar($id, $marcado, $idUsuario){
            $query_marcar = Connection::connect() -> prepare("UPDATE {$this->tabla}
                                                              SET marcado = :marcado, marcado_por = :usuario, marcado_en = NOW()
                                                              WHERE {$this->campoId} = :id AND eliminado_en IS NULL");
            $query_marcar -> bindValue(":marcado", $marcado ? 1 : 0, PDO::PARAM_INT);
            $query_marcar -> bindValue(":usuario", $idUsuario, PDO::PARAM_INT);
            $query_marcar -> bindValue(":id", $id, PDO::PARAM_INT);
            $query_marcar -> execute();
            return $query_marcar -> rowCount() === 1 ? 1 : 0;
        }

        // Importación única de las marcas que cada navegador tenía guardadas localmente: solo marca, nunca desmarca.
        public function marcarVarios($ids, $idUsuario){
            if (count($ids) === 0) {
                return 0;
            }
            $marcadores = implode(",", array_fill(0, count($ids), "?"));
            $query_marcar = Connection::connect() -> prepare("UPDATE {$this->tabla}
                                                              SET marcado = 1, marcado_por = ?, marcado_en = NOW()
                                                              WHERE marcado = 0 AND eliminado_en IS NULL AND {$this->campoId} IN ($marcadores)");
            $query_marcar -> execute(array_merge(array($idUsuario), $ids));
            return $query_marcar -> rowCount();
        }

        // ---------- AUDITORÍA ----------

        // Datos legibles del estudio (a partir de una fila de obtener()) para el historial.
        public function datosAuditables($fila){
            return array('fecha'        => $fila[$this -> columna('fecha')],
                         'factura'      => $fila[$this -> columna('factura')],
                         'nombre'       => $fila[$this -> columna('nombre')],
                         'apellido'     => $fila[$this -> columna('apellido')],
                         'cedula'       => (string)$fila[$this -> columna('cedula')],
                         'n_historia'   => (string)$fila[$this -> columna('n_historia')],
                         'centro_costo' => $fila['c_costo'],
                         'medico'       => $fila['medico']);
        }

        public function describir($fila){
            $factura = $fila[$this -> columna('factura')] !== '' ? "Factura " . $fila[$this -> columna('factura')] : "Sin factura";
            return $this -> etiqueta . " - " . $factura . " - "
                 . mb_strtoupper(trim($fila[$this -> columna('nombre')] . " " . $fila[$this -> columna('apellido')]), 'UTF-8')
                 . " (C.I. " . $fila[$this -> columna('cedula')] . ") - " . $fila[$this -> columna('fecha')];
        }

        private function bindDatos($query, $datos){
            $query -> bindValue(":idC_costo", $datos['idC_costo'], PDO::PARAM_INT);
            $query -> bindValue(":idMedico", $datos['idMedico'], PDO::PARAM_INT);
            $query -> bindValue(":factura", $datos['factura'], PDO::PARAM_STR);
            $query -> bindValue(":fecha", $datos['fecha'], PDO::PARAM_STR);
            $query -> bindValue(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $query -> bindValue(":apellido", $datos['apellido'], PDO::PARAM_STR);
            $query -> bindValue(":cedula", $datos['cedula'], PDO::PARAM_INT);
            $query -> bindValue(":n_historia", $datos['n_historia'], PDO::PARAM_INT);
            foreach ($this -> camposExtra() as $campo) {
                $query -> bindValue(":$campo", $datos[$campo], PDO::PARAM_INT);
            }
        }
    }
?>
