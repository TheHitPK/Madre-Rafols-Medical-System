<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/ImagenModel.php";
    api_lectura();
    requerir_area_api(AREA_IMAGENES);

    // Cada tipo con la cantidad de estudios registrados (los que tienen estudios no se pueden eliminar).
    $Imagenes = new Imagenes();
    $tipos = $Imagenes -> contarPorTipo();
?>
    <table class="table display compact text-light" style="border-color: #001d3d;">
        <caption class="visually-hidden">Tipos de estudio registrados</caption>
        <tbody>
            <?php
                foreach ($tipos as $value) {
                    $idTipo = (int)$value['idTipoEstudio'];
            ?>
                    <tr>
                        <td><?php echo e($value['tipo_estudio']);?> <span class="badge bg-light text-dark ms-1" title="Estudios registrados"><?php echo (int)$value['total'];?></span></td>
                        <td class="d-flex justify-content-end">
                            <div class="btn-group shadow acciones-fila" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-sm btn-warning" onclick="obtainTipoEstudioData(<?php echo $idTipo;?>)" data-bs-toggle="modal" data-bs-target="#updateTipoEstudioModal" title="Editar" aria-label="Editar <?php echo e($value['tipo_estudio']);?>">
                                    <span class="fa-solid fa-pen-to-square" aria-hidden="true"></span>
                                </button>
                                <?php if (es_admin()) { ?>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteTipoEstudioData(<?php echo $idTipo;?>)" title="Eliminar" aria-label="Eliminar <?php echo e($value['tipo_estudio']);?>">
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
