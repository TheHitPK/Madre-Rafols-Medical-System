<?php
    require_once "CatalogoModel.php";

    class Medicos extends Catalogo{
        protected $tabla   = "medicos";
        protected $campoId = "idMedico";
        protected $campo   = "medico";
    }
?>
