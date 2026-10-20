<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/catalogos.php";
    require_once __DIR__ . "/../../models/C_costoModel.php";

    catalogo_agregar(new C_costo, true);
?>
