<!-- Modal: editar estudio de imágenes -->
<div class="modal fade" id="updateImagenModal" tabindex="-1" aria-labelledby="updateImagenModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5" id="updateImagenModalLabel">
					<i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Editar estudio
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
      		</div>

			<form id="updateImagenForm" onsubmit="return updateImagenData()" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idImagen" id="idImagen">
				<div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha_imagen_update" class="form-label mb-1">Fecha:</label>
                            <input type="date" name="fecha_imagen_update" id="fecha_imagen_update" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="factura_imagen_update" class="form-label mb-1">Factura:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="20" autocomplete="off" title="Solo números" name="factura_imagen_update" id="factura_imagen_update" class="form-control" placeholder="Número de factura">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idTipoEstudio_update" class="form-label mb-1">Tipo de estudio:</label>
                            <select class="form-select select-tipo-estudio" name="idTipoEstudio_update" id="idTipoEstudio_update" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showTiposEstudioData as $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idC_costo_update" class="form-label mb-1">Centro de costo:</label>
                            <select class="form-select" name="idC_costo_update" id="idC_costo_update" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showC_costoData as $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nombre_paciente_imagen_update" class="form-label mb-1">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_imagen_update" id="nombre_paciente_imagen_update" class="form-control" maxlength="100" placeholder="Nombre del paciente" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente_imagen_update" class="form-label mb-1">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_imagen_update" id="apellido_paciente_imagen_update" class="form-control" maxlength="100" placeholder="Apellido del paciente" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente_imagen_update" class="form-label mb-1">Cédula del paciente:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_paciente_imagen_update" id="cedula_paciente_imagen_update" class="form-control" placeholder="Cédula del paciente" required>
                        </div>
                        <div class="col">
                            <label for="n_historia_paciente_imagen_update" class="form-label mb-1">Nº de historia:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="n_historia_paciente_imagen_update" id="n_historia_paciente_imagen_update" class="form-control" placeholder="Número de historia">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idMedico_update" class="form-label mb-1">Médico:</label>
                            <select class="form-select" name="idMedico_update" id="idMedico_update" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showMedicosData as $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2" id="informe_actual_imagen" aria-live="polite"></div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="informe_update" class="form-label mb-1">Reemplazar informe médico:</label>
                            <input type="file" name="informe_update" id="informe_update" class="form-control" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" aria-describedby="ayudaInforme_update">
                            <div class="form-text" id="ayudaInforme_update">PDF o Word (.doc, .docx), hasta <?php echo (int)INFORME_MAX_MB;?> MB. Si no elige uno, se conserva el actual.</div>
                        </div>
                    </div>
                </div>
				<div class="form-text px-3 pb-2" id="info_registro_imagen"></div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check" aria-hidden="true"></i> Actualizar</button>
                </div>
			</form>
    </div>
  </div>
</div>
