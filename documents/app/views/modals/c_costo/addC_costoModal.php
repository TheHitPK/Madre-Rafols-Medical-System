<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="addC_costoModal" tabindex="-1" aria-labelledby="addC_costoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addC_costoModalLabel"><i class="fa-solid fa-hospital"></i> Registrar nuevo centro de costo</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
            </div>

            <form id="addC_costoForm" onsubmit="return addC_costoData()" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Centro de costo:</label>
                            <input type="text" name="c_costo" id="c_costo" class="form-control" placeholder="Ingrese el centro de costo" aria-label="C_costo" required>
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



