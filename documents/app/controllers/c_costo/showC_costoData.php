<?php
    // Incluido desde las vistas (que ya validaron la sesión) para llenar los <select> de centros de costo.
    require_once __DIR__ . "/../../models/C_costoModel.php";

    $C_costo = new C_costo();
    $showC_costoData = $C_costo -> listar();
?>
