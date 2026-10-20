<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/EcoModel.php";
    api_lectura();

    $tablaEstudio = array('modelo'   => new Ecos(),
                          'id'       => "tableEcos",
                          'nombre'   => "Eco",
                          'opciones' => array('titulo' => "Control Semanal de Ecocardiogramas", 'pdfEstilos' => true, 'pdfFontSize' => 5, 'pdfSaltoEncabezado' => true));
    include __DIR__ . "/../_tablaEstudio.php";
?>
