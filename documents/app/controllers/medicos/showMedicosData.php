<?php
    // Incluido desde las vistas (que ya validaron la sesión) para llenar los <select> de médicos.
    require_once __DIR__ . "/../../models/MedicosModel.php";

    $Medicos = new Medicos();
    $showMedicosData = $Medicos -> listar();
?>
