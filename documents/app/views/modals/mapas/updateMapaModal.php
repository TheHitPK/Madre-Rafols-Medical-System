<!-- Modal -->
<div class="modal fade" id="updateMapaModal" tabindex="-1" aria-labelledby="updateMapaModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5" id="updateMapaModalLabel">
					<i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Editar registro
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
      		</div>

			<form id="updateMapaForm" onsubmit="return updateMapaData()" method="post">
                <input type="hidden" name="idMapa" id="idMapa">
				<div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha_mapa_update" class="form-label mb-1">Fecha:</label>
                            <input type="date" name="fecha_mapa_update" id="fecha_mapa_update" class="form-control" placeholder="Ingrese la fecha" required>
                        </div>
                        <div class="col">
                            <label for="factura_mapa_update" class="form-label mb-1">Factura:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="15" autocomplete="off" title="Solo números" name="factura_mapa_update" id="factura_mapa_update" class="form-control" placeholder="Ingrese el número de factura" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idC_costo_update" class="form-label mb-1">Centro de costo:</label>
                            <select class="form-select" name="idC_costo_update" id="idC_costo_update" required>
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
                            <label for="nombre_paciente_mapa_update" class="form-label mb-1">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_mapa_update" id="nombre_paciente_mapa_update" class="form-control" placeholder="Ingrese el nombre del paciente" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente_mapa_update" class="form-label mb-1">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_mapa_update" id="apellido_paciente_mapa_update" class="form-control" placeholder="Ingrese el nombre del paciente" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente_mapa_update" class="form-label mb-1">Cédula del paciente:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_paciente_mapa_update" id="cedula_paciente_mapa_update" class="form-control" placeholder="Ingrese la cédula del paciente" required>
                        </div>
                        <div class="col">
                            <label for="n_historia_paciente_mapa_update" class="form-label mb-1">Nº de historia:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="n_historia_paciente_mapa_update" id="n_historia_paciente_mapa_update" class="form-control" placeholder="Ingrese el número de historia del paciente" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idMedico_update" class="form-label mb-1">Médico:</label>
                            <select class="form-select" name="idMedico_update" id="idMedico_update" required>
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
				<div class="form-text px-3 pb-2" id="info_registro_mapa"></div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check" aria-hidden="true"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    </div>
  </div>
</div>
