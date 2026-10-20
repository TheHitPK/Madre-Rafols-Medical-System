<?php
    require_once "EstudioModel.php";

    class Mapas extends Estudio{
        protected $tabla           = "mapas";
        protected $campoId         = "idMapa";
        protected $sufijo          = "mapa";
        protected $etiqueta        = "MAPA";
        protected $longitudFactura = 15;
    }
?>
