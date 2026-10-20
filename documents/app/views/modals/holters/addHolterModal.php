<!-- Modal -->
<div class="modal fade" id="addHolterModal" tabindex="-1" aria-labelledby="addHolterModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addHolterModalLabel">
                    <i class="fa-solid fa-heart-circle-plus" aria-hidden="true"></i> Agregar registro
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

    		<form id="addHolterForm" onsubmit="return addHolterData()" method="post">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha_holter" class="form-label mb-1">Fecha:</label>
                            <input type="date" name="fecha_holter" id="fecha_holter" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Ingrese la fecha" required>
                        </div>
                        <div class="col">
                            <label for="factura_holter" class="form-label mb-1">Factura:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="15" autocomplete="off" title="Solo números" name="factura_holter" id="factura_holter" class="form-control" placeholder="Ingrese el número de factura">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idC_costo" class="form-label mb-1">Centro de costo:</label>
                            <select class="form-select" name="idC_costo" id="idC_costo" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showC_costoData as $key => $value) {
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
                            <label for="nombre_paciente_holter" class="form-label mb-1">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_holter" id="nombre_paciente_holter" class="form-control" placeholder="Ingrese el nombre del paciente" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente_holter" class="form-label mb-1">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_holter" id="apellido_paciente_holter" class="form-control" placeholder="Ingrese el apellido del paciente" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente_holter" class="form-label mb-1">Cédula del paciente:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_paciente_holter" id="cedula_paciente_holter" class="form-control" placeholder="Ingrese la cédula del paciente" required>
                        </div>
                        <div class="col">
                            <label for="n_historia_paciente_holter" class="form-label mb-1">Nº de historia:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="n_historia_paciente_holter" id="n_historia_paciente_holter" class="form-control" placeholder="Ingrese el número de historia del paciente">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idMedico" class="form-label mb-1">Médico:</label>
                            <select class="form-select" name="idMedico" id="idMedico" required>
                                <option value="" selected>Seleccione...</option>
                                <?php
                                    foreach ($showMedicosData as $key => $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check" aria-hidden="true"></i> Guardar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    	</div>
	</div>
</div>


