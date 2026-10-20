<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/MedicosModel.php";
    api_lectura();

    $Medicos = new Medicos();
    $showMedicosData = $Medicos -> listar();
?>
    <table class="table display compact nowrap text-light" style="border-color: #001d3d;">
        <caption class="visually-hidden">Médicos registrados</caption>
        <tbody>
            <?php
                foreach ($showMedicosData as $value) {
                    $idMedico = (int)$value['idMedico'];
            ?>
                    <tr>
                        <td><?php echo e($value['medico']);?></td>
                        <td class="d-flex justify-content-end">
                            <div class="btn-group shadow acciones-fila" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-sm btn-warning" onclick="obtainMedicoData(<?php echo $idMedico;?>)" data-bs-toggle="modal" data-bs-target="#updateMedicoModal" title="Editar" aria-label="Editar <?php echo e($value['medico']);?>">
                                    <span class="fa-solid fa-pen-to-square" aria-hidden="true"></span>
                                </button>
                                <?php if (es_admin()) { ?>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteMedicoData(<?php echo $idMedico;?>)" title="Eliminar" aria-label="Eliminar <?php echo e($value['medico']);?>">
                                        <span class="fa-solid fa-trash" aria-hidden="true"></span>
                                    </button>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
