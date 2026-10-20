<?php
    // Opciones de los <select> de tipo de estudio: se recargan después de agregar o editar un tipo.
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/TiposEstudioModel.php";
    api_lectura();
    requerir_area_api(AREA_IMAGENES);

    $TiposEstudio = new TiposEstudio();
?>
<option value="">Seleccione...</option>
<?php foreach ($TiposEstudio -> listar() as $value) { ?>
<option value="<?php echo (int)$value['idTipoEstudio'];?>"><?php echo e($value['tipo_estudio']);?></option>
<?php } ?>
