<?php
    require_once "EstudioModel.php";

    class Ecos extends Estudio{
        protected $tabla           = "ecos";
        protected $campoId         = "idEco";
        protected $sufijo          = "eco";
        protected $etiqueta        = "Ecocardiograma";
        protected $longitudFactura = 20;
    }
?>
