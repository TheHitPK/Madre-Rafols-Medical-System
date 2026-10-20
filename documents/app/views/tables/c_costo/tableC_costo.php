<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/C_costoModel.php";
    api_lectura();
    requerir_admin_api();

    $C_costo = new C_costo();
    $showC_costoData = $C_costo -> listar();
?>
    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <tbody>
            <?php
                foreach ($showC_costoData as $value) {
                    $idC_costo = (int)$value['idC_costo'];
            ?>
                    <tr>
                        <td><?php echo e($value['c_costo']);?></td>
                        <td class="d-flex justify-content-end">
                            <div class="btn-group shadow">
                                <span class="btn btn-sm btn-warning" onclick="obtainC_costoData(<?php echo $idC_costo;?>)" data-bs-toggle="modal" data-bs-target="#updateC_costoModal">
                                    <span class="fa-solid fa-pen-to-square"></span>
                                </span>
                                <span class="btn btn-sm btn-danger" onclick="deleteC_costoData(<?php echo $idC_costo;?>)" style="width: 35px;">
                                    <span class="fa-solid fa-trash"></span>
                                </span>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
