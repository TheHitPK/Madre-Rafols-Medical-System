<?php
    // Incluido desde la vista de usuarios (que ya validó la sesión) para llenar los <select> de roles.
    require_once __DIR__ . "/../../models/UsersModel.php";

    $Users = new Users;
    $showRoleData = $Users -> showRoleData();
?>
