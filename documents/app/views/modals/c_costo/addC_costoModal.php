<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="addC_costoModal" tabindex="-1" aria-labelledby="addC_costoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addC_costoModalLabel"><i class="fa-solid fa-hospital" aria-hidden="true"></i> Registrar nuevo centro de costo</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

            <form id="addC_costoForm" onsubmit="return addC_costoData()" method="post">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="c_costo" class="form-label mb-1">Centro de costo:</label>
                            <input type="text" name="c_costo" id="c_costo" class="form-control" placeholder="Ingrese el centro de costo" required>
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



