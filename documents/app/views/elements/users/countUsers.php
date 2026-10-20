<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/UsersModel.php";
    api_lectura();
    requerir_admin_api();

    $modelo = new Users();
    $total = $modelo -> showCountUsersData();
?>
<span><?php echo (int)$total[0][0];?></span>
