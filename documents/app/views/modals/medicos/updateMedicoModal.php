<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="updateMedicoModal" tabindex="-1" aria-labelledby="updateMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5" id="updateMedicoModalLabel">
					<i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Editar Médico
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
      		</div>

            <form id="updateMedicoForm" onsubmit="return updateMedicoData()" method="post">
                <input type="hidden" name="idMedico" id="idMedico">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico_update" class="form-label mb-1">Medico:</label>
                            <input type="text" name="medico_update" id="medico_update" class="form-control" placeholder="Ingrese el médico" aria-label="Medicos" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check" aria-hidden="true"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
            </form>
        </div>
    </div>
</div>
