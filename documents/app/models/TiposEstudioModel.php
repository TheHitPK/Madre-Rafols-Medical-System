<?php
    require_once "CatalogoModel.php";

    // Catálogo de tipos de estudio del área de Imágenes (Rayos X, Ecografía, ...).
    class TiposEstudio extends Catalogo{
        protected $tabla   = "tipos_estudio";
        protected $campoId = "idTipoEstudio";
        protected $campo   = "tipo_estudio";

        public function area(){
            return AREA_IMAGENES;
        }
    }
?>
