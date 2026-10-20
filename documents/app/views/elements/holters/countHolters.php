<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/HolterModel.php";
    api_lectura();

    $modelo = new Holters();
    $total = $modelo -> contar();
?>
<span><?php echo (int)$total[0][0];?></span>
