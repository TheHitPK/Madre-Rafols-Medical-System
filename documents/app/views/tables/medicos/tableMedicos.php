<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/MedicosModel.php";
    api_lectura();

    $Medicos = new Medicos();
    $showMedicosData = $Medicos -> listar();
?>
    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <tbody>
            <?php
                foreach ($showMedicosData as $value) {
                    $idMedico = (int)$value['idMedico'];
            ?>
                    <tr>
                        <td><?php echo e($value['medico']);?></td>
                        <td class="d-flex justify-content-end">
                            <div class="btn-group shadow">
                                <span class="btn btn-sm btn-warning" onclick="obtainMedicoData(<?php echo $idMedico;?>)" data-bs-toggle="modal" data-bs-target="#updateMedicoModal">
                                    <span class="fa-solid fa-pen-to-square"></span>
                                </span>
                                <?php if (es_admin()) { ?>
                                    <span class="btn btn-sm btn-danger" onclick="deleteMedicoData(<?php echo $idMedico;?>)" style="width: 35px;">
                                        <span class="fa-solid fa-trash"></span>
                                    </span>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
