<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/EcoModel.php";
    api_lectura();

    $modelo = new Ecos();
    $total = $modelo -> contar();
?>
<span><?php echo (int)$total[0][0];?></span>
