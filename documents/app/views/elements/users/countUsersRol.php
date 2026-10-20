<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/UsersModel.php";
    api_lectura();
    requerir_admin_api();

    $Users = new Users();
    $showCountUsersAdminData = $Users -> showCountUsersAdminData();
    $showCountUsersEmpleadosData = $Users -> showCountUsersEmpleadosData();
?>

    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <tbody>
            <tr>
                <td>
                    <span class="badge text-light shadow bg-primary shadow" style="font-size: 15px; width: 140px;">
                        <i class='fa-solid fa-user-tie'></i> Administrador
                    </span>
                </td>
                <td class="d-flex justify-content-end">
                    <?php
                        foreach ($showCountUsersAdminData as $key => $value) {
                            echo (int)$value[0];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="badge text-light shadow bg-success shadow" style="font-size: 15px; width: 140px;">
                        <i class='fa-solid fa-user'></i> Empleado(s)
                    </span>
                </td>
                <td class="d-flex justify-content-end">
                    <?php
                        foreach ($showCountUsersEmpleadosData as $key => $value) {
                            echo (int)$value[0];
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

