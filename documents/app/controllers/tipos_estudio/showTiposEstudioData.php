<?php
    // Incluido desde las vistas (que ya validaron la sesión) para llenar los <select> de tipos de estudio.
    require_once __DIR__ . "/../../models/TiposEstudioModel.php";

    $TiposEstudio = new TiposEstudio();
    $showTiposEstudioData = $TiposEstudio -> listar();
?>
