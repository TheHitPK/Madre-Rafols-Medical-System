<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/C_costoModel.php";
    api_lectura();
    requerir_admin_api();

    $modelo = new C_costo();
    $total = $modelo -> contar();
?>
<span><?php echo (int)$total[0][0];?></span>
