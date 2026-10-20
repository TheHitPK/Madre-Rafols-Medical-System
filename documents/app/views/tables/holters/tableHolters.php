<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/HolterModel.php";
    api_lectura();

    $tablaEstudio = array('modelo'   => new Holters(),
                          'id'       => "tableHolters",
                          'nombre'   => "Holter",
                          'opciones' => array('titulo' => "Control Semanal de Holters", 'pdfEstilos' => true));
    include __DIR__ . "/../_tablaEstudio.php";
?>
