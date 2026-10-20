<!-- Modal: nuevo estudio de imágenes -->
<div class="modal fade" id="addImagenModal" tabindex="-1" aria-labelledby="addImagenModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addImagenModalLabel">
                    <i class="fa-solid fa-x-ray" aria-hidden="true"></i> Agregar estudio
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

    		<form id="addImagenForm" onsubmit="return addImagenData()" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha_imagen" class="form-label mb-1">Fecha:</label>
                            <input type="date" name="fecha_imagen" id="fecha_imagen" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                        <div class="col">
                            <label for="factura_imagen" class="form-label mb-1">Factura:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="20" autocomplete="off" title="Solo números" name="factura_imagen" id="factura_imagen" class="form-control" placeholder="Número de factura">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idTipoEstudio" class="form-label mb-1">Tipo de estudio:</label>
                            <select class="form-select select-tipo-estudio" name="idTipoEstudio" id="idTipoEstudio" required>
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
                            <label for="idC_costo" class="form-label mb-1">Centro de costo:</label>
                            <select class="form-select" name="idC_costo" id="idC_costo" required>
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
                            <label for="nombre_paciente_imagen" class="form-label mb-1">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_imagen" id="nombre_paciente_imagen" class="form-control" maxlength="100" placeholder="Nombre del paciente" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente_imagen" class="form-label mb-1">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_imagen" id="apellido_paciente_imagen" class="form-control" maxlength="100" placeholder="Apellido del paciente" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente_imagen" class="form-label mb-1">Cédula del paciente:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_paciente_imagen" id="cedula_paciente_imagen" class="form-control" placeholder="Cédula del paciente" required>
                        </div>
                        <div class="col">
                            <label for="n_historia_paciente_imagen" class="form-label mb-1">Nº de historia:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="n_historia_paciente_imagen" id="n_historia_paciente_imagen" class="form-control" placeholder="Número de historia">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idMedico" class="form-label mb-1">Médico:</label>
                            <select class="form-select" name="idMedico" id="idMedico" required>
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
                    <div class="row mb-3">
                        <div class="col">
                            <label for="informe" class="form-label mb-1">Informe médico (opcional):</label>
                            <input type="file" name="informe" id="informe" class="form-control" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" aria-describedby="ayudaInforme">
                            <div class="form-text" id="ayudaInforme">PDF o Word (.doc, .docx), hasta <?php echo (int)INFORME_MAX_MB;?> MB.</div>
                        </div>
                    </div>
                </div>
				<div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check" aria-hidden="true"></i> Guardar</button>
                </div>
			</form>
    	</div>
	</div>
</div>
