<?php
    require_once "EstudioModel.php";

    class Holters extends Estudio{
        protected $tabla           = "holters";
        protected $campoId         = "idHolter";
        protected $sufijo          = "holter";
        protected $etiqueta        = "Holter";
        protected $longitudFactura = 15;
    }
?>
