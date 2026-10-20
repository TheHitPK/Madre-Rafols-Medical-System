<!-- Modal -->
<div class="modal fade" id="addHolterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5">
                    <i class="fa-solid fa-heart-circle-plus"></i> Agregar registro
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
            </div>

    		<form id="addHolterForm" onsubmit="return addHolterData()" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha_holter" id="fecha_holter" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Ingrese la fecha" aria-label="Fecha" required>
                        </div>
                        <div class="col">
                            <label for="factura">Factura:</label>
                            <input type="number" name="factura_holter" id="factura_holter" class="form-control" placeholder="Ingrese el número de factura" aria-label="Factura">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="c_costo">Centro de costo:</label>
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
                            <label for="nombre_paciente">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_holter" id="nombre_paciente_holter" class="form-control" placeholder="Ingrese el nombre del paciente" aria-label="Nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_holter" id="apellido_paciente_holter" class="form-control" placeholder="Ingrese el apellido del paciente" aria-label="Nombre" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente">Cédula del paciente:</label>
                            <input type="number" name="cedula_paciente_holter" id="cedula_paciente_holter" class="form-control" placeholder="Ingrese la cédula del paciente" aria-label="Cédula" required>
                        </div>
                        <div class="col">
                            <label for="n_historia">Nº de historia:</label>
                            <input type="number" name="n_historia_paciente_holter" id="n_historia_paciente_holter" class="form-control" placeholder="Ingrese el número de historia del paciente" aria-label="Nº de historia">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Médico:</label>
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
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Guardar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    	</div>
	</div>
</div>


