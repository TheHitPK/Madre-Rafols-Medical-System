<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="addMedicoModal" tabindex="-1" aria-labelledby="addMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addMedicoModalLabel"><i class="fa-solid fa-hospital"></i> Registrar nuevo médico</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
            </div>

            <form id="addMedicoForm" onsubmit="return addMedicoData()" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Médico:</label>
                            <input type="text" name="medico" id="medico" class="form-control" placeholder="Ingrese el médico" aria-label="Medicos" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>



