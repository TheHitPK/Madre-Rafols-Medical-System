<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="addMedicoModal" tabindex="-1" aria-labelledby="addMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addMedicoModalLabel"><i class="fa-solid fa-hospital" aria-hidden="true"></i> Registrar nuevo médico</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

            <form id="addMedicoForm" onsubmit="return addMedicoData()" method="post">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico" class="form-label mb-1">Médico:</label>
                            <input type="text" name="medico" id="medico" class="form-control" placeholder="Ingrese el médico" aria-label="Medicos" required>
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



