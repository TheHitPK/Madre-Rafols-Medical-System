<?php
    require_once __DIR__ . "/../../core/bootstrap.php";
    require_once __DIR__ . "/../../core/catalogos.php";
    require_once __DIR__ . "/../../models/TiposEstudioModel.php";

    catalogo_eliminar(new TiposEstudio);
?>
