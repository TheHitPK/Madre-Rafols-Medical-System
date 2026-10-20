<!-- Modal -->
<div class="modal fade" id="updateMapaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5">
					<i class="fa-solid fa-pen-to-square"></i> Editar registro
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
      		</div>

			<form id="updateMapaForm" onsubmit="return updateMapaData()" method="post">
                <input type="hidden" name="idMapa" id="idMapa">
				<div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha_mapa_update" id="fecha_mapa_update" class="form-control" placeholder="Ingrese la fecha" aria-label="Fecha" required>
                        </div>
                        <div class="col">
                            <label for="factura">Factura:</label>
                            <input type="number" name="factura_mapa_update" id="factura_mapa_update" class="form-control" placeholder="Ingrese el número de factura" aria-label="Factura" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="c_costo">Centro de costo:</label>
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
                            <label for="nombre_paciente">Nombre del paciente:</label>
                            <input type="text" name="nombre_paciente_mapa_update" id="nombre_paciente_mapa_update" class="form-control" placeholder="Ingrese el nombre del paciente" aria-label="Nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido_paciente">Apellido del paciente:</label>
                            <input type="text" name="apellido_paciente_mapa_update" id="apellido_paciente_mapa_update" class="form-control" placeholder="Ingrese el nombre del paciente" aria-label="Nombre" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_paciente">Cédula del paciente:</label>
                            <input type="number" name="cedula_paciente_mapa_update" id="cedula_paciente_mapa_update" class="form-control" placeholder="Ingrese la cédula del paciente" aria-label="Cédula" required>
                        </div>
                        <div class="col">
                            <label for="cedula_paciente">Nº de historia:</label>
                            <input type="number" name="n_historia_paciente_mapa_update" id="n_historia_paciente_mapa_update" class="form-control" placeholder="Ingrese el número de historia del paciente" aria-label="Nº de historia" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Médico:</label>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    </div>
  </div>
</div>
