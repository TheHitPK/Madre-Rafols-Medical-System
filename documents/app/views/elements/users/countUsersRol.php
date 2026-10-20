<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/UsersModel.php";
    api_lectura();
    requerir_admin_api();

    $Users = new Users();
    $showCountUsersAdminData = $Users -> showCountUsersAdminData();
    $empleadosPorArea = array(array('Empleados Cardiología', 'bg-success', $Users -> showCountUsersAreaData(AREA_CARDIOLOGIA)),
                              array('Empleados Imágenes', 'bg-secondary', $Users -> showCountUsersAreaData(AREA_IMAGENES)));
?>

    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <tbody>
            <tr>
                <td>
                    <span class="badge text-light shadow bg-primary shadow" style="font-size: 15px; width: 200px;">
                        <i class='fa-solid fa-user-tie' aria-hidden="true"></i> Administradores
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
            <?php foreach ($empleadosPorArea as $fila) { ?>
            <tr>
                <td>
                    <span class="badge text-light shadow <?php echo $fila[1];?>" style="font-size: 15px; width: 200px;">
                        <i class='fa-solid fa-user' aria-hidden="true"></i> <?php echo e($fila[0]);?>
                    </span>
                </td>
                <td class="d-flex justify-content-end">
                    <?php echo (int)$fila[2];?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
