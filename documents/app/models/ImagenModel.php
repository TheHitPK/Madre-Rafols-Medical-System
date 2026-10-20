<?php
    require_once "EstudioModel.php";

    /*
     * ESTUDIOS DEL ÁREA DE IMÁGENES
     * Igual que ecos, holters y mapas, más el tipo de estudio (catálogo tipos_estudio)
     * y, opcionalmente, el informe médico (PDF o Word) guardado en INFORMES_DIR.
     */
    class Imagenes extends Estudio{
        protected $tabla           = "imagenes";
        protected $campoId         = "idImagen";
        protected $sufijo          = "imagen";
        protected $etiqueta        = "Estudio de imágenes";
        protected $longitudFactura = 20;

        public function area(){
            return AREA_IMAGENES;
        }

        public function camposExtra(){
            return array('idTipoEstudio');
        }

        protected function selectExtra(){
            return ", T.tipo_estudio, A.informe_nombre, A.informe_archivo";
        }

        protected function joinExtra(){
            return "INNER JOIN tipos_estudio T ON A.idTipoEstudio = T.idTipoEstudio";
        }

        public function contarPorTipo(){
            return Connection::connect() -> query("SELECT T.idTipoEstudio, T.tipo_estudio, COUNT(A.idImagen) AS total
                                                   FROM tipos_estudio T
                                                   LEFT JOIN imagenes A ON A.idTipoEstudio = T.idTipoEstudio AND A.eliminado_en IS NULL
                                                   GROUP BY T.idTipoEstudio, T.tipo_estudio
                                                   ORDER BY total DESC, T.tipo_estudio ASC") -> fetchAll(PDO::FETCH_ASSOC);
        }

        // ---------- INFORME MÉDICO ----------

        public function asignarInforme($id, $informe, $idUsuario){
            $query_informe = Connection::connect() -> prepare("UPDATE imagenes
                                                               SET informe_nombre = :nombre, informe_archivo = :archivo, informe_tamano = :tamano,
                                                                   informe_subido_por = :usuario, informe_subido_en = NOW()
                                                               WHERE idImagen = :id");
            $query_informe -> bindValue(":nombre", $informe['nombre'], PDO::PARAM_STR);
            $query_informe -> bindValue(":archivo", $informe['archivo'], PDO::PARAM_STR);
            $query_informe -> bindValue(":tamano", $informe['tamano'], PDO::PARAM_INT);
            $query_informe -> bindValue(":usuario", $idUsuario, PDO::PARAM_INT);
            $query_informe -> bindValue(":id", $id, PDO::PARAM_INT);
            return $query_informe -> execute();
        }

        public function quitarInforme($id){
            $query_informe = Connection::connect() -> prepare("UPDATE imagenes
                                                               SET informe_nombre = NULL, informe_archivo = NULL, informe_tamano = NULL,
                                                                   informe_subido_por = NULL, informe_subido_en = NULL
                                                               WHERE idImagen = :id");
            $query_informe -> bindValue(":id", $id, PDO::PARAM_INT);
            return $query_informe -> execute();
        }

        // ---------- AUDITORÍA ----------

        public function datosAuditables($fila){
            return array_merge(array('tipo_estudio' => $fila['tipo_estudio']),
                               parent::datosAuditables($fila),
                               array('informe' => (string)$fila['informe_nombre']));
        }

        public function describir($fila){
            $factura = $fila['factura_imagen'] !== '' ? "Factura " . $fila['factura_imagen'] : "Sin factura";
            return $fila['tipo_estudio'] . " - " . $factura . " - "
                 . mb_strtoupper(trim($fila['nombre_paciente_imagen'] . " " . $fila['apellido_paciente_imagen']), 'UTF-8')
                 . " (C.I. " . $fila['cedula_paciente_imagen'] . ") - " . $fila['fecha_imagen'];
        }
    }
?>
