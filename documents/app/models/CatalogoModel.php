<?php
    require_once "Connection.php";

    /*
     * MODELO COMÚN DE CATÁLOGOS SIMPLES (centros de costo, médicos, tipos de estudio): una tabla con id + nombre.
     */
    abstract class Catalogo extends Connection{
        protected $tabla;    // medicos
        protected $campoId;  // idMedico
        protected $campo;    // medico

        public function campoId(){
            return $this -> campoId;
        }

        public function tabla(){
            return $this -> tabla;
        }

        public function campo(){
            return $this -> campo;
        }

        // Área dueña del catálogo; null = compartido por todas (médicos, centros de costo).
        public function area(){
            return null;
        }

        public function listar(){
            return Connection::connect() -> query("SELECT {$this->campoId}, {$this->campo} FROM {$this->tabla} ORDER BY {$this->campo} ASC") -> fetchAll();
        }

        public function contar(){
            return Connection::connect() -> query("SELECT COUNT(*) FROM {$this->tabla}") -> fetchAll();
        }

        // true si ya existe otro registro con el mismo nombre (sin distinguir mayúsculas ni espacios extremos).
        public function existe($nombre, $idExcluir = 0){
            $query_existe = Connection::connect() -> prepare("SELECT COUNT(*) FROM {$this->tabla}
                                                              WHERE TRIM({$this->campo}) = :nombre
                                                              AND {$this->campoId} <> :id");
            $query_existe -> bindValue(":nombre", $nombre, PDO::PARAM_STR);
            $query_existe -> bindValue(":id", $idExcluir, PDO::PARAM_INT);
            $query_existe -> execute();
            return (int)$query_existe -> fetchColumn() > 0;
        }

        // Respuestas: 1 = guardado, 2 = repetido, 0 = error
        public function agregar($nombre){
            if (self::existe($nombre)) {
                return 2;
            }
            $query_agregar = Connection::connect() -> prepare("INSERT INTO {$this->tabla} ({$this->campo}) VALUES (:nombre)");
            $query_agregar -> bindValue(":nombre", $nombre, PDO::PARAM_STR);
            return $query_agregar -> execute() ? 1 : 0;
        }

        public function obtener($id){
            $query_obtener = Connection::connect() -> prepare("SELECT {$this->campoId}, {$this->campo} FROM {$this->tabla} WHERE {$this->campoId} = :id");
            $query_obtener -> bindValue(":id", $id, PDO::PARAM_INT);
            $query_obtener -> execute();
            return $query_obtener -> fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($id, $nombre){
            if (self::existe($nombre, $id)) {
                return 2;
            }
            $query_actualizar = Connection::connect() -> prepare("UPDATE {$this->tabla} SET {$this->campo} = :nombre WHERE {$this->campoId} = :id");
            $query_actualizar -> bindValue(":nombre", $nombre, PDO::PARAM_STR);
            $query_actualizar -> bindValue(":id", $id, PDO::PARAM_INT);
            return $query_actualizar -> execute() ? 1 : 0;
        }

        // Respuestas: 1 = eliminado, 3 = tiene estudios asociados (no se puede borrar), 0 = error
        public function eliminar($id){
            try {
                $query_eliminar = Connection::connect() -> prepare("DELETE FROM {$this->tabla} WHERE {$this->campoId} = :id");
                $query_eliminar -> bindValue(":id", $id, PDO::PARAM_INT);
                return $query_eliminar -> execute() ? 1 : 0;
            } catch (PDOException $exception) {
                if ($exception -> getCode() === '23000') { // violación de clave foránea
                    return 3;
                }
                throw $exception;
            }
        }
    }
?>
