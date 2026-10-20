<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/C_costoModel.php";
    api_lectura();
    requerir_admin_api();

    $C_costo = new C_costo();
    $showC_costoData = $C_costo -> listar();
?>
    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <caption class="visually-hidden">Centros de costo registrados</caption>
        <tbody>
            <?php
                foreach ($showC_costoData as $value) {
                    $idC_costo = (int)$value['idC_costo'];
            ?>
                    <tr>
                        <td><?php echo e($value['c_costo']);?></td>
                        <td class="d-flex justify-content-end">
                            <div class="btn-group shadow acciones-fila" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-sm btn-warning" onclick="obtainC_costoData(<?php echo $idC_costo;?>)" data-bs-toggle="modal" data-bs-target="#updateC_costoModal" title="Editar" aria-label="Editar <?php echo e($value['c_costo']);?>">
                                    <span class="fa-solid fa-pen-to-square" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteC_costoData(<?php echo $idC_costo;?>)" title="Eliminar" aria-label="Eliminar <?php echo e($value['c_costo']);?>">
                                    <span class="fa-solid fa-trash" aria-hidden="true"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
