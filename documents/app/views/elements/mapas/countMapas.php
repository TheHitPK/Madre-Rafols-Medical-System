<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/MapaModel.php";
    api_lectura();
    requerir_area_api(AREA_CARDIOLOGIA);

    $modelo = new Mapas();
    $total = $modelo -> contar();
?>
<span><?php echo (int)$total[0][0];?></span>
