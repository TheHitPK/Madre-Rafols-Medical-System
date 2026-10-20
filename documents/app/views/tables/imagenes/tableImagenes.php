<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/ImagenModel.php";
    api_lectura();

    $tablaEstudio = array('modelo'   => new Imagenes(),
                          'id'       => "tableImagenes",
                          'nombre'   => "Imagen",
                          'opciones' => array('titulo' => "Control de Estudios de Imágenes", 'departamento' => "Imágenes", 'pdfEstilos' => true, 'pdfFontSize' => 6));
    include __DIR__ . "/../_tablaEstudio.php";
?>
