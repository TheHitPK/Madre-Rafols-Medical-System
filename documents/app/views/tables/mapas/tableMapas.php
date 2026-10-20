<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/MapaModel.php";
    api_lectura();

    $tablaEstudio = array('modelo'   => new Mapas(),
                          'id'       => "tableMapas",
                          'nombre'   => "Mapa",
                          'opciones' => array('titulo' => "Control Semanal de Mapas", 'pdfEstilos' => true));
    include __DIR__ . "/../_tablaEstudio.php";
?>
