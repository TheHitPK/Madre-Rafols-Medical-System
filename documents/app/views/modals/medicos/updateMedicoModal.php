<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="updateMedicoModal" tabindex="-1" aria-labelledby="updateMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5">
					<i class="fa-solid fa-pen-to-square"></i> Editar Médico
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
      		</div>

            <form id="updateMedicoForm" onsubmit="return updateMedicoData()" method="post">
                <input type="hidden" name="idMedico" id="idMedico">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Medico:</label>
                            <input type="text" name="medico_update" id="medico_update" class="form-control" placeholder="Ingrese el médico" aria-label="Medicos" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
            </form>
        </div>
    </div>
</div>
